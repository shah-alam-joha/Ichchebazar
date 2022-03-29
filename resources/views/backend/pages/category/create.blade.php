@extends('backend.layouts.master')
@section('content')
<div class="main-panel">
  <div class="content-wrapper">


    <div class="card">
      <div class="card-header">
        Add Category
      </div>
      <div class="card-body">

        @include('backend.partials.message')

        <form action="{{ route('admin.category.store') }}" method="post" enctype="multipart/form-data" >
          @csrf

          <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter category name">
          </div>

          <div class="form-group">
            <label for="exampleInputPassword1">Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Parent ID (optional)</label>

            <select class="form-control" id="parent_id" name="parent_id">
              <option value="">Select a parent category</option>
              @foreach ($main_categories as $category)
                <option value="{{ $category->id}}">{{ $category->name }}</option>
              @endforeach 
              
            </select>
          </div>

          <div class="form-group">
            <label for="image">Category Images (optional)</label>
        
                <input type="file" name="image" class="form-control" id="image">
           
            </div>
          </div>



          <button type="submit" class="btn btn-primary">Add Category</button>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection