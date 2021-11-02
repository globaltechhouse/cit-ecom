<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class CustomerAuthController extends Controller
{
    public function index()
    {
        if (!auth()->id()) {
            $urlprevious = url()->previous();
            $urlprevious = explode('8000', $urlprevious);
            $urlprevious = end($urlprevious) ?? '/';
            return view('frontend.pages.signin', compact('urlprevious'));
        }
        return redirect('/');
    }

    public function signin(Request $request)
    {
        // return $request->all();
        $request->validate([
            "*" => "required"
        ]);
        $user = User::where('email', $request->email)->first();
        if (!empty($user)) {
            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);
                if ($user->role('Super Admin') || $user->role('Admin')) {
                    return redirect()->route('dashboard');
                }
                return back();
            }
            return back()->with('login_error', 'email and password does not match!');
        }
        return redirect()->route('customer.auth.signin')->with('login_error', 'email and password does not match!');
    }
    public function registerCustomer(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => "required|same:confimed|min:6"
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        event(new Registered($user));

        $profile = Profile::create([
            "user_id" => $user->id,
        ]);
        $save_location = public_path('profile/') . $profile->id . '/';
        File::makeDirectory($save_location, 0777, true, true);
        $user->assignrole('Customer');

        Auth::login($user);
        return redirect('/');
    }

    ################### Git HUB Method's ##############

    public function GitHubRedirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function GitHubCallback()
    {
        $user = Socialite::driver('github')->user();
        // echo $user->getname();
        // echo $user->getemail();
        $viaUser = User::where('email', $user->getemail())->get();

        if ($viaUser->count() > 1) {
            return redirect()->route(('customer.auth.index'))->with('duplicate_error', 'Email already Exists!');
        } elseif ($viaUser->count() == 1) {
            $user = $viaUser->first();
            if ($user->role('Super Admin') || $user->role('Admin')) {
                Auth::login($user);
                return redirect()->route('dashboard');
            }
            Auth::login($user);
            return back();
        } else {
            $password = Str::random();
            $newuser = User::create([
                "name" => $user->getname(),
                "email" => $user->getemail(),
                "password" => Hash::make($password),
            ]);
            // return $newuser->registration_method;
            event(new Registered($newuser));
            $newuser->registration_method = "via";
            $newuser->save();
            $newuser->assignrole('Customer');
            // $newuser->assignrole('Super Admin');

            $profile = Profile::create([
                "user_id" => $newuser->id,
            ]);
            $save_location = public_path('profile/') . $profile->id . '/';
            File::makeDirectory($save_location, 0777, true, true);

            Auth::login($newuser);
            return redirect('/');
        }
    }
}
