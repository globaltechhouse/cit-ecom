<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Intervention\Image\Facades\Image;

use function PHPUnit\Framework\fileExists;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(User $user)
    {
        return view('backend.profile.profile', [
            'profile' => Profile::with('user')->where('user_id', $user->id)->first(),
        ]);
    }

    public function create()
    {
        return view('backend.profile.create', [
            'profile' => Profile::with('user')->where('user_id', auth()->id())->first(),

        ]);
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     "email" => "unique:users,email," . auth()->id(),
        //     "mobile_no" => "max:11|unique:profiles,mobile_no," . auth()->user()->profile->id,
        // ]);
        $user = User::findorfail(auth()->id());
        $user->update([
            "name" => $request->name,
            "email" => $request->email
        ]);
        $profile = Profile::where('user_id', $user->id)->first();
        $profile->update([
            'user_id' => $user->id,
            "mobile_no" => $request->mobile_no,
            "address" => $request->address,
            "gender" => $request->gender,
        ]);

        $save_location = public_path('profile/') . $profile->id . '/';

        if ($request->hasFile('image')) {
            $old_image = $save_location . $profile->image;
            if (!is_dir($old_image)) {
                unlink($old_image);
            }
            $image = $request->file('image');
            $image_name = $profile->id . Str::random() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(800, 800)->save($save_location . $image_name);
            $profile->image = $image_name;
        }
        $profile->save();
        return back();
    }

    public function changePassword(User $user)
    {
        if ($user->id != auth()->id()) {
            return back();
        }
        return view('backend.profile.changePassword', compact('user'));
    }
    public function updatePassword(Request $request, User $user)
    {
        if ($user->id != auth()->id()) {
            return back();
        }
        $request->validate([
            'password' => 'required |same:confirmed',
        ]);
        // return  $request->all();
        if ($user->registration_method == 'local') {

            if (Hash::check($request->old_password, $user->password)) {
                $user->update([
                    'password' => Hash::make($request->password),
                ]);
                return redirect()->route('profile.index', $user)->with('success', 'password changed successfully');
            } else {
                return back()->with('old_password', 'wrong Password!');
            }
        } else {
            $user->update([
                'password' => Hash::make($request->password),
                'registration_method' => 'local',
            ]);
            return redirect()->route('profile.index', $user)->with('success', 'password changed successfully');
        }
    }
}
