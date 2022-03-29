 @extends('backend.layouts.master')
 @section('content')
 <div class="main-panel">
  <div class="content-wrapper">

    
    <div class="card">
    	<div class="card-header">
    		Manage Division
    	</div>
    	<div class="card-body">
       @include('backend.partials.message')
       <table class="table table-striped table-hover" id="dataTable">
        <thead>
          <tr>
            <th>#</th>
            <th>Division Name</th>
            <th>Priority</th>
            <th>Action</th>
          </tr>

        </thead>
        
        
        <tbody>
         @foreach ($divisions as $division)
         <tr>
          <td>{{ $loop->index + 1}} </td>
          <td>{{ $division->name}} </td>
          <td>{{ $division->priority_id}} </td>
          <td>
            <a href="{{ route('admin.division.edit', $division->id) }}" class="btn btn-success">Edit</a>

            <a href="#deleteModal{{ $division->id }}" data-toggle="modal" class="btn btn-danger">Delete</a> 

            {{--     Delete Modal --}}
            <div class="modal fade" id="deleteModal{{ $division->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete this Division permanently ?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                   <form action="{{ route('admin.division.delete', $division->id) }}" method="post">
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
        <th>Division Name</th>
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