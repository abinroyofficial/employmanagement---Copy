<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegisterMail;

class UserObserver
{

    public function created(User $user): void
    {

    }


    public function updated(User $user): void
    {

    }


    public function deleted(User $user): void
    {

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
