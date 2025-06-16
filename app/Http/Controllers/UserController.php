<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {

        return view('auth.login');
    }
    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $user = array(
            "email" => $email,
            "password" => $password
        );
        if (Auth::attempt($user)) {
            return redirect()->intended();
        } else {
            return redirect('/auth/login')->with("error", "Invalid!!");
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();

        return redirect()->route('login')->with("success", "Logout Success!!");
    }

    public function profile()
    {
        $user = Auth::user();
        return view('auth.profile', compact('user'));
    }
    public function update(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
        ]);
        $user = Auth::user();

        // Update user info
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            if ($user->profile && $user->profile->image && Storage::exists($user->profile->image)) {
                Storage::delete($user->profile->image);
            }

            $imagePath = $request->file('image')->store('images/profile', 'custom');
        }


        if ($user->profile) {
            $user->profile->update([
                'user_id' => $user->id,
                'phone' => $request->phone,
                'address' => $request->address,
                'image' => $imagePath,
                'type' => $request->type,
            ]);
        } else {
            $user->profile()->create([
                'phone' => $request->phone,
                'address' => $request->address,
                'image' => $imagePath,
                'type' => $request->type,
            ]);
        }

        return redirect()->back()->with('success', 'Profile updated successfully.');
        // $user->update([
        //     'name' => $request->name,
        // ]);
        // $data = $request->all();
        // if ($request->hasFile('image')) {
        //     Storage::delete($user->profile->image);
        //     $file = $request->file('image')->store('images/profiles', 'custom');
        //     $data['image'] = $file;
        // }
        // $user->profile()->update(
        //     $data
        // );
        // if ($user) {
        //     Session()->flash('success', 'Update Success....');
        //     return redirect()->back()->with('success', 'Update Success...');
        // }
        // return redirect()->back()->with('error', 'Can not update data...');
    }
}
