@extends('home.userpage')
@section('site')


<div class="container p-5">

    <h2 class="mt-3 mb-3 display-4">Result ({{count($products)}})</h2>
    <hr class="mb-3">

    @forelse($products as $product)
        <div class="col-sm-6 col-md-4 col-lg-4">
            <div class="box mb-3 mt-2" 
                style="border: 2px solid black; width:600px"
                >

                <div class="d-flex">
                    <div class="img-box mr-4">
                        <img src="{{asset($product->image)}}" class="img-responsive" width="100px">
                    </div>
                    <div class="detail-box">

                        <a href="{{route('product_details',$product->title)}}" 
                            class="option2 mb-3 mt-2">
                            Product Details
                        </a>    

                        <h5>
                            {{$product->title}}
                        </h5>
                        @if($product->discount_price != null)
                            <h6 style="color:red">
                                $ {{$product->discount_price}}
                            </h6>
                            <h6 style="text-decoration: line-through;">
                                $ {{$product->price}}
                            </h6>
                        @else    
                            <h6 style="color:red">
                                $ {{$product->price}}
                            </h6>
                        @endif

                        <div class="d-flex">

                                <h6>Published : {{$product->created_at->diffForHumans()}}</h6> 
                                

                            <div class="option_container mt-4">
                                <div class="options">
                                    <form action="{{route('add_to_cart',$product->id)}}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-3 ml-4 mt-1">
                                                <input type="number" name="quantity" value="1" min="1">
                                            </div>
                                            <div class="col-md-3 mr-1">
                                                <input type="submit" value="Add To Cart" class="btn-sm">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    @empty
        <center><b>No Result Found</b></center> 

    @endforelse  
</div>


@endsection