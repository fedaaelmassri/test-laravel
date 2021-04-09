<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //Function get Data of  user  and view    

    public function show_profile($id)
    {
        $user = User::where('id', $id)->first();
         return view('profile.show')->with('user', $user);
    }


    //Function change password    

    public function changePassword(Request $request)
    {

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
             return redirect()->back()->with("error", __("The current password does not match the password you provided. Try again."));
        }

        if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            //Current password and new password are same
             return redirect()->back()->with("error", __("The new password cannot be the current password. Please choose a different password."));
        }


        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return back()->with("message_flash", __("change password success!"));
    }

}
