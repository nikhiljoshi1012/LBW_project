<?php

namespace App\Http\Controllers\Auth;

use Mckenziearts\Notify\Facades\LaravelNotify as Notify;
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
        // Validate the request...

        if (Auth::attempt($request->only('email', 'password'))) {
            session()->flash('success', 'Signed in successfully');
            return redirect()->intended('dashboard');
        }

        session()->flash('error', 'Login failed');
        return redirect()->back();
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
