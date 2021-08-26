<?php

namespace QurirQ\Observers;

use QurirQ\User;

class UserObserver
{
    /**
     * Handle the User "creating" event.
     *
     * @param  \QurirQ\User  $user
     * @return void
     */
    public function creating(User $user)
    {
        $user->api_token = bin2hex(openssl_random_pseudo_bytes(30));
    }

}