@extends('admin.home')
@section('body')

<div class="main-panel">
    <div class="content-wrapper"> 
    @if(count($orders)>0) 
        @include('admin.flash_message')
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <h4 class="card-title">
                    <div class="d-flex">
                        <span class="mr-2">All Order</span>
                        <i class="mdi mdi-shopping"></i>
                    </div>
                </h4>
                </p>
                <div class="table-responsive">
                    <table class="table">
                    <thead>
                        <tr>
                            <th class="text text-white">Name</th>
                            <th class="text text-white">Product Title</th>
                            <th class="text text-white">Quantity</th>
                            <th class="text text-white">Price</th>
                            <th class="text text-white">Image</th>
                            <th class="text text-white">Delivery Status</th>
                            <th class="text text-white">Dated At</th>
                            <th class="text text-white">Action</th>
                            <th class="text text-white">Print Pdf</th>
                            <th class="text text-white">Send Mail</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        @foreach($orders as $order)
                        <tr>
                            <td><small>{{$order->name}}</small></td>
                            <td>{{$order->product_title}}</td>
                            <td>{{$order->quantity}}</td>
                            <td>$ {{$order->price}}</td>
                            <td><img src="{{asset($order->image)}}" alt="{{$order->name}}"></td>
                            <td>{{$order->delivery_status}}</td>
                            <td><small>{{$order->created_at->diffForHumans()}}</small></td>
                            <td class="d-flex flex">

                                @if($order->delivery_status == 'Processing')
                                <a 
                                    onclick="return confirm('Are you Sure Product is Delivered')"
                                    href="{{route('order.delivered',$order->id)}}" 
                                    class="badge badge-primary mr-2"
                                >
                                    <i class="mdi mdi-car" title="Delivered"></i>
                                </a>
                                @else
                                <button type="button" style="width:33px; height:30px"
                                    class="btn btn-outline-secondary btn-rounded btn-icon mr-2">
                                    <i class="mdi mdi-check text-info ml-1"></i>
                                </button>
                                    
                                @endif
                                <a href="{{route('single_order',$order->id)}}" 
                                    class="badge badge-success mr-2"
                                >
                                    <i class="mdi mdi-eye"></i>
                                </a>
                                <a 
                                    onclick="return confirm('Are you Sure Delete {{$order->name}}')"
                                    href="{{route('order.delete',$order->id)}}"
                                    class="badge badge-danger"
                                    >
                                    <i class="mdi mdi-window-close" title="Delete"></i>
                                </a>
                                
                            </td>
                            <td>
                            <a 
                                type="button"
                                href="{{route('print_pdf',$order->id)}}" 
                                class="btn btn-info btn-icon-text btn-sm"> 
                                Print 
                                <i class="mdi mdi-printer btn-icon-append"></i>
                            </a>
                            </td>

                            <td>

                                <a 
                                    href="{{route('send_mail',$order->id)}}" 
                                    class="text-danger btn-sm">
                                    <i class="mdi mdi-google-plus mt-3"></i>
                                </a>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    @else
        <center>No Orders Found</center>
    @endif    
    </div>
</div>

@endsection