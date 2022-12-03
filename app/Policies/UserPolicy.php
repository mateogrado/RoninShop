<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function before(User $usuario,$ability) {
        if ($usuario->hasRole(['admin'])) {
            return true;
        }
    }

    public function edit(User $authUser, User $usuario) 
    {
        return $authUser->id === $usuario->id;
    }

    public function update(User $authUser, User $usuario) 
    {
        return $authUser->id === $usuario->id;
    }

    public function destroy(User $authUser, User $usuario) 
    {
        return $authUser->id === $usuario->id;
    }

}
