<?php

namespace Azuriom\Plugin\GoogleAuth\Controllers;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\GoogleAuth\Models\Google;
use Azuriom\Plugin\GoogleAuth\Models\User;
use Azuriom\Rules\GameAuth;
use Azuriom\Rules\Username;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Azuriom\Models\Setting;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthHomeController extends Controller
{
    public function __construct() {
        config(["services.google.client_id" => setting('google-auth.client_id', '')]);
        config(["services.google.client_secret" => setting('google-auth.client_secret', '')]);
        config(["services.google.max_per_ip" => setting('google-auth.max_per_ip', '')]);
        config(["services.google.redirect" => URL::route('google-auth.callback')]);
    }

    public function username() {

        return view('google-auth::username', ['conditions' => setting('conditions')]);
    }

    public function registerUsername(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:25', 'unique:users', new Username(), new GameAuth()]
        ]);

        $user = Auth::user();
        $user->name = $request->input('name');
        $user->save();

        return redirect()->route('home');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();
    
        $existingUser = User::where('email', $user->getEmail())->first();
    
        if ($existingUser) {
            Auth::login($existingUser);
            if ($existingUser->isBanned()) {
                throw ValidationException::withMessages([
                    'email' => trans('auth.suspended'),
                ])->redirectTo(URL::route('login'));
            }
        } else {
            $maxPerIp = config('services.google.max_per_ip');
    
            if ($maxPerIp > 0) {
                $ipAddress = request()->ip(true);
    
                $userCount = User::where('last_login_ip', $ipAddress)->count();
    
                if ($userCount >= $maxPerIp) {
                    return redirect()->route('register')->with('error', trans('google-auth::messages.max-registrations'));
                }
            }

            $newUser = new User();
            $newUser->name = $user->getName();
            $newUser->email = $user->getEmail();
            $newUser->password = Hash::make(Str::random(32));
            $newUser->last_login_ip = request()->ip(true);
            $newUser->save();
    
            Auth::login($newUser);
    
            return redirect()->route('google-auth.username');
        }
    
        return redirect()->intended();
    }

}