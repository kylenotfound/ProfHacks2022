@extends('layouts.app')

@section('content')

@if ($errors->any())
  <div class="alert alert-danger">
    @foreach ($errors->all() as $error)
      @if(!$loop->first)
        <br>
      @endif
      {{ $error }}
    @endforeach
  </div>
@endif

<div class="container p-4">
  <div class="row justify-content-center">
    <div class="col-md-6 mb-2">
      <h1 class="text-center">Create a new Event</h1>
      <form method="POST" action="{{ route('events.store') }}">
        @csrf
        <div class="mb-2">
          <label class="form-label">Event Name</label>
          <input class="form-control" type="text" name="event_name" placeholder="My event"></input>
        </div>
        <div class="form-group">
          <label for="notes">Event Description</label>
          <textarea class="form-control" maxlength="256" oninput="displayCharsLeftDesc(this, 256)" name="event_description" rows="5" placeholder="Description"></textarea>
          <div class="d-inline mb-2" id="charsLeftDesc"></div>
        </div>
        <hr />
        <div class="address-info" id="address-info">
          <div class="mb-2">
            <label class="form-label">Address</label>
            <input class="form-control" type="text" name="address" placeholder="1170 White Horse Rd."></input>
          </div>
          <div class="row mb-2">
            <div class="col-6">
              <label class="form-label">City</label>
              <input class="form-control" type="text" name="city" placeholder="Vorhees">
             </div>
            <div class="col">
              <label class="form-label">State</label>
              @include('includes.states')
            </div>
            <div class="col">
              <label class="form-label">Zipcode</label>
              <input class="form-control" type="text" name="zipcode" placeholder="08043">
            </div>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col">
            @inject('locationTypes', 'App\Models\LocationType')
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="{{ $locationTypes::REMOTE }}" id="remoteBox" name="is_remote">
              <label class="form-check-label" for="flexCheckDefault">Remote Event</label>
            </div>
          </div>
        </div>
        <hr />
        <div class="row mb-2">
          <div class="col-6">
            <label class="form-label">What type of event?</label>
            @foreach ($eventTypes as $type)
              <div class="form-check">
                <input class="form-check-input" type="radio" name="event_type_id" id="eventTypeRadioButton" value="{{$type->id}}">
                <label class="form-check-label" for="flexRadioDefault1">
                  {{ $type->name }}
                </label>
              </div>  
            @endforeach
          </div>
        </div>
        <hr />
        <div class="row">
          <div class="col-6">
            <label class="form-label">Start Date</label>
            <input class="form-control" type="datetime-local" name="start_date">
          </div>
          <div class="col-6">
            <label class="form-label">End Date</label>
            <input class="form-control" type="datetime-local" name="end_date">
          </div>
        </div>
        <hr />
        <div class="form-group">
          <label for="notes">Notes</label>
          <textarea class="form-control" maxlength="256" oninput="displayCharsLeftNotes(this, 256)" name="notes" rows="5" placeholder="Notes"></textarea>
          <div class="d-inline mb-2" id="charsLeftNotes"></div>
        </div>
        <hr />
        <div class="row">
          <div class="col text-center">
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            <button type="submit" class="btn btn-outline-dark text-center">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

@section('styles')
  <style>
    textarea {
      resize: none;
    }
  </style>
@endsection
