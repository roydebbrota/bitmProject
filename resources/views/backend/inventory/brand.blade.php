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
                <div class="card-header h2">Inventory Brand</div>
                @if(Session::has('success') || Session::has('alert'))
                <div class="alert {{Session::has('success') ?'alert-success' : 'alert-danger' }}  text-center">
                {!! session('success'.session('alert')) !!} </div>
                @endif
                <div class="card-body">
                  <form action="{{url($role,['inventory','brand'])}}" method="post" class="row">
                    @csrf
                    <div class="col-sm-6 offset-3 form-group">
                      <label for="subCategoryName">Sub-Category Name</label>
                      <select id="subCategoryName" name="subCategoryName" class="form-control">
                        @forelse($subCategory as $subCateData)
                        <option value="{{$subCateData->id}}">{{$subCateData->name}}</option>
                        @empty
                        <option>No Category Here</option>
                        @endforelse
                      </select>
                    </div>
                    <div class="col-sm-6 offset-3 form-group">
                      <label for="brandName">Brand Name</label>
                      <input type="text" name="brandName" id="brandName" class="form-control" placeholder="Sub Category Name" value="{{ old('brandName') }} ">
                      <div class="w-100">
                        @error('brandName') 
                          <span class="small text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="w-100"></div>
                    <div class="offset-3 form-group">
                    <button class="btn btn-primary px-4 ml-3" type="submit">Add</button>
                    </div>
                  </form>
                  <table class="table tablt-stripped text-center border border-dark">
                    <tr class="bg-dark text-light">
                      <th class="border border-light bg-dark text-light">Sl</th>
                      <th class="border border-light">Name</th>
                      <th class="border border-light">Slug</th>
                      <th class="border border-light">Sub-Category Name</th>
                      <th class="border border-light">Created By</th>
                      <th class="border border-light">Action</th>
                    </tr>
                    @forelse($brand as $data)
                    <tr class="{{ $data->brand_visibility !=1 ? 'opacity-2' : '' }} bg-secondary text-light">
                      <td class="border border-light bg-dark">{{ $loop->iteration }}</td>
                      <td class="border border-light">{{ $data->name }}</td>
                      <td class="border border-light">{{ $data->slug }}</td>
                      <td class="border border-light">{{ $data->subCategory->name }}</td>
                      <td class="border border-light">{{ $data->createdBy->name}}</td>
                      <td class="border border-light bg-dark">
                        <button class="btn btn-sm btn-warning" onclick="document.getElementById('brandVisibilityForm{{ $data->id }}').submit();">
                          <i class="fas {{ $data->brand_visibility == 1 ? 'fa-eye' :'fa-eye-slash' }} px-2"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModalCenter"><i class="far fa-edit px-2"></i></button>

                        {{-- Visibility form --}}
                        <form id="brandVisibilityForm{{$data->id}}" method="post" action="{{ url($role,['inventory','brand','visibility']) }} " class="d-none">
                          @csrf
                          <input type="hidden" name="subCategoryVisilibityId" value=" {{$data->id}} ">
                        </form>





                       @include('backend.inventory.categoryUpdateModal')





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