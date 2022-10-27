@extends('admin.home')
@section('body')

<div class="main-panel">
    <div class="content-wrapper"> 
    @if(count($mails) > 0) 
        @include('admin.flash_message')
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <h4 class="card-title">
                    <div class="d-flex">
                        <span class="mr-2">Mails</span>
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
                        @foreach($mails as $mail)
                        <tr>
                            <td>{{$mail->name}}</td>
                            <td>{{$mail->email}}</td>
                            <td>{{$mail->created_at->diffForHumans()}}</td>
                            <td class="d-flex flex">

                                <a href="{{route('mail.show',$mail->id)}}" 
                                    class="badge badge-success mr-2"
                                >
                                    <i class="mdi mdi-eye"></i>
                                </a>

                                <a 
                                    onclick="return confirm('Are you Sure Delete {{$mail->name}}')"
                                    href="{{route('mail.delete',$mail->id)}}"
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
        <center>No Mails Found</center>
    @endif        
    </div>
</div>

@endsection