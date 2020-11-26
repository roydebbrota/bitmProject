@extends('extend.app')
@section('content')

@php
  $user = Auth::user();
  $role = Auth::user()->role;
@endphp
<style>
  .opacity-2{
    opacity:.5;
  }
</style>

<div class="container">
    <div class="row justify-content-left">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header h2">Inventory Category</div>
                @if(Session::has('success') || Session::has('alert'))
                <div class="alert {{Session::has('success') ?'alert-success' : 'alert-danger' }}  text-center">
                {!! session('success'.session('alert')) !!} </div>
                @endif
                <div class="card-body">
                  <form action="" method="post" class="row justify-content-center">
                    @csrf
                    <div class="input-group mb-3 col-sm-6">
                      <input type="text" name="categoryName" class="form-control" placeholder="Category Name" value="{{ old('categoryName') }}">
                      <div class="input-group-append">
                        <button class="btn btn-secondary text-light btn-outline-dark" type="submit">Add</button>
                      </div>
                      <div class="w-100">
                        @error('categoryName') 
                          <span class="small text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                  </form>
                  <table class="table tablt-stripped text-center border border-dark">
                    <tr class="bg-dark text-light">
                      <th class="border border-light bg-dark text-light">Sl</th>
                      <th class="border border-light">Name</th>
                      <th class="border border-light">Slug</th>
                      <th class="border border-light">Created By</th>
                      <th class="border border-light">Action</th>
                    </tr>
                    @forelse($category as $data)
                    <tr class="{{ $data->visibility !=1 ? 'opacity-2' : '' }} bg-secondary text-light">
                      <td class="border border-light bg-dark">{{ $loop->iteration }}</td>
                      <td class="border border-light">{{ $data->name }}</td>
                      <td class="border border-light">{{ $data->slug }}</td>
                      <td class="border border-light">{{ $data->createdBy->name }}</td>
                      <td class="border border-light bg-dark">
                        <button class="btn btn-sm btn-warning" onclick="if(confirm('do you wont to {{ $data->visibility == 1 ? 'Inactive' : 'active' }} {!! strtoupper($data->name) !!} Category?')){document.getElementById('visibilityForm{{ $data->id }}').submit();
                      }else{event.preventDefault();return false;}">
                          <i class="fas {{ $data->visibility == 1 ? 'fa-eye' :'fa-eye-slash' }} px-2"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" {{ $data->visibility == 1 ? 'data-toggle=modal data-target=#categoryUpdate'.$data->id :'' }} ><i class="far fa-edit px-2"></i></button>





                        {{-- Visibility form --}}
                        <form id="visibilityForm{{$data->id}}" method="post" action="{{ url($role,['inventory','category','visibility']) }} " class="d-none">
                          @csrf
                          <input type="hidden" name="categoryVisilibityId" value=" {{$data->id}} ">
                        </form>





                       @include('backend.inventory.categoryUpdateModal',['data'=>$data])





                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="4" class="text-danger text-center">No Category at Yet</td>
                    </tr>
                    @endforelse
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')

@endpush