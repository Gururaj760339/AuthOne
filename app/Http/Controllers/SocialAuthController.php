<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{

    public function googleRedirect()
    {
        return Socialite::driver('google')
            ->redirect();
    }

    public function googleCallback()
    {

        $googleUser = Socialite::driver('google')
            ->user();


        $user = User::updateOrCreate(
            [
                'google_id'=>$googleUser->id
            ],
            [
                'name'=>$googleUser->name,
                'email'=>$googleUser->email,
                'avatar'=>$googleUser->avatar,
                'password'=>bcrypt(str()->random(16)),
                'role'=>'customer'
            ]
        );

        Auth::login($user);

        return redirect('/')
            ->with('success','Google login successful');

    }

    // public function appleRedirect()
    // {
    //     return Socialite::driver('apple')
    //         ->redirect();
    // }

    // public function appleCallback()
    // {
    //     $appleUser = Socialite::driver('apple')
    //         ->user();
    //     $user = User::updateOrCreate(
    //         [
    //             'apple_id'=>$appleUser->id
    //         ],
    //         [
    //             'name'=>$appleUser->name ?? 'Apple User',
    //             'email'=>$appleUser->email,
    //             'password'=>bcrypt(str()->random(16)),
    //             'role'=>'customer'
    //         ]
    //     );


    //     Auth::login($user);


    //     return redirect('/')
    //         ->with('success','Apple login successful');

    // }


}
