<!-- Modal -->
<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Add New Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" class="" enctype="multipart/form-data">
        @csrf
          <div class="form-group">
            <label for="categoryName">Category Name</label>
            <select name="categoryName" id="categoryName" class="form-control @error('categoryName') is-invalid @enderror depended" data-depend="subCategoryName">
              <option>Select Category</option>
              @forelse($category as $categData)
              <option value="{{$categData->id}}" {{$categData->id == old('categoryName') ? 'selected' : ''}}>{{$categData->name}}</option>
              @empty
              <option>Sorry, No Category Available</option>
              @endforelse
            </select>
            @error('categoryName')
              <span class="invalid-feedback">{{$message}}</span>
            @enderror
          </div>
           @if(old('categoryName'))
          <div class="form-group">
            <label for="subCategoryName">Sub-Category Name</label>
            <select name="subCategoryName" id="subCategoryName" class="form-control @error('subCategoryName') is-invalid @enderror depended" data-depend="brandName">

              @forelse($subCategory->where('category_id',old('categoryName')) as $subData)

              <option value="{{$subData->id}}" {{$subData->id == old('subCategoryName') ? 'selected' : ''}}>{{$subData->name}}</option>
              @empty
              <option>Pls Select Category First</option>
              @endforelse


            </select>
            @error('subCategoryName')
              <span class="invalid-feedback">{{$message}}</span>
            @enderror
          </div> 
        
          @else
          <div class="form-group">
            <label for="subCategoryName">Sub-Category Name</label>
            <select name="subCategoryName" id="subCategoryName" class="form-control @error('subCategoryName') is-invalid @enderror depended" data-depend="brandName">
              <option>Pls Select Category First</option>
            </select>
            @error('subCategoryName')
              <span class="invalid-feedback">{{$message}}</span>
            @enderror
          </div>
           @endif

           @if(old('subCategoryName'))
          <div class="form-group">
            <label for="brandName">Brand Name</label>
            <select name="brandName" id="brandName" class="form-control @error('brandName') is-invalid @enderror depended" data-depend="productCode">

              @forelse($brand->where('sub_category_id',old('subCategoryName')) as $brandData)

              <option value="{{$brandData->id}}" {{$brandData->id == old('brandName') ? 'selected' : ''}}>{{$brandData->name}}</option>
              @empty
              <option>Pls Select Sub Category First</option>
              @endforelse


            </select>
            @error('brandName')
              <span class="invalid-feedback">{{$message}}</span>
            @enderror
          </div>
            @else

           <div class="form-group">
            <label for="brandName">Brand Name</label>
            <select name="brandName" id="brandName" class="form-control @error('brandName') is-invalid @enderror depended" data-depend="productCode">
              <option>Pls Select Sub-Category First</option>
            </select>
            @error('brandName')
              <span class="invalid-feedback">{{$message}}</span>
            @enderror
          </div>
           @endif

          <div class="form-group">
            <label for="productCode">Code</label>
            <input type="text" name="productCode" id="productCode" value="{{old('productCode')}}" class="form-control @error('productCode')  is-invalid @enderror " placeholder="Product Code">
            @error('productCode')
              <span class="invalid-feedback">{{$message}}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="productName">Name</label>
            <input type="text" name="productName" value="{{old('productName')}}" class="form-control @error('productName')  is-invalid @enderror" placeholder="Product Name">
            @error('productName')
              <span class="invalid-feedback">{{$message}}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="productQuantity">Quantity</label>
            <input type="number" name="productQuantity" value="{{old('productQuantity')}}" class="form-control @error('productQuantity')  is-invalid @enderror" placeholder="Product Quantity">
            @error('productQuantity')
              <span class="invalid-feedback">{{$message}}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="productBuy">Buying Price</label>
            <input type="number" name="productBuy" value="{{old('productBuy')}}" class="form-control @error('productBuy')  is-invalid @enderror" placeholder="Product Buying Price">
            @error('productBuy')
              <span class="invalid-feedback">{{$message}}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="productSell">Selling Price</label>
            <input type="number" name="productSell" value="{{old('productSell')}}" class="form-control @error('productSell')  is-invalid @enderror" placeholder="Product Selling Price">
            @error('productBuy')
              <span class="invalid-feedback">{{$message}}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="productDetails">Description</label>
            <textarea name="productDetails" class="form-control @error('productDetails')  is-invalid @enderror summernote" placeholder="Product Description">{{old('productDetails')}}</textarea>
            @error('productDetails')
              <span class="invalid-feedback">{{$message}}</span>
            @enderror
          </div>
          <div class="input-group mb-3">
              <div class="custom-file">
              <input type="file" name="productImage" class="custom-file-input @error('productImage') is-invalid @enderror image" id="productImage" placeholder="" >
              <label class="custom-file-label" for="productImage">Choose file</label>
              </div>
          </div>
          <div class="w-100 mt-n3">
              @error('productImage')
                <span class="small text-danger">{{$message}}</span>
              @enderror
          </div>
          <div class="w-100 form-group text-center">
            <button class="btn btn-primary px-5 mt-3" type="submit">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@push('script')
  <script>
        $('.image').on('change',function(){
            //get the file name
            var fileName = e.target.files[0].name;
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        });
    </script>
@endpush