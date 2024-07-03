<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function login(Request $request)
{
    $this->validateLogin($request);

    if ($this->attemptLogin($request)) {
        notify()->success('Welcome back, ' . Auth::user()->name . '!', 'Login Successful');

        return $this->sendLoginResponse($request);
    }

    $this->incrementLoginAttempts($request);

    return $this->sendFailedLoginResponse($request);
}

protected function sendFailedLoginResponse(Request $request)
{
    notify()->error('Login failed, please check your credentials and try again.', 'Login Failed');

    return redirect()->back()
        ->withInput($request->only($this->username(), 'remember'))
        ->withErrors([
            $this->username() => [trans('auth.failed')],
        ]);
}

}
