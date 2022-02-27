@extends('layouts.app')

@section('content')
<div class="container rounded bg-white mt-5 mb-5">
  <div class="row">
    <div class="col-md-6 border-right">
      <div class="d-flex flex-column align-items-center p-3 py-5">
          <div class="row">
              <div class="col-md-12">
                  <h1>{{ $event->getName() }}</h1>
                  Organizer: <a href={{ route('profile', ['id' => $event->organizer->getId()]) }}>{{ $event->organizer->getName() }}</a>
                  <p>{{ $event->getDescription() }}</p>
                  <p>{{ $event->getFormattedAddress() }}</p>
                  <p>Start: {{ $event->getFormattedStartDate() }} End: {{ $event->getFormattedEndDate() }}</p> 
                  <p></p>
                  <p class="card-text">Type of event {{ $event->eventType->name }}</p>
              </div>
          </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="d-flex flex-column align-items-center p-3 py-5">
        <div class="row">
          <div class="col-md-12">
            <h4 class="text-center">Registered to Attend</h4>
            @foreach ($registrations as $reg)
              <li>{{ $reg->user->first()->getName() }}</li>  
            @endforeach
            {{ $registrations->links() }}
            <hr />
            @auth
              @if (auth()->user()->isRegisteredForEvent($event->getId()))
                <form method="POST" action="{{ route('eventunregister') }}">
                  @csrf
                  <input type="hidden" name="event_id" value="{{ $event->getId() }}">
                  <button class="btn btn-primary" type="submit">Unregister for this Event</button>
                </form> 
              @else 
                <form method="POST" action="{{ route('eventregister') }}">
                  @csrf
                  <input type="hidden" name="event_id" value="{{ $event->getId() }}">
                  <button class="btn btn-primary" type="submit">Register for this Event</button>
                </form> 
              @endif
              <p class="card-text mb-2">Total Registers {{ count($event->registrations)}}</p>
            @endauth
            @guest
              <span>Login to register for this event.</span>  
            @endguest
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection