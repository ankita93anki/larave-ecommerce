<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>E-SHOP Admin</title>
    @include('admin.css')

    <style>
        label
        {
            display: inline-block;
            width:200px;
            font-size: 15px;
            font-weight: bold;
        }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        @include('admin.header')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        <!-- partial -->
        <!-- main-panel ends -->
        <div class="main-panel">
           <div class="content-wrapper">
              <h1 style="text-align: center; font-size: 25px">Send Email To {{$order->email}}</h1>
              <form action="{{url('send_user_email', $order->id)}}" method="POST">
                   @csrf
                    <div style="padding-left: 35%; padding-top: 30px">
                        <label>Email Greeting :</label>
                        <input style="color:black" type="text" name="greeting">
                    </div>
                    <div style="padding-left: 35%; padding-top: 30px">
                        <label>Email FirstLine :</label>
                        <input style="color:black" type="text" name="firstline">
                    </div>
                    <div style="padding-left: 35%; padding-top: 30px">
                        <label>Email Body :</label>
                        <input style="color:black" type="text" name="body">
                    </div>
                    <div style="padding-left: 35%; padding-top: 30px">
                        <label>Email Button Name :</label>
                        <input style="color:black" type="text" name="button">
                    </div>
                    <div style="padding-left: 35%; padding-top: 30px">
                        <label>Email Url :</label>
                        <input style="color:black" type="text" name="url">
                    </div>
                    <div style="padding-left: 35%; padding-top: 30px">
                        <label>Email LastLine :</label>
                        <input style="color:black" type="text" name="lastline">
                    </div>
                    <input type="submit" value="Send Email" class="btn btn-primary">
              </form>
            </div>
        </div>
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.js')
       <!-- End custom js for this page -->
  </body>
</html>
