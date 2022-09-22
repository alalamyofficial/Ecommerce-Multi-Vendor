@extends('home.userpage')
@section('site')

<div class="main-panel">
    <div class="content-wrapper">  
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <h4 class="card-title">
                    <div class="d-flex">
                        <h2 class="mr-2 display-4">Product</h2>
                        <div class="d-flex">
                            <span class="mr-2 display-4">{{$product->title}}</span>
                            <a href="{{route('products')}}">
                                <i class="mdi mdi-keyboard-return"></i>
                            </a>
                        </div>
                    </div>
                </h4>
                <hr><br>
                
                <div class="mb-3">
                    <img class="item img-responsive" 
                    src="{{asset($product->image)}}" 
                    alt="{{$product->title}}">
                </div>

                <div class="d-flex mb-3"> 
                    <b class="badge badge-danger mr-2">Category : </b>  
                    <div>{{$product->category}}</div>
                </div>

                <div class="d-flex mb-3">
                  <b class="badge badge-danger mr-2">Quantity : </b>  
                  <div>{{$product->quantity}}</div>
                </div>

                <div class="d-flex mb-3">
                  <b class="badge badge-danger mr-2">Price : </b>  
                    @if($product->discount_price != null)
                            <h6 style="color:red">
                                $ {{$product->discount_price}}
                            </h6>
                            <h6 
                                class="mr-2 ml-2" 
                                style="text-decoration: line-through;">
                                $ {{$product->price}}
                            </h6>
                    @else    
                            <h6 style="color:red">
                                $ {{$product->price}}
                            </h6>
                    @endif
                </div>


                <hr><br>
                <div class="mb-3">
                    <h2 class="display-4 mb-3">Description</h2>
                    <b class="display-6">{{$product->description}}</b>
                </div>


                <div class="d-flex mb-3">
                  <b class="badge badge-danger mr-2">Published : </b>  
                  <div>{{$product->created_at->diffForHumans()}}</div>
                </div>


                 <div class="mt-5">  
                    <form action="{{route('add_to_cart',$product->id)}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-3 ml-4 mt-1">
                                <input type="number" name="quantity" value="1" min="1">
                            </div>
                            <div class="col-md-3 mr-1">
                                <input type="submit" value="Add To Cart">
                            </div>
                        </div>
                    </form>
                 </div>   

                </div>
            </div>
        </div>
    </div>
</div>


@endsection