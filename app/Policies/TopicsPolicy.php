<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Topic;

class TopicsPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function update(User $user,Topic $topic)
    {
        return $user->ownsTopic($topic);
    }

    public function destroy(User $user,Topic $topic)
    {
        return $user->ownsTopic($topic);
    }
    
}
