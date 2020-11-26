@extends('frontend.layouts.app')
@section('content')



 

@endsection
 <div class="flex-center position-ref full-height">
        <section id="mainSlider" class="p-0">
            <div class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#mainSlider" data-slide-to="0" class="active"></li>
                    <li data-target="#mainSlider" data-slide-to="1"></li>
                    <li data-target="#mainSlider" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="images/bigBanner/bigbanner1.jpg" style="width:auto;height:460px;" alt="First slide">
                        <div class="carousel-caption d-none d-md-block d-block ">
                            <h5 class="">First Slider</h5>
                            <p class="">Contrary to popular belief, Lorem Ipsum is not simply random text. 
                            It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.
                            </p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="images/bigBanner/bigbanner2.jpg" style="width:auto;height:460px;" alt="Second slide">
                        <div class="carousel-caption d-none d-md-block d-block">
                            <h5 class="">First Slider</h5>
                            <p class="">Contrary to popular belief, Lorem Ipsum is not simply random text. 
                            It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.
                            </p>
                            <button type="button" class="btn btn-primary btn-sm">Small button</button>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="images/bigBanner/bigbanner3.jpg" style="width:auto;height:460px;" alt="Third slide">
                        <div class="carousel-caption d-none d-md-block d-block">
                            <h5 class="">First Slider</h5>
                            <p class="">Contrary to popular belief, Lorem Ipsum is not simply random text. 
                            It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.
                            </p>
                            <button type="button" class="btn btn-primary btn-sm">Small button</button>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#mainSlider" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#mainSlider" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </section>
                                                        <!-- shop part -->
            <section id="myShop">
                <div class="container" >
                <h1 class="display-4 text-center font-weight-bold text-danger text-uppercase">My <span class="text-success">Shop</span> </h1>
                <div class="row">
                    <div class="col-md-6 col-sm-8 h-100">
                        <div class="carousel slide carousel-fade" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="images/banner-shirt/shirt-1.jpg" style="width:200px;height:250px;" alt="First slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="images/banner-shirt/shirt-2.jpeg" style="width:200px;height:250px;" alt="Second slide">
                                    
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="images/banner-shirt/shirt-3.jpg" style="width:auto;height:250px;" alt="Third slide">
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    @forelse($product as $data)
                    <div class="col-md-3 col-sm-4 mb-3">
                        <div class="card text-center" style="width;">
                            <img class="card-img-top" src="{{ asset('/') }}../storage/app/{{ $data->image }}" style="width:auto;height:250px;" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{ $data->name }}</h5>
                                <p class="card-text "><b class="text-info">Price:</b>{{$data->sell}}/=</p>
                            </div>
                            <div class="card-footer p-0">
                                <div class="btn-group w-100" role="group" aria-label="Basic example">
                                    <button type="button" onclick="document.getElementById('productSelectForm{{$data->id}}').submit();" class="btn btn-light btn-outline-success">Cart</button>
                                    <button type="button" class="btn btn-light btn-outline-info" data-toggle="modal" data-target="#productDelail1{{ $data->id}}" >Details</button>
                                </div>
                            </div>
                        </div>
                        {{-- product details modal  --}}
                        <div class="modal fade" id="productDelail1{{ $data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <img src="{{ asset('/') }}../storage/app/{{ $data->image }}" height="400px" alt="">
                                            </div>
                                            <div class="col-sm-6">
                                                <p>
                                                    <b class="text-info">Name: </b>{{ $data->name}}
                                                </p>
                                                <p>
                                                    <b class="text-info">Brand Name: </b>{{ $data->brand->name}}
                                                </p>

                                                <p><b class="text-info">Code: </b>{{ $data->code }} </p>
                                                <p><b class="text-info">Details: </b> {{$data->details}}</p>
                                                <p><b class="text-info">Price: </b>{{ $data->sell }}/= </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Product Form --}}
                            <form id="productSelectForm{{$data->id}}" method="post" action="{{ url('shop/product/select') }} " class="d-none">
                              @csrf
                              <input type="hidden" name="productId" value=" {{$data->id}} ">
                              <input type="hidden" name="productCode" value=" {{$data->code}} ">
                            </form>
                    </div>
                    @empty
                    @endforelse
                            
                </div>
                        
            </div>
        </div>
    </div>
</section>

