<?php

namespace Larisso\Observers;

use Larisso\User;

class UserObserver
{
    /**
     * Handle the User "creating" event.
     *
     * @param  \Larisso\User  $user
     * @return void
     */
    public function creating(User $user)
    {
        $user->api_token = bin2hex(openssl_random_pseudo_bytes(30));
    }

}