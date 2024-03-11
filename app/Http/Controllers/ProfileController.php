<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        
        $user = auth()->user();
        

        
        if ($request->hasFile('photo')) {

            $fileName = uniqid() . '_.' . $request->photo->extension();

            $request->photo->move(public_path('img/profiles'), $fileName);

            $photoOld = $user->photo;

            $photo = 'img/profiles/' . $fileName;

            $user->photo = $photo;
            
            $user->save();

            if ($photoOld != null) {
                $oldFilePath = public_path($photoOld);

                if (file_exists($oldFilePath)) {
                      unlink($oldFilePath);
                }

            }
        } else {
            $photo = $user->photo;
            
        }



        /* if ($photo != null) {
            $oldFilePath = public_path($photo);
    
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        } */

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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
