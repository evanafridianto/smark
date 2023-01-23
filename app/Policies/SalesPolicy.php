<?php

namespace App\Policies;

use App\Models\Sale;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalesPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */

    public function update(User $user, Sale $sale)
    {
        return $user->id === $sale->businessProfile->user_id
            ? Response::allow()
            : Response::denyWithStatus(401);
    }

    public function destroy(User $user, Sale $sale)
    {
        return $user->id === $sale->businessProfile->user_id
            ? Response::allow()
            : Response::denyWithStatus(401);
    }
}