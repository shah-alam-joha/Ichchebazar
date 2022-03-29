@extends('backend.layouts.master')
@section('content')
<div class="main-panel">
  <div class="content-wrapper">


    <div class="card">
      <div class="card-header">
        Manage Category
      </div>
      <div class="card-body">
        @include('backend.partials.message')
        <table class="table table-striped table-hover" id="dataTable">
          <thead>
             <tr>
            <th>#</th>
            <th>Category Name</th>
            <th>Category Image</th>
            <th>Parent Id</th>
            <th>Action</th>

          </tr>
          </thead>
         

          <tbody>

            @foreach ($categories as $category)
            <tr>
              <td> {{ $loop->index +1 }} </td>
              <td> {{ $category->name }} </td>
              <td> 
                <img src="{{ asset('images/categories/'. $category->image) }}" width="200">
              </td>

              <td> 

                @if( $category->parent_id == NULL )
                Primary Category

                @else
                
               {{--  {{ $category->parent['name']}} --}}
                {{ $category->parent->name }}

                @endif

              </td>
              

              <td> 
                <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-success">Edit</a> 
                
                <a href="#deleteModal{{ $category->id }}" data-toggle="modal" class="btn btn-danger">Delete</a> 

            {{--     Delete Modal --}}
                <div class="modal fade" id="deleteModal{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete this category permanently ?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                       <form action="{{ route('admin.category.delete', $category->id) }}" method="post">
                        @csrf

                        <button type="submit"  class="btn btn-danger">Permanent Delete</button>
                       </form>
                       
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                       
                      </div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            @endforeach
            

          </tbody>

          <tfoot>
              <tr>
            <th>#</th>
            <th>Category Name</th>
            <th>Category Image</th>
            <th>Parent Id</th>
            <th>Action</th>

          </tr>
          </tfoot>
        </table>


      </div>
    </div>
  </div>
</div>
@endsection