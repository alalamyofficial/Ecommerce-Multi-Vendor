@extends('admin.home')
@section('body')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="mb-3">
            <label for="product" class="form-label">Edit Product</label>
            <form action="{{route('product.update',$product->id)}}" 
                    method="post"
                    enctype="multipart/form-data">
                @method('PATCH')    
                @csrf
                <input type="text" 
                    name="title"
                    value="{{$product->title}}" 
                    class="form-control mb-2" 
                    placeholder="Title"
                >

                <textarea name="description" 
                    class="form-control mb-2"
                    id="" cols="30" rows="10"
                >{{$product->description}}</textarea>

                <div class="d-flex mb-3">
                    <input type="file" 
                        name="image" 
                        class="form-control file-upload-info" 
                        placeholder="image"
                    >
                    <img src="{{asset($product->image)}}" 
                            alt="{{$product->title}}"
                            class="rounded-circle"
                            width="100px">
                </div>
                
                <select name="category" class="form-control mb-2" 
                id="">
                    <option value="{{$product->category}}" selected="">
                        {{$product->category}}
                    </option>

                    @foreach($categories as $category)
                        <option value="{{$category->name}}">
                            {{$category->name}}
                        </option>
                    @endforeach
                </select>
                

                <input type="number" 
                    name="quantity" 
                    value="{{$product->quantity}}"
                    class="form-control mb-2" 
                    placeholder="quantity"
                >
                <input type="text" 
                    name="price" 
                    value="{{$product->price}}"
                    class="form-control mb-2" 
                    placeholder="Price"
                >
                <input type="text" 
                    name="dis_price"
                    value="{{$product->discount_price}}" 
                    class="form-control mb-2" 
                    placeholder="Write a Discount To Apply"
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