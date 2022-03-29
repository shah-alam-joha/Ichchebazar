@extends('backend.layouts.master')
@section('content')
<div class="main-panel">
  <div class="content-wrapper">


    <div class="card">
      <div class="card-header">
        Edit Product
      </div>
      <div class="card-body">

        @include('backend.partials.message')

        <form action="{{ route('admin.product.update', $product->id) }}" method="post" enctype="multipart/form-data" >
          @csrf

          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Enter product title" value="{{ $product->title}}">
          </div>

          <div class="form-group">
            <label for="exampleInputPassword1">Description</label>
            <textarea name="description" id="description" class="form-control">{{ $product->description}}</textarea>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Select Category</label>

           <select class="form-control" name="category_id">
            <option value="">Please select a category</option>

            @foreach ( App\Models\Category::orderBy('name', 'asc')->where('parent_id', NULL)->get() as $parent)
              <option value="{{ $parent->id}}"{{ $parent->id == $product->category->id ? 'selected' : ''}}>{{$parent->name}}</option>
              @foreach ( App\Models\Category::orderBy('name', 'asc')->where('parent_id', $parent->id)->get() as $child)
              <option value="{{$child->id}}" {{$child->id == $product->category->id ? 'selected' : ''}}>------->{{ $child->name}}</option>
                
              @endforeach
            @endforeach

           </select>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Select Brand</label>
            <select class="form-control" name="brand_id">
              <option value="">Please select a brand</option>

              @foreach (App\Models\Brand::orderBy('name', 'asc')->get() as $br)
                <option value="{{ $br->id }}" {{ $br->id == $product->brand->id ? 'selected' : '' }}>{{ $br->name }}</option>
              @endforeach

            </select>
          </div> 
 

          <div class="form-group">
            <label for="exampleInputEmail1">Quantity</label>
            <input type="number" name="quantity" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter product Quantity" value="{{ $product->quantity}}">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Price</label>
            <input type="number" name="price" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter product price" value="{{ $product->price}}">
          </div>

          <div class="form-group">
            <label for="product_image">Product Images</label>
            <div class="row">

              <div class="col-md-4">
                <input type="file" name="product_image[]" class="form-control" id="product_image">
              </div>

              <div class="col-md-4">
                <input type="file" name="product_image[]" class="form-control" id="product_image">
              </div>

              <div class="col-md-4">
                <input type="file" name="product_image[]" class="form-control" id="product_image">
              </div>

              <div class="col-md-4">
                <input type="file" name="product_image[]" class="form-control" id="product_image">
              </div>

              <div class="col-md-4">
                <input type="file" name="product_image[]" class="form-control" id="product_image">
              </div>

              <div class="col-md-4">
                <input type="file" name="product_image[]" class="form-control" id="product_image">
              </div>

            </div>
          </div>



          <button type="submit" class="btn btn-primary">Update Product</button>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection