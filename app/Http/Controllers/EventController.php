<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventType;
use App\Models\Registrations;
use Carbon\Carbon;

class EventController extends Controller {
    
    public function show (Event $event) {
      $registrations = Registrations::where('event_id', $event->getId())->paginate(10);
      return view('events.show', [
        'event' => $event,
        'registrations' => $registrations,
      ]);  
    }
    public function create() {
      return view('events.create', [
        'eventTypes' => EventType::all()
      ]);  
    }

    public function store(Request $request) {
        $request->validate([
          'user_id' => 'required',
          'event_name' => 'required|string|min:4|max:90',
          'event_description' => 'nullable|string|max:256',
          'address' => 'nullable|string|min:4|max:90',
          'city' => 'nullable|string|min:4|max:90',
          'zipcode' => 'nullable|string|min:5|max:5',
          'is_remote' => 'nullable',
          'start_date' => 'required|string',
          'end_date' => 'required|string',
          'notes' => 'nullable|max:999',
          'event_type_id' => 'required',  
        ]);
        
        $startDate = Carbon::parse($request->input('start_date'))->format('Y-m-d h:i:s A');
        $endDate = Carbon::parse($request->input('end_date'))->format('Y-m-d h:i:s A');

        $address = $request->input('address');
        $city = $request->input('city');
        $state = $request->input('state');
        $zipcode = $request->input('zipcode');

        $is_remote = $request->input('is_remote');

        //if remote is not null, meaning it is a remote event, remove any fields that may be from address
        if ($is_remote != null) {
          $address = null;
          $city = null;
          $state = null;
          $zipcode = null;  
        }
        
        $event = Event::create([
          'organizer_id' => $request->input('user_id'),
          'event_name' => $request->input('event_name'),
          'event_description' => $request->input('event_description'),
          'address' => $address,
          'city' =>  $city,
          'state' => $state,
          'zipcode' => $zipcode,
          'start_date' => $startDate,
          'end_date' => $endDate,
          'notes' => $request->input('notes'),
          'is_remote' => $is_remote,
          'event_type_id' => $request->input('event_type_id'),
        ]);

        Registrations::create([
          'event_id' => $event->getId(),
          'user_id' => auth()->id(),  
        ]);

        return redirect()->route('home')->with(['success' => 'Succesfully created event!']);
    }

    public function delete(Event $event) {
      $registrations = Registrations::where('event_id', $event->getId())->get();
      foreach ($registrations as $reg) {
        $reg->delete();
      }
      $event->delete();
      return back()->with(['success' => 'Event Deleted!']);
    }

    public function edit(Request $request, Event $event) {
      $request->validate([
        'user_id' => 'required',
        'event_name' => 'nullable|string|min:4|max:90',
        'event_description' => 'nullable|string|max:256',
        'address' => 'nullable|string|min:4|max:90',
        'city' => 'nullable|string|min:4|max:90',
        'zipcode' => 'nullable|string|min:5|max:5',
        'is_remote' => 'nullable',
        'start_date' => 'nullable|string',
        'end_date' => 'nullable|string',
        'notes' => 'nullable|max:999',
        'event_type_id' => 'nullable',  
      ]);
      
      $startDate = Carbon::parse($request->input('start_date'))->format('Y-m-d h:i:s A');
      $endDate = Carbon::parse($request->input('end_date'))->format('Y-m-d h:i:s A');

      $address = $request->input('address');
      $city = $request->input('city');
      $state = $request->input('state');
      $zipcode = $request->input('zipcode');

      $is_remote = $request->input('is_remote');

      //if remote is not null, meaning it is a remote event, remove any fields that may be from address
      if ($is_remote != null) {
        $address = null;
        $city = null;
        $state = null;
        $zipcode = null;  
      }

      $event = Event::where('id', $event->getId())
        ->update([
        'event_name' => $request->input('event_name') ?? $event->getName(),
        'event_description' => $request->input('event_description') ?? $event->getDescription(),
        'address' => $address,
        'city' =>  $city,
        'state' => $state,
        'zipcode' => $zipcode,
        'start_date' => $startDate ?? $event->getFormattedStartDate(),
        'end_date' => $endDate ?? $event->getFormattedEndDate(),
        'notes' => $request->input('notes'),
        'is_remote' => $is_remote,
        'event_type_id' => $request->input('event_type_id') ?? $event->eventType->id,
      ]);

      return back()->with(['success' => 'Successfully Updated!']);
    }
    

}
