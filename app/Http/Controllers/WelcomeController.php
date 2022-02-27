<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class WelcomeController extends Controller {
  
  public function index () {
    $events = Event::where('id', '>', 0)->orderBy('created_at', 'desc')->paginate(3);  
    return view('welcome', ['events' => $events]);
  }

}
