@extends('admin.home')
@section('body')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="mb-3">
            <label for="category" class="form-label">Edit Category</label>
            <form action="{{route('category.update',$category->id)}}" method="post">
                @method('PATCH')    
                @csrf
                <input type="text" 
                    name="name"
                    value="{{$category->name}}" 
                    class="form-control mb-2" 
                    placeholder="Name"
                >
                <button type="submit" class="btn btn-success">
                    <div class="d-flex">
                        <span class="mr-2">Update</span>
                        <i class="mdi mdi-forward"></i>
                    </div>
                </button>
            </form>
        </div>
    </div>
</div>

@endsection