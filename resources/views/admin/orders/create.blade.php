@extends('admin.home')
@section('body')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="mb-3">
            <label for="order" class="form-label">
                <div class="d-flex">
                    <span class="mr-2">Add Order</span>
                    <i class="mdi mdi-sort-variant"></i>
                </div>
            </label>
            <form action="{{url('create/category')}}" method="post">
                @csrf
                <input type="text" 
                    name="name" 
                    class="form-control mb-2" 
                    placeholder="Name"
                >
                <button type="submit" class="btn btn-primary">
                    <div class="d-flex">
                        <span class="mr-2">Add</span> 
                        <i class="mdi mdi-plus-circle"></i>
                    </div>
                </button>
            </form>
        </div>
    </div>
</div>

@endsection