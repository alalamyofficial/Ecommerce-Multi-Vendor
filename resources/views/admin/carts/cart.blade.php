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
                        <span class="mr-2">Cart => </span>
                        <div class="d-flex">
                            <span class="mr-2">Product ({{$cart->product_title}})</span>
                            <a href="{{route('carts')}}">
                                <i class="mdi mdi-keyboard-return"></i>
                            </a>
                        </div>
                    </div>
                </h4>
                <hr><br>
                
                <div class="mb-3 mt-2">
                    <img src="{{asset($cart->image)}}" alt="{{$cart->name}}">
                </div>


                <div class="mb-3">
                    <h2 class="mb-3">Address</h2>
                    <hr class="mb-2">
                    <b class="display-4">{{$cart->address}}</b>
                </div>
                
                <hr class="mb-3">    


                <div class="d-flex mb-3"> 
                    <b class="badge badge-danger mr-2">User : </b>  
                    <div>{{$cart->name}}</div>
                </div>

                <div class="d-flex mb-3"> 
                    <b class="badge badge-danger mr-2">Phone : </b>  
                    <div>{{$cart->phone}}</div>
                </div>

                <div class="d-flex mb-3"> 
                    <b class="badge badge-danger mr-2">Email : </b>  
                    <div>{{$cart->email}}</div>
                </div>
                
                <div class="d-flex mb-3"> 
                    <b class="badge badge-danger mr-2">Price : </b>  
                    <div>{{$cart->price}}</div>
                </div>

                <div class="d-flex mb-3"> 
                    <b class="badge badge-danger mr-2">Quantity : </b>  
                    <div>{{$cart->quantity}}</div>
                </div>

                <div class="d-flex mb-3">
                  <b class="badge badge-danger mr-2">Dated : </b>  
                  <div>{{$cart->created_at->diffForHumans()}}</div>
                </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection