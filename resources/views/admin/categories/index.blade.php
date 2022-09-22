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
                        <span class="mr-2">Categories</span>
                        <i class="mdi mdi-sort-variant"></i>
                    </div>
                </h4>
                </p>
                <div class="table-responsive">
                    <table class="table">
                    <thead>
                        <tr>
                            <th class="text text-white">Name</th>
                            <th class="text text-white">Created At</th>
                            <th class="text text-white">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{$category->name}}</td>
                            <td>{{$category->created_at->diffForHumans()}}</td>
                            <td class="d-flex flex">
                                <a href="{{route('category.edit',$category->id)}}" 
                                    class="badge badge-info mr-2"
                                >
                                    <i class="mdi mdi-grease-pencil"></i>
                                </a>
                                
                                <a 
                                    onclick="return confirm('Are you Sure Delete {{$category->name}}')"
                                    href="{{route('category.delete',$category->id)}}"
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
    </div>
</div>

@endsection