<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // Permission::create(['name' => 'category view']);
        // Permission::create(['name' => 'category add']);
        // Permission::create(['name' => 'category edit']);
        // Permission::create(['name' => 'category delete']);
        // Permission::create(['name' => 'subcategory view']);
        // Permission::create(['name' => 'subcategory add']);
        // Permission::create(['name' => 'subcategory edit']);
        // Permission::create(['name' => 'subcategory delete']);
        // Permission::create(['name' => 'product view']);
        // Permission::create(['name' => 'product add']);
        // Permission::create(['name' => 'product edit']);
        // Permission::create(['name' => 'product delete']);
        // Permission::create(['name' => 'size view']);
        // Permission::create(['name' => 'size add']);
        // Permission::create(['name' => 'size edit']);
        // Permission::create(['name' => 'size delete']);
        // Permission::create(['name' => 'color view']);
        // Permission::create(['name' => 'color add']);
        // Permission::create(['name' => 'color edit']);
        // Permission::create(['name' => 'color delete']);
        // Permission::create(['name' => 'coupon view']);
        // Permission::create(['name' => 'coupon add']);
        // Permission::create(['name' => 'coupon edit']);
        // Permission::create(['name' => 'coupon delete']);
        // Permission::create(['name' => 'assign user']);
        // Permission::create(['name' => 'customer dashboard access']);

        // $rolesuper = Role::create(['name' => 'Super Admin']);
        // $rolesuper->syncPermissions(Permission::all());
        // $user->assignrole('Super Admin');


        #### Inactive this when creting Super Admin ###
        // $user->assignrole('Customer');

        $profile = Profile::create([
            "user_id" => $user->id,
        ]);
        $save_location = public_path('profile/') . $profile->id . '/';
        File::makeDirectory($save_location, 0777, true, true);

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
