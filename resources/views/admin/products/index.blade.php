@extends('admin.home')
@section('body')

<div class="main-panel">
    <div class="content-wrapper">
    @if(count($products)>0)  
        @include('admin.flash_message')
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <h4 class="card-title">
                    <div class="d-flex">
                        <span class="mr-2">Products</span>
                        <i class="mdi mdi-hanger"></i>
                    </div>
                </h4>
                </p>
                <div class="table-responsive">
                    <table class="table">
                    <thead>
                        <tr>
                            <th class="text text-white">Title</th>
                            <th class="text text-white">Description</th>
                            <th class="text text-white">Image</th>
                            <th class="text text-white">Price</th>
                            <th class="text text-white">Action</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        @foreach($products as $product)
                        <tr>
                            <td>{{$product->title}}</td>
                            <td>{{\Str::limit($product->description,30)}}</td>
                            <td>
                                <img src="{{asset($product->image)}}" alt="{{$product->title}}"
                                class="rounded-circle">
                            </td>
                            <td>$ {{$product->price}}</td>
                            <td class="d-flex flex">
                                <a href="{{route('product.edit',$product->id)}}" 
                                    class="badge badge-info mr-2"
                                >
                                    <i class="mdi mdi-grease-pencil"></i>
                                </a>
                                <a href="{{route('single_product',$product->title)}}" 
                                    class="badge badge-success mr-2"
                                >
                                    <i class="mdi mdi-eye"></i>
                                </a>
                                <a onclick="return confirm('Are you Sure Delete {{$product->title}}')" 
                                    href="{{route('product.delete',$product->id)}}"
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
        <center>No Products Found</center>
    @endif        
    </div>
</div>

@endsection