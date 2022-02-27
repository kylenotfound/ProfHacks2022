<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registrations;

class RegisterController extends Controller {
    
    public function register(Request $request) {
      $prevRegistered = Registrations::where('user_id', auth()->id())
        ->where('event_id', $request->input('event_id'))
        ->exists();

      if ($prevRegistered) {
        $prevRegistered->restore();
        return back()->with(['success' => 'Succesfully Registered!']);
      }

      Registrations::create([
        'user_id' => auth()->id(),
        'event_id' => $request->input('event_id'),  
      ]);
      return back()->with(['success' => 'Succesfully Registered!']);
    }

    public function unregister(Request $request) {
      $registration = Registrations::where('user_id', auth()->id())
        ->where('event_id', $request->input('event_id'))
        ->delete();
     return back()->with(['success' => 'Succesfully Unregistered!']);  
    }
}
