<?php

namespace App\Policies;

use App\Models\User;

class FreeAdPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }


    public function create(User $user)
{
    //? Allow only authenticated users to create ads
    // return $user->id !== null;
    return true;
}
}
