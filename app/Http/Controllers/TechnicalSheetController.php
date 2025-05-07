<?php

namespace App\Http\Controllers;

use App\Models\ClientResponse;
use App\Models\User;
use App\Notifications\TechnicalSheetStatusChanged;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class TechnicalSheetController extends Controller
{
    /**
     * Display a listing of the technical sheets.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->hasPermission('view_technical_sheets')) {
            // Admins can see all technical sheets
            $clientResponses = ClientResponse::latest()->paginate(10);
        } else {
            // Clients can only see their own technical sheets
            $clientResponses = $user->clientResponses()->latest()->paginate(10);
        }

        return view('technical-sheets.index', compact('clientResponses'));
    }

    /**
     * Validate a technical sheet.
     */
    public function validateSheet(ClientResponse $clientResponse)
    {
        // Vérification de la permission déjà faite par le middleware
        $clientResponse->update(['status' => 'validated']);

        // Envoyer une notification à l'utilisateur propriétaire de la fiche
        if ($clientResponse->user) {
            $clientResponse->user->notify(new TechnicalSheetStatusChanged(
                $clientResponse,
                'validated',
                'Votre fiche technique a été validée par un administrateur.'
            ));
        }

        return redirect()->route('technical-sheets.index')
            ->with('success', 'La fiche technique a été validée avec succès.');
    }

    /**
     * Delete a technical sheet (for clients - only their own sheets).
     */
    public function destroy(ClientResponse $clientResponse)
    {
        $user = Auth::user();

        // Vérifier si l'utilisateur est autorisé à supprimer cette fiche technique
        if ($user->hasPermission('delete_own_technical_sheets') && $user->id === $clientResponse->user_id) {
            $clientResponse->delete();

            return redirect()->route('technical-sheets.index')
                ->with('success', 'La fiche technique a été supprimée avec succès.');
        }

        return redirect()->route('technical-sheets.index')
            ->with('error', 'Vous n\'êtes pas autorisé à supprimer cette fiche technique.');
    }

    /**
     * Delete any technical sheet (admin only).
     */
    public function adminDestroy(ClientResponse $clientResponse)
    {
        // La vérification des permissions est déjà faite par le middleware
        $clientResponse->delete();

        return redirect()->route('technical-sheets.index')
            ->with('success', 'La fiche technique a été supprimée avec succès.');
    }
}
