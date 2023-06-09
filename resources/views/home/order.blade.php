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

      <style>
            .center
            {
                margin: auto;
                width: 70%;
                padding: 30px;
                text-align: center;
            }
            table,th,td
            {
                border: 1px solid black;
            }
            .th_deg
            {
                padding: 10px;
                background-color: skyblue;
                font-size: 20px;
                font-weight: bold;
            }
      </style>
   </head>
   <body>
         <!-- header section strats -->
          @include('home.header')
         <!-- end header section -->
         <div class="center">
               <table>
                      <tr>
                          <th class="th_deg">Product Title</th>
                          <th class="th_deg">Quantity</th>
                          <th class="th_deg">Price</th>
                          <th class="th_deg">Payment Status</th>
                          <th class="th_deg">Delivery Status</th>
                          <th class="th_deg">Product Image</th>
                          <th class="th_deg">Cancel Order</th>

                      </tr>
                      @foreach($order as $order)
                        <tr>
                        <td>{{$order->product_title}}</td>
                        <td>{{$order->quantity}}</td>
                        <td>{{$order->price}}</td>
                        <td>{{$order->payment_status}}</td>
                        <td>{{$order->delivery_status}}</td>
                        <td><img src="product/{{$order->image}}" alt=""></td>
                        <td>
                            @if($order->delivery_status=='processing')
                              <a onclick="return confirm('do you want to cancel this order?')"
                              href="{{url('cancel_order', $order->id)}}"
                              class="btn btn-danger">Cancel Order</a>
                            @else
                              <p>Not Allowed</p>
                            @endif
                        </td>
                    </tr>
                      @endforeach

               </table>
         </div>

      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
        <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
           Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
        </p>
     </div>
     @include('home.script')

   </body>
</html>
