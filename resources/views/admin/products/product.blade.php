@extends('admin.home')
@section('body')

<div class="main-panel">
    <div class="content-wrapper">  
        @include('admin.flash_message')
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <h4 class="card-title">
                    <div class="d-flex">
                        <span class="mr-2">Product</span>
                        <div class="d-flex">
                            <span class="mr-2">{{$product->title}}</span>
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

                <div class="mb-3">
                    <h2 class="mb-3">Description</h2>
                    <b class="display-4">{{$product->description}}</b>
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
                  <div>$ {{$product->price}}</div>
                </div>

                <div class="d-flex mb-3">
                  <b class="badge badge-danger mr-2">Discount Price: </b>  
                  <div>$ {{$product->discount_price}}</div>
                </div>
                
                <div class="d-flex mb-3">
                  <b class="badge badge-danger mr-2">Published : </b>  
                  <div>{{$product->created_at->diffForHumans()}}</div>
                </div>



                </div>
            </div>
        </div>
    </div>
</div>

@endsection