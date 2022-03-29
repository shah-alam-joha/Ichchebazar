@extends('backend.layouts.master')

@section('content')

<div class="main-panel">
  <div class="content-wrapper">

    <div class="card">
      <div class="card-header">
        Manage Orders



      </div>
      <div class="card-body">


        @include('backend.partials.message')


        <table class="table table-hover table-stiped" id="dataTable">
          <thead>
           <tr>
            <th>#</th>
            <th>Order ID</th>
            <th>Order Name</th>
            <th>Order Phone No</th>
            <th>Order Status</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>
          @foreach ( $orders as $order )
          <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td> #IB-{{ $order->id }} </td>
            <td> {{ $order->name }} </td>
            <td> {{ $order->phone_no }} </td>
            <td> 
              <p>
                @if ( $order->is_seen_by_admin)
                <button type="button" class="btn btn-success btn-sm">Seen</button>
                @else
                <button type="button" class="btn btn-warning btn-sm">Un Seen</button>
                @endif
              </p>  

              <p>
                @if ( $order->is_completed)
                <button type="button" class="btn btn-success btn-sm">Completed</button>
                @else
                <button type="button" class="btn btn-warning btn-sm">Not Completed</button>
                @endif
              </p> 

              <p>
                @if ( $order->is_paid)
                <button type="button" class="btn btn-success btn-sm">Paid</button>
                @else
                <button type="button" class="btn btn-warning btn-sm">Un Paid</button>
                @endif
              </p>

            </td>

            <td> 


              <a href="{{ route('admin.order.show', $order->id) }}" type="button" class="btn btn-info" >
                View Order
              </a> 

              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModel{{$order->id}}">
                Delete
              </button>

              <!--Delete Modal -->
              <div class="modal fade" id="deleteModel{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete it?</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ route('admin.order.delete', $order->id ) }}" method="post">

                        @csrf

                        <button type="submit" class="btn btn-danger">Permanent Delete</button>
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
          <th>Order ID</th>
          <th>Order Name</th>
          <th>Order Phone No</th>
          <th>Order Status</th>
          <th>Action</th>
        </tr>
      </tfoot>

    </table>

  </div>
</div>
</div>

</div>
</div>
<!-- main-panel ends -->
@endsection()