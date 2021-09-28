<?php

namespace App\Policies;

use App\Helpers\Helper;
use App\Models\Message;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class MessagePlolicy
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

    public function ShowFile( $user,Message $message){
        $type_user = Helper::BindGuardModel();
        return (($type_user === $message->sender_type && $user->id == $message->sender_id) ||
                ($type_user === $message->receiver_type && $user->id == $message->receiver_id))
            ? Response::allow()
            : Response::deny('unauthorized .');

    }

    public function view( $user, Message $message){
        $type_user = Helper::BindGuardModel();
        return (($type_user === $message->sender_type && $user->id == $message->sender_id) ||
            ($type_user === $message->receiver_type && $user->id == $message->receiver_id))
            ? Response::allow()
            : Response::deny('unauthorized .');

    }

    public function viewAny(User $user,Message $message)
    {
        return true;

    }

    public function create(User $user,Message $message)
    {
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Message  $message
     * @return mixed
     */
    public function update( $user, Message $message)
    {
        $type_user = Helper::BindGuardModel();
        return  ($type_user === $message->receiver_type && $user->id == $message->receiver_id)
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
    public function delete( $user, Message $message)
    {
        $type_user = Helper::BindGuardModel();
        return  ($type_user === $message->receiver_type && $user->id == $message->receiver_id)
            ? Response::allow()
            : Response::deny('unauthorized .');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Message  $message
     * @return mixed
     */
    public function restore(User $user, Message $message)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Message  $message
     * @return mixed
     */
    public function forceDelete(User $user, Message $message)
    {
        //
    }

    public function reply($user,Message $message){
        $type_user = Helper::BindGuardModel();
        return  ($type_user === $message->receiver_type && $user->id == $message->receiver_id)
            ? Response::allow()
            : Response::deny('unauthorized .');
    }

}
