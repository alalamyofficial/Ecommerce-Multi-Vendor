@extends('home.userpage')
@section('site')

<div class="container mt-3 mb-3">
    <div class="row jusify-content-center">

        @if(count($orders) > 0)
        <div class="table-responsive">
            <table class="table">
            <thead>
                <tr>
                    <th class="">Name</th>
                    <th class="">Product Title</th>
                    <th class="">Quantity</th>
                    <th class="">Price</th>
                    <th class="">Image</th>
                    <th class="">Delivery Status</th>
                    <th class="">Dated At</th>
                    <th class="">Action</th>
                </tr>
            </thead>
            <tbody id="myTable">
                @foreach($orders as $order)
                <tr>
                    <td><small>{{$order->name}}</small></td>
                    <td>{{$order->product_title}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>$ {{$order->price}}</td>
                    <td>
                        <a href="{{route('product_details',$order->product->title)}}">
                            <img src="{{asset($order->image)}}" 
                                alt="{{$order->name}}"
                                width="100">
                        </a>
                    </td>
                    <td>{{$order->delivery_status}}</td>
                    <td><small>{{$order->created_at->diffForHumans()}}</small></td>
                    <td>
                        @if($order->delivery_status == 'Processing')
                        <a 
                            onclick="return confirm('Are you Sure Cancel This Order')"
                            href="{{route('order.cancel',$order->id)}}"
                            class="badge badge-danger"
                            >
                            <span title="Cancel">X</span>
                        </a>
                        @else
                            <b>Not Allowded</b>
                        @endif
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
        @else
            <center style="text-align:center"><b>No Orders Found</b></center>
        @endif    

    </div>
</div>

@endsection