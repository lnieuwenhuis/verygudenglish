<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Docent;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
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


    public function redirectToProvider()
    {
        return Socialite::driver('azure')->redirect();
    }


    public function handleProviderCallback()
    {
        $azureUser = Socialite::driver('azure')->user();

        if ((explode('@', $azureUser->email))[1] != 'student.landstede.nl') {
            $user = Docent::where('email', $azureUser->getEmail())->first();
            if (!$user) {
                $user = Docent::create([
                    'name' => $azureUser->getName(),
                    'email' => $azureUser->getEmail(),
                ]);
            }
        } else {
            $user = Student::where('email', $azureUser->getEmail())->first();
            if (!$user) {
                $user = Student::create([
                    'name' => $azureUser->getName(),
                    'email' => $azureUser->getEmail(),
                ]);
            }
        }

        Auth::login($user, true);

        return redirect()->route('home');
    }
}
