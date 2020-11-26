

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action=" {{ url($role,['inventory','category','update']) }} " method="post" class="row justify-content-center">
          @csrf
          <input type="hidden" name="updateCategoryId" value="{{ $data->id }} ">
          <div class="input-group">
            <input type="text" name="u_categoryName" value="{{old('u_categoryName') ?? $data->name }} " class="form-control @error('u_categoryName') is-invalid @enderror" placeholder="Category Name">

              @error('categoryName') 
                <span class="invalid-feedback">{{$message}}</span>
              @enderror
          </div>
          <button class="btn btn-sm btn-danger">Update</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>