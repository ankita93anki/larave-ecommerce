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
                {{-- @if(session()->has('info'))
                <div class="alert alert-success" style="margin-top: 5px">
                    <button type="button" class="close"
                     data-dismiss="alert" aria-hidden="true">X</button>
                      {{session()->get('info')}}
                </div>
               @endif --}}
               <div class="div_center">
                  <h1 class="h2_font">All Orders</h1>
               </div>
               <div style="padding-left: 400px; padding-bottom: 30px">
                   <form action="{{url('search')}}" method="get">
                    @csrf
                     <input type="text" style="color:black" name="search" id="Search For Something">
                     <input type="submit" value="Search"
                     class="btn btn-outline-primary">
                   </form>
               </div>
                <table class="center">
                        <tr style="background-color:lightblue;color:#fff">
                            <th class="th_design">Customer Name</th>
                            {{-- <th class="th_design">Email</th> --}}
                            <th class="th_design">Phone </th>
                            <th class="th_design">Address</th>
                            <th class="th_design">Product Name</th>
                            <th class="th_design">Product Price</th>
                            <th class="th_design">Product Quantity</th>
                            <th class="th_design">Payment Status</th>
                            <th class="th_design">Delivery Status</th>
                            <th class="th_design">Product Image</th>
                            <th class="th_design">Delivered</th>
                            <th class="th_design">Print PDF</th>
                            <th class="th_design">Send Email</th>

                        </tr>
                    @forelse($data as $datas)
                        <tr>
                            <td>{{$datas->name}}</td>
                            {{-- <td>{{$datas->email}}</td> --}}
                            <td>{{$datas->phone}}</td>
                            <td>{{$datas->address}}</td>
                            <td>{{$datas->product_title}}</td>
                            <td>{{$datas->price}}</td>
                            <td>{{$datas->quantity}}</td>
                            <td>{{$datas->category}}</td>
                            <td>{{$datas->payment_status}}</td>
                            <td>{{$datas->delivery_status}}</td>
                            <td><img src="product/{{$datas->image}}" alt=""/></td>

                            <td>
                                @if($datas->delivery_status == 'processing')
                                  <a onclick="return confirm('Are you sure this product is delivered !!!')" href="{{url('delivered', $datas->id )}}"
                                   class="btn btn-danger">
                                   Delivered</a>
                                @else
                                  <p style="color: green;">Delivered</p>
                                @endif
                            </td>
                            <td>
                                 <a href="{{url('print_pdf', $datas->id)}}" class="btn btn-secondary">Print PDF</a>
                            </td>
                            <td>
                                <a href="{{url('send_email', $datas->id)}}" class="btn btn-info">Send Email</a>
                            </td>
                        </tr>
                       @empty

                       <tr>
                            <td>No Data Found</td>
                       </tr>

                    @endforelse
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
