<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    
    public function create(Request $request): View
    {
        $token = $request->token;
        $email = User::where('password_reset', $token)->first()->email;
        $user_id = User::where('password_reset', $token)->first()->id;


        return view('auth.reset-password', compact('token', 'email', 'user_id'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed'],
        ]);

        $token = $request->token;
        $password = Hash::make($request->password);
        $update_pasword = User::where('password_reset', $token)->first();
        $update_pasword->password = $password;
        $update_pasword->save();
        return redirect(route('welcome'));

    }
}
