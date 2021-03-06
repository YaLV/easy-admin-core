<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontController;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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
    protected $redirectTo = "/";

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectTo()
    {
        if (Auth::user()->isAdmin) {
            return route('orders');
        }

        return r('page');
    }

    public function loginFB()
    {
        $userData = Socialite::driver('facebook')->user();

        $user = User::where(['email' => $userData->email])->first();

        if (!$user || !$user->registered) {
            list($name, $lastname) = explode(" ", $userData->name, 2);
            $newUser = new User(['email' => $userData->email, 'name' => $name, 'last_name' => $lastname]);
            $newUser = $newUser->toArray();
            if ($user) {
                $newUser = array_merge($user->toArray(), $newUser);
            }

            return redirect(r('register'))->with(['fbuser' => $newUser, 'existingUser' => ($user ?? false)]);
        }
        Auth::logout();
        Auth::login($user);
        return redirect(r('page'));
    }

    public function goToFB()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function username()
    {
        $cr = Route::currentRouteName();
        if ($cr == 'frontlogin' || $cr == 'frontlogin.default') {
            return "email";
        }

        return 'username';
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        Auth::logout();

        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {

            $fc = new FrontController;
            $fc->redrawCart();

            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        $this->sendFailedLoginResponse($request);

        $cr = explode(".", Route::currentRouteName());
        if ($cr[0] == 'frontlogin') {
            return redirect(r('frontlogin'));
        }

        return redirect()->route('login');

    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {

        $this->guard()->logout();

        // Redraw cart - without user discount
        $fc = new FrontController;
        $cartId = $fc->redrawCart();

        $request->session()->invalidate();

        session()->put('cart', $cartId);

        return $this->loggedOut($request) ?: redirect('/');
    }
}
