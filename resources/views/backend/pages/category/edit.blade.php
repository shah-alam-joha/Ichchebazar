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

        <form action="{{ route('admin.category.update', $category->id) }}" method="post" enctype="multipart/form-data" >
          @csrf

          <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter category name" value="{{ $category->name}}">
          </div>

          <div class="form-group">
            <label for="exampleInputPassword1">Description</label>
            <textarea name="description" id="description" class="form-control"> {{$category->description}} </textarea>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Parent ID</label>

            <select class="form-control" id="parent_id" name="parent_id">

              <option value="">Select a primary category</option>
              @foreach ($main_categories as $cat)
                <option value="{{ $cat->id}}" {{ $cat->id == $category->parent_id ? 'selected' : ''}}>{{ $cat->name }}</option>
              @endforeach 
              
            </select>
          </div>

          <div class="form-group">
            <label for="image">Category Images</label>
        
                <input type="file" name="image" class="form-control" id="image">
           
            </div>
          </div>



          <button type="submit" class="btn btn-primary">Update Category</button>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection