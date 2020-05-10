<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskStatusPolicy
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
    public function create(User $user)
    {
        return true;
    }

    public function store(User $user)
    {
        return true;
    }

    public function edit(User $user)
    {
        return true;
    }
    public function update(User $user)
    {
        return true;
    }
    public function delete(User $user)
    {
        return true;
    }
}
