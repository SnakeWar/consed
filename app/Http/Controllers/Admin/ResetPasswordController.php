<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetFormRequest;

use Illuminate\Foundation\Auth\ResetsPasswords;

use Illuminate\Support\Str;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    public function index(Request $request){
        $user = auth()->user();
        $broker = Password::broker();
        $token = $broker->createToken($user);
        return view('admin.users.reset')->with([
            'token' => $token
            ]);
        }
        
    public function reset(ResetFormRequest $request) {
        $formData = $request->all();
        $token = $formData['token'];
        $broker = Password::broker();
        $user = auth()->user();
        if($broker->tokenExists($user, $token)) {
            $user->password = Hash::make($formData['password']);
            $user->setRememberToken(Str::random(60));
            $user->first_access = 0;
            $user->save();
            return redirect()->route('admin.home');
        }
    }
}
