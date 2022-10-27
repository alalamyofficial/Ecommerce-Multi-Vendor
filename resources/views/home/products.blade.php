<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our <span>products</span>
            </h2>
        </div>

        <div class="row">
        @foreach($products as $product)
            <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="box">
                    <div class="option_container">
                    <div class="options">
                        <!-- <a href="" class="option1">
                        Add To Cart
                        </a> -->

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

                        <a href="{{route('product_details',$product->title)}}" class="option2">
                        Product Details
                        </a>
                    </div>
                    </div>
                    <div class="img-box">
                    <img src="{{asset($product->image)}}" alt="">
                    </div>
                    <div class="detail-box mb-3">
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
                    </div>
                    By  
                    @if($product->user->userType == 1)
                        <b><i>
                            Famms <i class='fas fa-check'></i><br>
                            <small>Free Shipping</small> 
                        </i></b>
                    @elseif($product->user->userType == 2)
                    
                        <b><i>{{$product->user->name}}</i></b>

                    @else
                        <b><i>{{$product->user->name}}</i></b>
                    @endif    
                </div>
            </div>
        @endforeach    

        </div>
        <div class="btn-box">
            <a href="{{route('products.all')}}">
            View All products
            </a>
        </div>
    </div>
</section>