<?php

namespace App\Jobs;
use App\Mail\UserRegisterMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class NewUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $name;
    protected $email;
    protected $password;
    protected $roles;

    public function __construct($name, $email, $password, $roles)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->roles = $roles;
    }

    public function handle(): void
    {
        Mail::to($this->email)
            ->cc('abinroy4321@gmail.com')
            ->send(new UserRegisterMail($this->name, $this->email, $this->password, $this->roles));
    }
}
