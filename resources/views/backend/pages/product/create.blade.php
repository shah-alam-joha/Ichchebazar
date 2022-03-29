@extends('backend.layouts.master')
@section('content')
<div class="main-panel">
  <div class="content-wrapper">


    <div class="card">
      <div class="card-header">
        Add Product
      </div>
      <div class="card-body">

        @include('backend.partials.message')

        <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data" >
          @csrf

          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Enter product title">
          </div>

          <div class="form-group">
            <label for="exampleInputPassword1">Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
          </div>

         {{--  <div class="form-group">
            <label for="exampleInputEmail1">Admin Id</label>
            <input type="number" name="admin_id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Admin ID">
          </div> --}}

          <div class="form-group">
            <label for="exampleInputEmail1">Select Category</label>

           <select class="form-control" name="category_id">
            <option value="">Please select a category</option>

            @foreach ( App\Models\Category::orderBy('name', 'asc')->where('parent_id', NULL)->get() as $parent)
              <option value="{{ $parent->id}}">{{$parent->name}}</option>
              @foreach ( App\Models\Category::orderBy('name', 'asc')->where('parent_id', $parent->id)->get() as $child)
              <option value="{{$child->id}}">------->{{ $child->name}}</option>
                
              @endforeach
            @endforeach

           </select>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Select Brand</label>
            <select class="form-control" name="brand_id">
              <option value="">Please select a brand</option>

              @foreach (App\Models\Brand::orderBy('name', 'asc')->get() as $brand)
                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
              @endforeach

            </select>
          </div>

         {{--  <div class="form-group">
            <label for="exampleInputEmail1">Slug</label>
            <input type="text" name="slug" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          </div> --}}

          <div class="form-group">
            <label for="exampleInputEmail1">Quantity</label>
            <input type="number" name="quantity" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter product Quantity">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Price</label>
            <input type="number" name="price" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter product price">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Offer Price</label>
            <input type="number" name="offer_price" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Offer Price">
          </div>

      {{--     <div class="form-group">
            <label for="exampleInputEmail1">Status</label>
            <input type="number" name="status" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          </div> --}} 

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



          <button type="submit" class="btn btn-primary">Add Product</button>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection