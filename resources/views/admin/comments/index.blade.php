@extends('admin.home')
@section('body')

<div class="main-panel">
    <div class="content-wrapper">
    @if(count($comments)>0)  
        @include('admin.flash_message')
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <h4 class="card-title">
                    <div class="d-flex">
                        <span class="mr-2">Comments</span>
                        <i class="mdi mdi-comment"></i>
                    </div>
                </h4>
                </p>
                <div class="table-responsive">
                    <table class="table">
                    <thead>
                        <tr>
                            <th class="text text-white">User Name</th>
                            <th class="text text-white">Product</th>
                            <th class="text text-white">Comment</th>
                            <th class="text text-white">Created At</th>
                            <th class="text text-white">Action</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        @foreach($comments as $comment)
                        <tr>
                            <td>{{$comment->name}}</td>
                            <td>{{$comment->user_id}}</td>
                            <td>{{$comment->comment}}</td>
                            <td>{{$comment->created_at->diffForHumans()}}</td>
                            <td class="d-flex flex">
                                <a 
                                    onclick="return confirm('Are you Sure Delete {{$comment->name}}')"
                                    href="{{route('comment.delete',$comment->id)}}"
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
        <center>No Comments Found</center> 
    @endif       
    </div>
</div>

@endsection