<?php

namespace App\Observers;

use App\Mail\NotificationRegisterUser;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class UserObserver
{

    public function created(User $user): void
    {

        Mail::to($user->email)->send(new NotificationRegisterUser($user));

    }


    public function updated(User $user): void
    {
        //
    }


    public function deleted(User $user): void
    {
        //
    }


    public function restored(User $user): void
    {
        //
    }


    public function forceDeleted(User $user): void
    {
        //
    }
}
