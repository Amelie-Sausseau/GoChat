<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Rules\MatchOldPassword;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     * @return \App\Models\User
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;


    public function showResetForm(Request $request, $locale, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submitResetPasswordForm(Request $request)
    {
        $id = Auth::user()->id;
        $currentUser = User::findOrFail($id);

        if (Hash::check(request('current_password'), $currentUser->password)) {
            $this->validate($request, [
                "current_password" => 'required',
                "password" => 'required|min:6',
                "password_confirmation" => 'required|same:password|min:6'
            ]);

            $newPassword = Hash::make($request['password']);

            $currentUser->update(['password' => $newPassword]);
            return back()
                ->with('success', 'Les informations ont bien été modifiées');
        }
    }
}
