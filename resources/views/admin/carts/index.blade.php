@extends('admin.home')
@section('body')

<div class="main-panel">
    <div class="content-wrapper">
    @if(count($carts)>0)  
        @include('admin.flash_message')
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <h4 class="card-title">
                    <div class="d-flex">
                        <span class="mr-2">Carts</span>
                        <i class="mdi mdi-sort-variant"></i>
                    </div>
                </h4>
                </p>
                <div class="table-responsive">
                    <table class="table">
                    <thead>
                        <tr>
                            <th class="text text-white">Name</th>
                            <th class="text text-white">Email</th>
                            <th class="text text-white">Created At</th>
                            <th class="text text-white">Action</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        @foreach($carts as $cart)
                        <tr>
                            <td>{{$cart->name}}</td>
                            <td>{{$cart->email}}</td>
                            <td>{{$cart->created_at->diffForHumans()}}</td>
                            <td class="d-flex flex">

                                <a href="{{route('carts.show',$cart->id)}}" 
                                    class="badge badge-success mr-2"
                                >
                                    <i class="mdi mdi-eye"></i>
                                </a>

                                <a 
                                    onclick="return confirm('Are you Sure Delete {{$cart->name}}')"
                                    href="{{route('cart.delete',$cart->id)}}"
                                    class="badge badge-danger">
                                    <i class="mdi mdi-window-close"></i>
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
        <center>Carts Are Empty</center>    
    </div>
</div>

@endsection