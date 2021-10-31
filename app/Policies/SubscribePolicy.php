<?php

namespace App\Policies;

use App\Models\Newsletter;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class SubscribePolicy
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

    public function update( $user, Newsletter $newsletter)
    {
        return  ($user->id == $newsletter->admins_id)
            ? Response::allow()
            : Response::deny('unauthorized .');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Message  $message
     * @return mixed
     */
    public function delete( $user, Newsletter $newsletter)
    {
        return  ($user->id == $newsletter->admins_id && empty($newsletter->sent_at))
            ? Response::allow()
            : Response::deny('unauthorized .');
    }
}
