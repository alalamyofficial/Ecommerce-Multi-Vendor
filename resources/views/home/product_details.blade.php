@extends('home.userpage')
@section('site')

<div class="main-panel">
    <div class="content-wrapper">  
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <h4 class="card-title">
                    <div class="d-flex">
                        <h2 class="mr-2 display-4">Product</h2>
                        <div class="d-flex">
                            <span class="mr-2 display-4">{{$product->title}}</span>
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
                    @if($product->discount_price != null)
                            <h6 style="color:red">
                                $ {{$product->discount_price}}
                            </h6>
                            <h6 
                                class="mr-2 ml-2" 
                                style="text-decoration: line-through;">
                                $ {{$product->price}}
                            </h6>
                    @else    
                            <h6 style="color:red">
                                $ {{$product->price}}
                            </h6>
                    @endif
                </div>


                <hr><br>
                <div class="mb-3">
                    <h2 class="display-4 mb-3">Description</h2>
                    <b class="display-6">{{$product->description}}</b>
                </div>


                <div class="d-flex mb-3">
                  <b class="badge badge-danger mr-2">Published : </b>  
                  <div>{{$product->created_at->diffForHumans()}}</div>
                </div>


                 <div class="mt-5">  
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
                 </div>   

                
                <hr>

                 <div class="mt-3 mb-4">
                    <div>
                        <strong class="mt-3 mb-4">Write a Comment</strong>
                        <form action="{{route('comment.create')}}" method="POST">
                            @csrf
                            <textarea 
                                name="comment" 
                                id="" 
                                cols="30" 
                                rows="10"
                                class="form-control mb-2"
                            >
                            </textarea>

                            <input type="submit" class="" 
                                    value="Comment"
                                    style=" background-color: #4bdb4b;
                                            color: white;
                                            padding: 5px;
                                            border-radius: 25px;
                                            font-family: cursive;
                                            text-align: center;
                                        "
                            >
                        </form>
                    </div>

                </div>

                <hr class="mt-3">

                <div class="comments mt-3 mb-3">
                    <h3 class="mb-3">All Comments</h3>

                    @foreach($comments as $comment)

                    <div class="main-comment p-3" style="border: 1px solid #877e7e;">
                        <div class="d-flex">
                            <b class="mr-3">{{$comment->name}}</b>
                            <small class="mt-1">{{$comment->created_at->diffForHumans()}}</small>
                        </div>
                        <p>{{$comment->comment}}</p>
                        <a  class="mb-2" 
                            href="javascript::void(0)"
                            onclick="reply(this)"
                            data-commentid="{{$comment->id}}"
                            style="color:blue"
                        >
                            Reply
                        </a>
                    </div>

                        @foreach($replies as $reply)

                            @if($reply->comment_id == $comment->id)
                                <div class="reply ml-4 p-3 mt-2" style="
                                            border: 1px solid #877e7e;
                                            border-radius:10px">
                                    <b>{{$reply->name}}</b>
                                    <p>{{$reply->reply}}</p>
                                    <a  class="mb-2" 
                                        href="javascript::void(0)"
                                        onclick="reply(this)"
                                        data-commentid="{{$comment->id}}"
                                        style="color:blue"
                                    >
                                        Reply
                                    </a>
                                </div>
                            @endif    
                        @endforeach

                    <br>
                    <div style="display:none" class="replyDiv">

                        <form action="{{route('reply.create')}}" method="post">
                            @csrf
                            <input type="text" name="commentId" id="commentId" hidden="">
                            <textarea name="reply"
                                    cols="30" 
                                    rows="3"
                                    placeholder="Write Something"
                            >
                            </textarea>
                            <br>
                            <button class="btn btn-primary" 
                                type="submit">
                                Reply    
                            </button>
                            <a class="btn btn-primary" 
                                type="submit" 
                                href="javascript::void(0)"
                                onclick="reply_close(this)"
                            >
                                X    
                            </a>
                        </form>
                    </div>
                    @endforeach

                </div>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection