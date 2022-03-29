<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>IchcheBazar Admin Panel</title>

  <!-- plugins:css -->
  @include('backend.partials.link')

</head>

<body>

  <div class="container-scroller">

    <!-- partial:partials/_navbar.html -->
    @include('backend.partials.navbar')
    <!-- partial -->


    <div class="container-fluid page-body-wrapper">

      {{-- admin side bar start --}}
      @include('backend.partials.admin-sidebar')

      @yield('content')
     



    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  @include('backend.partials.admin-script')

</body>
</html>