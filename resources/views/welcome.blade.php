@extends('layouts.app')

@section('content')

<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
      <div class="col-md-6 border-right">
        <div class="d-flex flex-column align-items-center p-3 py-5">
            <div class="row">
                <div class="col-md-12">
                    <h1>Welcome to ProfsForChange</h1>
                    <div class="d-inline">
                    <h4 class="font-weight-bold"><b>Volunteering! Fundraising! Support what you believe!</b></h4>
                    </div>
                    <p>ProfsForChange is a platform for Rowan University Students, Staff and more to find
                    different volunteering activities, fundrasing events and protests to contribute to
                    or attend. Connect with others who and support what you believe, together!</p>
                    <p>New events are posted all the time! Register and sign up for different events
                    or create your own! #RowanProud.</p>
                    <p>Check out the list of the most recently posted events to the right, or search
                    for an event in the navbar.</p>
                    <img src="rowan.jpeg" height="400" width="500"/>
                </div>
            </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="d-flex flex-column align-items-center p-3 py-5">
          <div class="row">
            <div class="col-md-12">
              <h2 class="text-left">New Events</h2>
              @if (count($events) > 0)
                @foreach ($events as $event)
                  <div class="card mb-2">
                    <div class="card-body">
                      <h5 class="card-title">{{ $event->getName() }}</h5>
                      <a href="{{route('profile', ['id' => $event->organizer->getId()])}}"><p class="card-text">Organizer {{ $event->organizer->getName() }}</p></a>
                      <p class="card-text">{{ $event->getDescription() }}</p>
                      <p class="card-text">Address {{ $event->getFormattedAddress() }}</p>
                      <p class="card-text">Type of event {{ $event->eventType->name }}</p>
                      <p class="card-text">Total Registers {{ count($event->registrations)}}</p>
                      <a href="{{ route('events.show', ['event' => $event]) }}" class="btn btn-primary">More Information</a>
                    </div>
                  </div>
                @endforeach
              @else
                No events to display! Login to create one!  
              @endif
              {{ $events->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection