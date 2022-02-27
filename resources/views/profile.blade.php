@extends('layouts.app')
@section('content')
<div class="row py-5 px-4">
<div class="col-md-5 mx-auto">
  <div class="bg-white shadow rounded overflow-hidden">
    <div class="px-4 pt-0 pb-4 cover">
      <div class="media align-items-end profile-head">
        <div class="d-inline">
          <div class="profile mr-3">
            <img src="{{$user->profile->avatar }}" alt="..." width="130" class="rounded mb-2 img-thumbnail">
            <h4 class="mt-0 mb-0">{{$user->getName()}}</h4>
          </div>
        </div>
        <span>Bio: {{ $user->profile->bio }}</span>
        <br />
        <span>Age: {{ $user->profile->age }}</span>
        <br />
        <span># of Registered Events: {{ count($user->registrations) }}</span>
        <ul class="list-inline mb-0">
          <li class="list-inline-item">
            @if (auth()->id() == $user->getId())
            <a class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</a>  
            <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModal" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="editRecord">Edit Profile</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form method="POST" action="{{ route('profile.edit', ['id' => $user->getId()]) }}">
                    @csrf
                    <div class="modal-body">
                      <div class="form-group">
                        <label for="notes">Bio</label>
                        <textarea class="form-control" maxlength="100" oninput="displayCharsLeft(this, 100)" 
                          name="bio" rows="2" placeholder="Bio">{{ $user->profile->bio }}</textarea>
                        <div class="d-inline mb-2" id="charsLeft"></div>
                      </div>
                      <div class="col-md-4 mb-2">
                        <label class="form-label">Age</label>
                        <input class="form-control" type="text" name="age" placeholder="20">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                      <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-outline-success">Edit</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            @endif
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection