<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserProfileController extends Controller
{
    /**
     * Update the user's profile.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function UpdateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|max:100|min:2',
            'email'       => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Retrieve the current user
            $user = User::find(auth()->user()->id);

            // Update the profile fields
            $user->name         = $request->name;
            $user->email        = $request->email;
            $user->save();

            return redirect()->back()->with('t-success', 'Profile updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('t-error', 'Something went wrong: ' . $e->getMessage());
        }
    }


    /**
     * Update the user's password.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function UpdatePassword(Request $request)
    {
        // Validation rules for password change
        $validator = Validator::make($request->all(), [
            'current_password'  => 'required', // Ensure the old password is entered
            'password'          => 'required|confirmed|min:8', // New password must be confirmed and at least 8 characters
        ]);

        if ($validator->fails()) {
            // If validation fails, return back with errors
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Get the current logged-in user
            $user = Auth::user();

            // Check if the entered old password matches the stored password
            if (Hash::check($request->current_password, $user->password)) {
                // Update the password with the new one (hashed)
                $user->password = Hash::make($request->password);
                $user->save();

                // Return success message
                return redirect()->back()->with('t-success', 'Password updated successfully');
            } else {
                // If old password is incorrect, show an error message
                return redirect()->back()->with('t-error', 'Current password is incorrect');
            }
        } catch (\Exception $e) {
            // If an error occurs, show a generic error message
            return redirect()->back()->with('t-error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
