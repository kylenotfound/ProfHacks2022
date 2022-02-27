@extends('layouts.app')

@section('content')

@if(session()->has('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{session()->get('success')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 p-2">
      <div class="card mb-2">
        <div class="card-header">
          <h3 class="d-inline">Your Created Events</h3>
          <a class="d-inline btn btn-lg btn-outline-dark float-end" href="{{ route('events.create') }}">Create an Event</a>
        </div>
        <div class="card-body">
          <div class="row mb-2">
            @foreach ($events as $event)
              <div class="card mb-2">
                <div class="card-body">
                  <h5 class="card-title">{{ $event->getName() }}</h5>
                  <p class="card-text">{{ $event->getDescription() }}</p>
                  <p class="card-text">Type of event {{ $event->eventType->name }}</p>
                  <p class="card-text">Total Registers {{ count($event->registrations)}}</p>
                  <a href="{{ route('events.show', ['event' => $event]) }}" class="btn btn-primary btn-sm">View Details</a>
                  <a class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editEventModal">Edit Details</a>
                  @include('events.edit')
                  <form method="POST" action="{{ route('events.delete', ['event' => $event]) }}" class="d-inline">
                    @csrf
                    <button class="d-inline btn btn-danger btn-sm" type="submit">Delete</button>
                  </form> 
                </div>
              </div>  
            @endforeach
          </div>  
        </div>
      </div>
      {{ $events->links() }}
      <div class="card mb-2">
        <div class="card-header">
          <h3>Events you have registered for</h3>
        </div>
        <div class="card-body">
          <div class="row mb-2">
            @if (count($events) > 0)
              @foreach ($registrations as $reg)
                <div class="card mb-2">
                  <div class="card-body">
                    <h5 class="card-title">{{ $reg->event->event_name }}</h5>
                    <p class="card-text">{{ $reg->event->description }}</p>
                    <p class="card-text">Organized by: {{ $reg->event->organizer->name}}</p>
                    <p class="card-text">Type of event {{ $reg->event->eventType->name }}</p>
                    <a href="{{ route('events.show', ['event' => $event]) }}" class="btn btn-primary btn-sm">View Details</a>
                  </div>
                </div> 
              @endforeach  
            @endif
          </div>
        </div>
      </div>  
      {{ $registrations->links() }}   
    </div>
  </div>
</div>
@endsection
