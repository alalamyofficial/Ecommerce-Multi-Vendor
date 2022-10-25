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
                        <span class="mr-2">Order</span>
                        <div class="d-flex">
                            <span class="mr-2">({{$order->product_title}})</span>
                            <a href="{{route('orders')}}">
                                <i class="mdi mdi-keyboard-return"></i>
                            </a>
                        </div>
                    </div>
                </h4>
                <hr><br>
                
                <div class="mb-3">
                    <img class="item img-responsive" 
                    src="{{asset($order->image)}}" 
                    alt="{{$order->title}}">
                </div>

                <div class="mb-3">
                    <h2 class="mb-3">Product Description</h2>
                    <hr class="mb-2">
                    <b class="display-4">{{$order->product->description}}</b>
                </div>
                
                <hr class="mb-3">    

                <div class="d-flex mb-3"> 
                    <b class="badge badge-danger mr-2">User Phone : </b>  
                    <div>{{$order->phone}}</div>
                </div>

                <div class="d-flex mb-3"> 
                    <b class="badge badge-danger mr-2">User Email : </b>  
                    <div>{{$order->email}}</div>
                </div>

                <div class="d-flex mb-3"> 
                    <b class="badge badge-danger mr-2">User Address : </b>  
                    <div>{{$order->address}}</div>
                </div>

                <div class="d-flex mb-3">
                  <b class="badge badge-danger mr-2">Quantity : </b>  
                  <div>{{$order->quantity}}</div>
                </div>

                <div class="d-flex mb-3">
                  <b class="badge badge-danger mr-2">Price : </b>  
                  <div>$ {{$order->price}}</div>
                </div>

                <div class="d-flex mb-3">
                  <b class="badge badge-danger mr-2">User : </b>  
                  <div>{{$order->name}}</div>
                </div>

                <div class="d-flex mb-3">
                  <b class="badge badge-danger mr-2">Payment Status : </b>  
                  <div>{{$order->payment_status}}</div>
                </div>

                <div class="d-flex mb-3">
                  <b class="badge badge-danger mr-2">Delivery Status : </b>  
                  <div>{{$order->delivery_status}}</div>
                </div>
                
                <div class="d-flex mb-3">
                  <b class="badge badge-danger mr-2">Dated : </b>  
                  <div>{{$order->created_at->diffForHumans()}}</div>
                </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection