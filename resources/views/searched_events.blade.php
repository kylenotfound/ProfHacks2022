@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="row">
        <div class="col-12 mb-2">
          @foreach ($events as $event)
            <div class="card mb-2">
              <div class="card-body">
                <h5 class="card-title">{{ $event->getName() }}</h5>
                <a href="{{route('profile', ['id' => $event->organizer->getId()])}}"><p class="card-text">Organizer {{ $event->organizer->getName() }}</p></a>
                <p class="card-text">{{ $event->getDescription() }}</p>
                <p class="card-text">Address {{ $event->getFormattedAddress() }}</p>
                <p class="card-text">Type of event {{ $event->eventType->name }}</p>
                <a href="{{ route('events.show', ['event' => $event]) }}" class="btn btn-primary">More Information</a>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
@endsection