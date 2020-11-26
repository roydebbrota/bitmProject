


<!-- Sub-Category Update Modal -->
<div class="modal fade" id="subCategoryUpdateModal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="exampleModalLongTitle"><span class="text-danger">{{$data->name}}</span> Update </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @error('updateCategoryId .'.$data->id) 
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Holy guacamole!</strong> You should check in on some of those fields below.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @enderror
        <form action=" {{ url($role,['inventory','sub_category','update']) }} " method="post" class="row justify-content-center">
          @csrf
          <input type="hidden" name="updateSubCategoryId[{{ $data->id }}]" value="{{ $data->id }} ">
          <div class="form -group">
            <input type="text" name="u_subCategoryName[{{ $data->id }}]" value="{{old('u_subCategoryName.'.$data->id) ?? $data->name }} " class="form-control  @error('u_subCategoryName.'.$data->id) is-invalid @enderror" placeholder="Category Name">

              @error('u_subCategoryName.'.$data->id) 
                <span class="invalid-feedback">{{$message}}</span>
              @enderror
          </div>
          <button class="btn btn-sm btn-danger">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>
@push('script')
@if(Session::has('modalError'))
<script>
  $('#{{session("modalError ")}}').modal('show');
</script>
@endif 
@endpush