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
                        <span class="mr-2">Mail</span>
                        <div class="d-flex">
                            <span class="mr-2">({{$mail->id}})</span>
                            <a href="{{route('mails')}}">
                                <i class="mdi mdi-keyboard-return"></i>
                            </a>
                        </div>
                    </div>
                </h4>
                <hr><br>
                

                <div class="mb-3">
                    <h2 class="mb-3">Mail Body</h2>
                    <hr class="mb-2">
                    <b class="display-4">{{$mail->bio}}</b>
                </div>
                
                <hr class="mb-3">    

                <div class="d-flex mb-3"> 
                    <b class="badge badge-danger mr-2">User : </b>  
                    <div>{{$mail->name}}</div>
                </div>

                <div class="d-flex mb-3"> 
                    <b class="badge badge-danger mr-2">User Email : </b>  
                    <div>{{$mail->email}}</div>
                </div>

                <div class="d-flex mb-3"> 
                    <b class="badge badge-danger mr-2">Subject : </b>  
                    <div>{{$mail->subject}}</div>
                </div>
                
                <div class="d-flex mb-3">
                  <b class="badge badge-danger mr-2">Dated : </b>  
                  <div>{{$mail->created_at->diffForHumans()}}</div>
                </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection