<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

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
        $user = $request->user();
    
        // --- HANDLE FOTO PROFIL ---
        if ($request->hasFile('profile_photo')) {

            // simpan file ke public/uploads/profile_photos
            $file = $request->file('profile_photo');
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('uploads/profile_photos'), $filename);
        
            // path yang disimpan ke database
            $user->profile_photo_path = 'uploads/profile_photos/' . $filename;
        }
        
        
        // Update data lain
        $user->fill([
            'name' => $request->name,
            'email' => $request->email,
            'institution' => $request->institution,
            'interest_field' => $request->interest_field,
        ]);
        
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
        
        $user->save();
        $user->refresh(); // ⬅️ ini yang bikin halaman edit langsung baca foto terbaru
        
    
        // Redirect berdasarkan role
        if ($user->role === 'mentee') {
            return redirect()->route('dashboard.mentee')->with('status', 'profile-updated');
        }
        if ($user->role === 'mentor') {
            return redirect()->route('dashboard.mentor')->with('status', 'profile-updated');
        }
        if ($user->role === 'admin') {
            return redirect()->route('dashboard.admin')->with('status', 'profile-updated');
        }
    
        return back()->with('status', 'profile-updated');
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
