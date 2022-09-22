@extends('home.userpage')
@section('site')

<div class="container mt-3 mb-3">
    <div class="row jusify-content-center">
      @if(count($cart_details) > 0)  
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <h4 class="card-title">Cart Details</h4>
                </p>
                <div class="table-responsive">
                    <table class="table">
                    <thead>
                        <tr>
                        <th>Product Title</th>
                        <th>Product Quantity</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $totalPrice = 0; ?>

                        @foreach($cart_details as $detail)
                            <tr>
                            <td>{{$detail->product_title}}</td>
                            <td>{{$detail->quantity}}</td>
                            <td>$ {{$detail->price}}</td>
                            <td>
                                <img src="{{asset($detail->image)}}" 
                                     alt="{{$detail->product_title}}"
                                     width="120px" height="80px">
                            </td>
                            <td><a href="{{route('remove.item.cart',$detail->id)}}" class="badge badge-danger">X</a></td>
                            </tr>

                        <?php $totalPrice = $totalPrice + $detail->price; ?>

                        @endforeach
                    </tbody>
                    </table>

                    <hr><br>

                    <div class="d-flex">
                        <b class="badge badge-info mr-2">Total Price : </b>  
                        <span class="">$ {{$totalPrice}}</span>
                    </div>

                </div>
                </div>
            </div>
            <div class="mt-3">
                <h2 class="mb-3">Proceed to Order</h2>

                <div class="d-flex">
                    <a  class="alert alert-dark"
                        style="background-color: #1a1919; 
                            color: white;" 
                        href="{{route('cash.order')}}"
                    >
                        Cash On Delivery
                    </a>

                    <a  class="alert alert-dark"
                        style="background-color: #415ecb; 
                            color: white;" 
                        href="{{route('stripe.order',$totalPrice)}}"
                    >
                        Pay Using Card
                    </a>
                </div>
            </div>
        </div>
      @else
        <strong 
            style="text-align:center; width:1100px; height:300px !important" 
            class="mt-5 mb-5">
            You Have No Items
        </strong>
      @endif  
    </div>
</div>



@endsection