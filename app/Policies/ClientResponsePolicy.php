<?php

namespace App\Policies;

use App\Models\ClientResponse;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientResponsePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the client response.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ClientResponse  $clientResponse
     * @return bool
     */
    public function view(User $user, ClientResponse $clientResponse)
    {
        // Les administrateurs peuvent voir toutes les réponses
        if ($user->isAdmin()) {
            return true;
        }

        // Les utilisateurs peuvent voir leurs propres réponses
        return $user->id === $clientResponse->user_id;
    }

    /**
     * Determine whether the user can send a message for this client response.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ClientResponse  $clientResponse
     * @return bool
     */
    public function sendMessage(User $user, ClientResponse $clientResponse)
    {
        // Les administrateurs peuvent envoyer des messages pour toutes les réponses
        if ($user->isAdmin()) {
            return true;
        }

        // Les utilisateurs peuvent envoyer des messages pour leurs propres réponses
        return $user->id === $clientResponse->user_id;
    }
}
