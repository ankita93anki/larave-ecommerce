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

        .th_design
        {
            padding: 10px;
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
                @if(session()->has('info'))
                <div class="alert alert-success" style="margin-top: 5px">
                    <button type="button" class="close"
                     data-dismiss="alert" aria-hidden="true">X</button>
                      {{session()->get('info')}}
                </div>
               @endif
               <div class="div_center">
                  <h1 class="h2_font">All Products</h1>
               </div>
                <table class="center">
                        <tr style="background-color:lightblue;color:#fff">
                            <th class="th_design">Product Name</th>
                            <th class="th_design">Product Description</th>
                            <th class="th_design">Product Image</th>
                            <th class="th_design">Product Price</th>
                            <th class="th_design">Product Discount Price</th>
                            <th class="th_design">Product Quantity</th>
                            <th class="th_design">Product Category</th>
                            <th class="th_design">Delete</th>
                            <th class="th_design">Edit</th>
                        </tr>
                    @foreach($data as $datas)
                        <tr>
                            <td>{{$datas->title}}</td>
                            <td>{{$datas->description}}</td>
                            <td><img src="product/{{$datas->image}}" alt=""/></td>
                            <td>{{$datas->price}}</td>
                            <td>{{$datas->discount_price}}</td>
                            <td>{{$datas->quantity}}</td>
                            <td>{{$datas->category}}</td>
                            <td><a
                                onclick="return confirm('Are you sur to delete this')"
                                href="{{url('delete_product', $datas->id )}}"
                                class="btn btn-danger">
                                Delete</a>
                            </td>
                            <td><a
                                href="{{url('edit_product', $datas->id )}}"
                                class="btn btn-success">
                                Edit</a>
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
