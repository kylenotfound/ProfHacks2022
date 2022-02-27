<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventType;
use App\Models\Registrations;
use Illuminate\Http\Request;

class HomeController extends Controller {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $events = Event::where('organizer_id', auth()->id())->paginate(3);
        $registrations = Registrations::where('user_id', auth()->id())->paginate(3);
        return view('home', [
          'events' => $events,
          'registrations'  => $registrations,
          'eventTypes' => EventType::all()
        ]);
    }
}
