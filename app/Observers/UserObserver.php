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

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
