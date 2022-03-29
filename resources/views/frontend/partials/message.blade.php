@if ($errors->any())
<div class="container  mt-2">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-danger">
                <ul>
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endif


@if(Session::has('success'))
<div class="container mt-2">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-success">
                <p>{{ Session::get('success')}}</p>
            </alert>
        </div>
    </div>
</div>
</div>
@endif


@if (Session::has('error'))
<div class="container  mt-2">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-danger">
                <p>{{ Session::get('error')}}</p>
            </div>
        </div>
    </div>
</div>
@endif