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
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header d-flex">
          <h3>Inventory/Product</h3>
          <button class="btn btn-primary ml-auto" data-toggle="modal" data-target="#productModal">
            <i class="fas fa-plus-circle"></i>
          </button>
        </div>
        @if(Session::has('success') || Session::has('alert'))
        <div class="alert {{Session::has('success') ? 'alert-success' : 'alert-danger'}} alert-dismissible fade show" role="alert">
        {!! session('success').session('alert') !!}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
                <div class="card-body col-sm">
                  <table class="table table-stripped col-sm">
                    <tr class=" bg-dark text-light border border-light text-center col-sm">
                      <th class="border-light border">Sl</th>
                      <th class="border-light border">Image</th>
                      <th class="border-light border">Code</th>
                      <th class="border-light border">Name</th>
                      <th class="border-light border">Qty</th>
                      <th class="border-light border">Buy Pr</th>
                      <th class="border-light border">Sell Pr</th>
                      <th class="border-light border">Category</th>
                      <th class="border-light border">Created By</th>
                      <th class="border-light border">Brand</th>
                      <th class="border-light border">Action</th>
                    </tr>
                      @forelse($product as $data)
                    <tr class="text-center small table-sm {{$data->visibility != 1 ? 'opacity-2' : ''}} col-sm">
                      <td class="align-middle border border-light bg-dark text-light">{{$loop->iteration}}</td>
                      <td class="align-middle border border-light bg-secondary text-light"><img src="{{ asset('/') }}../storage/app/{{ $data->image }}" height="50" width="50"></td>
                      <td class="align-middle border border-light bg-secondary text-light"> {{ $data->code }} </td>
                      <td class="align-middle border border-light bg-secondary text-light"> {{ $data->name }} </td>
                      <td class="align-middle border border-light bg-secondary text-light"> {{ $data->quantity }} </td>
                      <td class="align-middle border border-light bg-secondary text-light"> {{ $data->buy }} </td>
                      <td class="align-middle border border-light bg-secondary text-light"> {{ $data->sell }} </td>
                      <td class="align-middle border border-light bg-secondary text-light"> {{ $data->category->name }} </td>
                      <td class="align-middle border border-light bg-secondary text-light"> {{ $data->createdBy->name }} </td>
                      <td class="align-middle border border-light bg-secondary text-light"> {{ $data->brand->name }} </td>
                      <td class="align-middle border border-light bg-dark text-light">
                       <button class="btn btn-sm btn-warning" >
                          <i class="fas fa-eye px-2"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" ><i class="far fa-edit px-2"></i></button>
                      </td>
                      
                    </tr>
                    @empty
                    @endforelse
                  </table>  
                </div>
            </div>
        </div>
    </div>
</div>
@include('backend.inventory.productModal')
@endsection


@push('scripts')
@if(Session::has('modalError'))
<script>
  $('#{{session("modalError")}}').modal('show');
</script>
@endif

<script>
  $('.depended').change(function(){
    var dataName = $(this).attr('name');
    var dataValue = $(this).val();
    var dataTarget = $(this).data('depend');

    axios.post("{{url($role,['inventory','dynamic','data'])}}", {
    targetName: dataName,
    targetValue: dataValue
  }).then(function (response) {
    if(dataTarget == 'productCode'){
      $('#'+dataTarget).val(response.data);
    }else{
    $('#'+dataTarget).html(response.data);
    }
    console.log(response);
  })
  .catch(function (error) {
    console.log(error);
  });
  });
</script>

@endpush