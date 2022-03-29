@extends('backend.layouts.master')
@section('content')
<div class="main-panel">
  <div class="content-wrapper">


    <div class="card">
    	<div class="card-header">
    		Manage Sliders
    	</div>
    	<div class="card-body">
       @include('backend.partials.message')

       <a href="#addSliderModal" data-toggle = "modal" class="btn btn-info float-right mb-2">
        <i class="fa fa-plus"></i>Add new Slider           
      </a>
      <div class="clear-fix"></div>

      {{-- Add modal --}}
      <div class="modal fade" id="addSliderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add new Slider</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <form action="{{ route('admin.slider.store') }}" method="post" enctype="multipart/form-data">
              @csrf

              <div class="form-group">
                <label for="title">Slider Title <small class="text-danger">(required)</small></label>
                <input type="text" name="title" id="title" class="form-control" required placeholder="Enter slider title">
              </div>

              <div class="form-group">
                <label for="image">Slider Image <small class="text-danger">(required)</small></label>
                <input type="file" name="image" id="image" class="form-control" required placeholder="Enter slider image">
              </div>

              <div class="form-group">
                <label for="priority">Slider Priority <small class="text-danger">(required)</small></label>
                <input type="number" name="priority" id="priority" class="form-control" required placeholder="Enter slider priority">
              </div> 

              <div class="form-group">
                <label for="button_text">Slider Button Text <small class="text-danger"></small></label>
                <input type="text" name="button_text" id="button_text" class="form-control" placeholder="Enter slider button text">
              </div> 

              <div class="form-group">
                <label for="button_text">Slider Button Link <small class="text-danger"></small></label>
                <input type="url" name="button_text" id="button_text" class="form-control" placeholder="Enter slider button text(if need)">
              </div>

              <button type="submit"  class="btn btn-success">Add Slider</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <table class="table table-striped table-hover" id="dataTable">
      <thead>
        <tr>
          <th>#</th>
          <th>Slider Title</th>
          <th>Slider Image</th>
          <th>Priority</th>
          <th>Action</th>
        </tr>

      </thead>
      

      <tbody>
       @foreach ($sliders as $slider)
       <tr>
        
         
        <td>{{ $loop->index + 1}} </td>
        <td>{{ $slider->title}} </td>
        <td>
          <img src="{{ asset('images/sliders/'.$slider->image) }}" style="border-radius: unset; width: 50px;">
        </td>
        <td>{{ $slider->priority}} </td>
        <td>
          <a href="#editModal{{ $slider->id }}" data-toggle = "modal" class="btn btn-success">Edit</a>
          {{--   <a href="#editModal" data-toggle = "modal" class="btn btn-info float-right mb-2">
        <i class="fa fa-plus"></i>Edit           
      </a> --}}

      <a href="#deleteModal{{ $slider->id }}" data-toggle="modal" class="btn btn-danger">Delete</a> 

      {{-- Edit modal --}}
      <div class="modal fade" id="editModal{{ $slider->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Update this Slider</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <form action="{{ route('admin.slider.update', $slider->id) }}" method="post" enctype="multipart/form-data">
              @csrf

              <div class="form-group">
                <label for="title">Slider Title</label> <br>
                <input type="text" name="title" id="title" class="form-control" value="{{ $slider->title }}" >
              </div>

              <div class="form-group">
                <label for="image">Slider Image 
                  <a href="{{ asset('images/sliders/'.$slider->image) }}" target="_blank">Previous Image</a>
                </label><br>
                <input type="file" name="image" id="image" class="form-control">
              </div>

              <div class="form-group">
                <label for="priority">Slider Priority</label><br>
                <input type="number" name="priority" id="priority" class="form-control" value="{{ $slider->priority }}">
              </div> 

              <div class="form-group">
                <label for="button_text">Slider Button Text</label><br>
                <input type="text" name="button_text" id="button_text" class="form-control" value="{{ $slider->button_text }}">
              </div> 

              <div class="form-group">
                <label for="button_link">Slider Button Link </label><br>
                <input type="url" name="button_link" id="button_link" class="form-control" value="{{ $slider->button_link }}">
              </div>

              <button type="submit"  class="btn btn-success">Update Slider</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    {{-- edit modal end --}}

    {{--     Delete Modal --}}
    <div class="modal fade" id="deleteModal{{ $slider->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete this slider permanently ?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
           <form action="{{ route('admin.slider.delete', $slider->id) }}" method="post">
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
  <th>Slider Title</th>
  <th>Slider Image</th>
  <th>Priority</th>
  <th>Action</th>
</tr>
</tfoot>



</table>
</div>
</div>

</div>
</div>
@endsection