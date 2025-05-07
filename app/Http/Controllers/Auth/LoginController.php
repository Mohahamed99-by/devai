<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ClientResponse;
use App\Models\Role;
use App\Models\User;
use App\Notifications\TechnicalSheetStatusChanged;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * Show the login form
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Vérifier s'il y a une fiche technique temporaire à associer
            $tempIdentifier = Session::get('temp_client_response_id');
            if ($tempIdentifier) {
                // Trouver la réponse temporaire
                $clientResponse = ClientResponse::where('temp_identifier', $tempIdentifier)
                    ->where('status', 'temporary')
                    ->first();

                if ($clientResponse) {
                    // Associer la réponse à l'utilisateur
                    $clientResponse->user_id = Auth::id();
                    $clientResponse->status = 'draft';
                    $clientResponse->save();

                    // Notifier l'utilisateur
                    Auth::user()->notify(new TechnicalSheetStatusChanged(
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
                        ->with('success', 'Votre fiche technique a été associée à votre compte avec succès.');
                }
            }

            // Rediriger les administrateurs vers le tableau de bord
            if (Auth::user()->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->intended('/client-response/form');
        }

        return back()->withErrors([
            'email' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
        ])->onlyInput('email');
    }

    /**
     * Log the user out
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
