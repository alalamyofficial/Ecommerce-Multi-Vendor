@extends('admin.home')
@section('body')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="mb-3">
            <label for="product" class="form-label">
                <div class="d-flex">
                    <span class="mr-2">Add Product</span>
                    <i class="mdi mdi-hanger"></i>
                </div>
            </label>
            <form action="{{route('product.store')}}" method="post"
                enctype="multipart/form-data">
                @csrf
                <input type="text" 
                    name="title" 
                    class="form-control mb-2" 
                    placeholder="Title"
                >
                <textarea name="description" 
                    class="form-control mb-2"
                    id="" cols="30" rows="10"
                ></textarea>

                <input type="file" 
                    name="image" 
                    class="form-control file-upload-info mb-2" 
                    placeholder="image"
                >
                
                <select name="category" class="form-control mb-2" 
                id="">
                    <option value="tech">----Add Category----</option>
                    @foreach($categories as $category)
                        <option value="{{$category->name}}">
                            {{$category->name}}
                        </option>
                    @endforeach
                </select>
                

                <input type="number" 
                    name="quantity" 
                    class="form-control mb-2" 
                    placeholder="quantity"
                >
                <input type="text" 
                    name="price" 
                    class="form-control mb-2" 
                    placeholder="Price"
                >
                <input type="text" 
                    name="dis_price" 
                    class="form-control mb-2" 
                    placeholder="Write a Discount To Apply"
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