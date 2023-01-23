<?php

namespace App\Policies;

use App\Models\Roas;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class RoasPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Roas $roas)
    {
        return $user->id === $roas->advertisement->sales->businessProfile->user_id
            ? Response::allow()
            : Response::denyWithStatus(401);
    }

    public function destroy(User $user, Roas $roas)
    {
        return $user->id === $roas->advertisement->sales->businessProfile->user_id
            ? Response::allow()
            : Response::denyWithStatus(401);
    }
}