<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\forgotPassword;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use Illuminate\Support\Str;

class PasswordResetLinkController extends Controller
{

    public function create(): View
    {
        return view('auth.forgot-password');
    }


    public function store(Request $request)
    {
        $user = User::where('email', request()->email)->first();

        if ($user) {
            $token = Str::random(120);
            $user->update(['password_reset' => $token]);

            Mail::to($user->email)->cc('abinroy4321@gmail.com')->send(new forgotPassword($user, $token));
            return redirect()->back()->with('message', 'please check email for reset password');
        } else {
            return redirect()->back()->with('message', 'no user with such email found ');
        }
    }
}
