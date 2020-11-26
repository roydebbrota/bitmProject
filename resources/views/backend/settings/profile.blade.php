@extends('extend.app')
@section('content')

@php
  $user = Auth::user();
  $role = Auth::user()->role;
@endphp

<div class="container">
    <div class="row justify-content-left">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header h2">{{ Str::title(Auth::user()->name) }}'s Profiles</div>
                @if(Session::has('success') || Session::has('alert'))
                <div class="alert {{Session::has('success') ?'alert-success' : 'alert-danger' }}  text-center">
                {!! session('success'.session('alert')) !!} </div>
                @endif
                <div class="card-body">

                    <div class="container">
                      <dl class="row">
                        <dt class="col-sm-3"></dt>
                        <dd class="col-sm-9">
                          <img class="img-thumbnail" src="{{ $user->image != null ? url('../storage/app/'.$user->image) : asset('/images/user/user.jpg') }}" style="max-width: 180px;height: 180px"><br>
                          <form method="post" action="{{ url($role,['settings','profile','image']) }}" enctype="multipart/form-data" style="width: 300px;">
                            @csrf
                              <div class="input-group mb-3">
                                <div class="custom-file">
                                  <input type="file" name="profileImage" class="custom-file-input @error('profileImage') is-invalid @enderror image" id="profileImage">
                                  <label class="custom-file-label" for="profileImage">Choose File</label>
                                </div>
                                 <div class="input-group-append"></div>
                                 <button class="btn btn-primary" type="submit" name="imageUpload">Upload</button>
                                 
                                <div class="w-100">
                                  
                                   @error('profileImage')
                                    <span class="small text-danger">
                                      {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                              </div>
                          </form>
                        </dd>

                        <dt class="col-sm-3">Name :</dt>
                        <dd class="col-sm-9">{{ Str::title($user->name) }}</dd>

                        <dt class="col-sm-3">Email :</dt>
                        <dd class="col-sm-9">{{ $user->email }}</dd>

                        <dt class="col-sm-3">Phone :</dt>
                        <dd class="col-sm-9">{{ $user->phone }}</dd>

                        <dt class="col-sm-3">Address :</dt>
                        <dd class="col-sm-9 {{ $user->address == null ?'text-muted':'' }}">{{ $user->address ?? 'Please Update Your Address' }}</dd>
                      </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
@endpush

@endsection