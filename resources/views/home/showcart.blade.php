<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      @include('home.css')

      <style type="text/css">
           .center
           {
              margin:auto;
              text-align: center;
              padding:30px;
           }

           table,th,td
           {
              border: 1px solid grey;
           }

           .th_deg
           {
              font-size: 20px;
              padding: 5px;
              background: skyblue;
           }

           .img_deg
           {
              height: 200px;
              width: 200px;
           }

           .total_deg
           {
               font-size: 20px;
               padding: 40px;
           }
      </style>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   </head>
   <body>
     @include('sweetalert::alert')
      <div class="hero_area">
         <!-- header section strats -->
          @include('home.header')
         <!-- end header section -->
         @if(session()->has('message'))
         <div class="alert alert-success">
             <button type="button" class="close"
              data-dismiss="alert" aria-hidden="true">X</button>
               {{session()->get('message')}}
         </div>
     @endif
      <div class="center">

             <table>
                   <tr>
                         <th class="th_deg">Product Title</th>
                         <th class="th_deg">Product Quantity</th>
                         <th class="th_deg">Price</th>
                         <th class="th_deg">Image</th>
                         <th class="th_deg">Action</th>
                   </tr>
                   <?php $totalprice=0; ?>
                   @foreach($cart as $carts)
                   <tr>
                         <td>{{ $carts->product_title }}</td>
                         <td>{{ $carts->quantity }}</td>
                         <td>{{$carts->price}}</td>
                         <td><img src="product/{{$carts->image}}" class="img_deg" alt=""></td>
                         <td><a class="btn btn-danger"
                            onclick="confirmation(event)"
                            href="{{url('/remove_cart', $carts->id)}}">Remove Product</a></td>
                   </tr>
                   <?php
                          $totalprice =  $totalprice + $carts->price
                   ?>
                   @endforeach
             </table>

             <div>
                   <h1 class="total_deg">Total Price: {{$totalprice}}
                </h1>
             </div>
             <div>
                <h1 style="font-size: 25px; padding-bottom: 15px">Proceed to Order</h1>
                     <a href="{{url('cash_order')}}" class="btn btn-danger">Cash On Delivery</a>
                     <a href="{{url('stripe',$totalprice)}}" class="btn btn-danger">Pay Using Card</a>

             </div>
      </div>
      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
        <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
           Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
        </p>
     </div>
      <!-- jQery -->
 <!-- jQery -->
 @include('home.script')

<script>
        function confirmation(ev)
        {
               ev.preventDefault();
               var urlToRedirect = ev.currentTarget.getAttribute('href');
               console.log(urlToRedirect);
               swal({
                title: "Are you sure to cancel this product",
                text: "You will not be able to revert this!",
                icon: "warning",
                button: true,
                dangerMode: true,
               })
               .then((willCancel) => {
                     if(willCancel)
                     {
                        window.location.href = urlToRedirect;
                     }
               });
        }
</script>
   </body>
</html>
