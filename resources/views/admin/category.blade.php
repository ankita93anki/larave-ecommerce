<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>E-SHOP Admin</title>
    @include('admin.css')
    <style>
        .div_center
        {
            padding-top: 40px;
            text-align: center;
        }

        .h2_font
        {
            font-size: 40px;
            padding-bottom: 40px;
        }

        .input_color
        {
            color: black;
        }

        .center
        {
            margin: auto;
            width:50%;
            text-align: center;
            margin-top: 30px;
            border: 3px solid green;
        }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close"
                         data-dismiss="alert" aria-hidden="true">X</button>
                          {{session()->get('message')}}
                    </div>
                @endif

                @if(session()->has('info'))
                <div class="alert alert-success" style="margin-top: 5px">
                    <button type="button" class="close"
                     data-dismiss="alert" aria-hidden="true">X</button>
                      {{session()->get('info')}}
                </div>
               @endif
                <div class="div_center">
                    <h1 class="h2_font">Add Category</h1>
                    <form action="{{ url('/add_category')}}" method="POST">
                        @csrf
                        <input class="input_color" type="text" name="name" placeholder="Write Category">
                        <input type="submit" class="btn btn-primary" name="submit" value="Add Category">
                    </form>
                </div>

                <table class="center">
                        <tr>
                            <td>Category Name</td>
                            <td>Action</td>
                        </tr>
                    @foreach($data as $datas)
                        <tr>
                            <td>{{$datas->category_name}}</td>
                            <td><a
                                onclick="return confirm('Are you sur to delete this')"
                                href="{{url('delete_category', $datas->id )}}"
                                class="btn btn-danger">
                                Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.js')
       <!-- End custom js for this page -->
  </body>
</html>
