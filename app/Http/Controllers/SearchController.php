<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class SearchController extends Controller {
    
    public function search(Request $request) {
      $request->validate([
        'search-term' => 'required|string|max:45'
      ]);

      $filters = $request->all();
      $events = Event::where('id', '>', 0);

      if (isset($filters['search-term']) && $filters['search-term'] != '') {
        $events->where('events.event_name', 'LIKE', "%{$filters['search-term']}%");
      }

      $events = $events->paginate(10);
      
      if (count($events) === 0) {
        return back()->with(['error' => 'No events found with a name like that term.']);
      }

      return view('searched_events', ['events' => $events]);
    }
}
