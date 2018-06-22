<?php

namespace App\Http\Controllers\Auth;

use App\Entity\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Kamaln7\Toastr\Facades\Toastr;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->redirectTo = route('dashboard');
    }

    public function authenticated(Request $request, $user)
    {
        if ($user->status != User::STATUS_ACTIVE) {
            $this->guard()->logout();
            Toastr::error(__('flashes.not_verified_user'));
            return back();
        }
        return redirect()->intended($this->redirectPath());
    }
}
