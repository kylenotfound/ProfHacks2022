<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserProfile;

class UserProfileController extends Controller {
    
    public function index ($id) {
      $user = User::findOrFail($id);
      if ($user->profile_id == null) {
        $profile = UserProfile::create([
          'user_id' => $id,
          'avatar' => "https://avatars.dicebear.com/api/identicon/" . $user->getName() . ".svg",
        ]);

        $user->update(['profile_id' => $profile->id]);
      }
      
      return view('profile', ['user' => $user]);
    }

    public function edit(Request $request, $id) {
      $user = User::findOrFail($id);

      $request->validate([
        'bio' => 'nullable|string|max:100',
        'age' => 'nullable|integer',
      ]);

      UserProfile::where('user_id', $id)
        ->update([
          'age' => $request->input('age') ?? $user->profile->age,
          'bio' => $request->input('bio') ?? $user->profile->bio,
        ]);
      
      return back()->with(['success' => 'Profile Updated!']) ; 
    }
}
