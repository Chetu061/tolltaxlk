<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('backend.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->validate([
            'current_password' => [
                'required',
                function ($attribute, $value, $fail) {
                    // Check if the current password matches the logged-in user's password
                    if (!\Hash::check($value, auth()->user()->password)) {
                        $fail('The current password is incorrect.');
                    }
                },
            ],
            'password' => 'required|string|min:6|confirmed',
        ]);
        if (!Hash::check($request->current_password, Auth::guard('web')->user()->password)) {
            return back()->withErrors([
                'current_password' => 'The current password you entered does not match our records.',
            ]);
        }
        $pid = intval($request->id);
        $client = user::find($pid);
        $client->name = $request->name;
        $client->email = $request->email;
        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/user_images/' . $client->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $filename);
            $client['photo'] = $filename;
        }
        $client->contact = $request->contact;
        $client->password = Hash::make($request->input('password'));
        $client->save();
        // dd($prod);
        $notification = array(
            'message' => 'Your Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    /**
   
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
