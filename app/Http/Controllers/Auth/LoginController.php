<?php

namespace App\Http\Controllers\Auth;

use App\Events\Login;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected function login(Request $request){
        $credential = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth()->attempt($credential)){
            $user = Auth::user();
            event(new Login($user));
            return redirect('/home');

        }

        return redirect('/login')->with('error', 'credential are not correct Please try again');
    }
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        // dd($provider);
        $user = Socialite::driver($provider)->user();
        // dd($user->getId());
        $existingUser = User::where('email', $user->getEmail())->first();
        // dd($existingUser);
        if($existingUser)
        {
            Auth::login($existingUser);
        }else{
            $newUser = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'provider_id' => $user->getId(),
                'provider' => $provider,
            ]);

            Auth::login($newUser);
        }
        return redirect('/home');
    }
}
