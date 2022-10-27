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
                        <span class="mr-2">User</span>
                        <div class="d-flex">
                            <span class="mr-2">({{$user->name}})</span>
                            <a href="{{route('users')}}">
                                <i class="mdi mdi-keyboard-return"></i>
                            </a>
                        </div>
                    </div>
                </h4>
                <hr><br>
                

                <div class="mb-3">
                    <h2 class="mb-3">Address</h2>
                    <hr class="mb-2">
                    <b class="display-4">{{$user->address}}</b>
                </div>
                
                <hr class="mb-3">    

                <div class="d-flex mb-3"> 
                    <b class="badge badge-danger mr-2">Phone : </b>  
                    <div>{{$user->phone}}</div>
                </div>

                <div class="d-flex mb-3"> 
                    <b class="badge badge-danger mr-2">Email : </b>  
                    <div>{{$user->email}}</div>
                </div>

                <div class="d-flex mb-3"> 
                    <b class="badge badge-danger mr-2">Email Verified: </b>  
                    <div>
                        @if($user->email_verified_at != Null)
                            <b>Activated</b>
                        @else    
                            <b>Not Activated</b>
                        @endif    
                        
                    </div>
                </div>

                <div class="d-flex mb-3"> 
                    <b class="badge badge-danger mr-2">Role : </b>  
                    <div>
                        @if($user->userType == 1)
                            <b>Admin</b>
                        @elseif($user->userType == 2)
                            <b>Seller</b> 
                        @else
                            <b>Customer</b>
                        @endif           
                    </div>
                </div>
                
                <div class="d-flex mb-3">
                  <b class="badge badge-danger mr-2">Created : </b>  
                  <div>{{$user->created_at->diffForHumans()}}</div>
                </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection