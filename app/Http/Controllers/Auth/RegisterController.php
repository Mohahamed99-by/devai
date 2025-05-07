<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ClientResponse;
use App\Models\Role;
use App\Models\User;
use App\Notifications\TechnicalSheetStatusChanged;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    /**
     * Show the registration form
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        // Récupérer le rôle client
        $clientRole = Role::where('slug', 'client')->first();

        if (!$clientRole) {
            return redirect()->back()->with('error', 'Erreur lors de l\'inscription. Veuillez réessayer plus tard.');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $clientRole->id,
        ]);

        Auth::login($user);

        // Vérifier s'il y a une fiche technique temporaire à associer
        $tempIdentifier = Session::get('temp_client_response_id');
        if ($tempIdentifier) {
            // Trouver la réponse temporaire
            $clientResponse = ClientResponse::where('temp_identifier', $tempIdentifier)
                ->where('status', 'temporary')
                ->first();

            if ($clientResponse) {
                // Associer la réponse à l'utilisateur
                $clientResponse->user_id = $user->id;
                $clientResponse->status = 'draft';
                $clientResponse->save();

                // Notifier l'utilisateur
                $user->notify(new TechnicalSheetStatusChanged(
                    $clientResponse,
                    'draft',
                    'Votre fiche technique a été associée à votre compte avec succès.'
                ));

                // Notifier les administrateurs
                $adminRole = Role::where('slug', 'admin')->first();
                if ($adminRole) {
                    $admins = User::where('role_id', $adminRole->id)->get();
                    Notification::send($admins, new TechnicalSheetStatusChanged(
                        $clientResponse,
                        'draft',
                        'Une nouvelle fiche technique a été associée à un utilisateur et nécessite votre validation.'
                    ));
                }

                // Supprimer l'identifiant temporaire de la session
                Session::forget('temp_client_response_id');

                // Rediriger vers la fiche technique
                return redirect()->route('client-response.my')
                    ->with('success', 'Votre compte a été créé et votre fiche technique a été associée avec succès.');
            }
        }

        // Les nouveaux utilisateurs sont toujours des clients, donc on les redirige vers l'accueil
        return redirect('/');
    }
}
