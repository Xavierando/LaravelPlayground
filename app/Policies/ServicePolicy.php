<?php

namespace App\Policies;

use App\Models\Service;
use App\Models\User;
use App\Permissions\V1\Abilities;

class ServicePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function delete(User $user) {
        return $user->userCan(Abilities::DeleteService);
    }

    public function replace(User $user) {
        return $user->userCan(Abilities::ReplaceService);
    }

    public function store(User $user) {
        return $user->userCan(Abilities::CreateService);
    }

    public function update(User $user) {
        return $user->userCan(Abilities::UpdateService);
    }
}
