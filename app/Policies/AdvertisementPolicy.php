<?php

namespace App\Policies;

use App\Models\Advertisement;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdvertisementPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Advertisement $ads)
    {
        return $user->id === $ads->sales->businessProfile->user_id
            ? Response::allow()
            : Response::denyWithStatus(401);
    }

    public function destroy(User $user, Advertisement $ads)
    {
        return $user->id === $ads->sales->businessProfile->user_id
            ? Response::allow()
            : Response::denyWithStatus(401);
    }
}