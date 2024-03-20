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
            $request->photo->storeAs('public/img/profiles', $fileName);
            $photoOld = $user->photo;
             
            $photo =  'storage/img/profiles/' . $fileName;
            
            if ($photoOld != null) {
        
                if (file_exists('storage/img/profiles/' . $photoOld)) {
                    unlink('storage/img/profiles/' . $photoOld);
                }
            }
        } else {
            $photo = $user->photo;
        }
        $user->photo = $photo;

        $user->save();


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
