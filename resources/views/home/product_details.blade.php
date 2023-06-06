<!DOCTYPE html>
<html>
   <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    @include('home.css')
    </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
          @include('home.header')
         <!-- end header section -->

      <div class="col-sm-6 col-md-4 col-lg-4"
       style="margin: auto; width:50%;padding:30px">
         <div class="box">
            <div class="img-box" style="padding: 20px">
               <img src="/product/{{$products->image}}" alt="">
            </div>
            <div class="detail-box">
               <h5>
                     {{$products->title}}
               </h5>

               @if($products->discount_price != null)
                <h6 style="text-decoration: line-through;color:blue">
                    Price:
                    <br>
                    ${{$products->price}}
               </h6>
                 <h6 style="color: red">
                    Discount Price:
                    <br>
                    ${{$products->discount_price}}
                 </h6>
                @else
                <h6 style="color:blue">
                    Price:
                    <br>
                    ${{$products->price}}
                 </h6>
               @endif

               <h6>
                   Product Category : {{$products->category}}
               </h6>
               <h6>
                   Product Details : {{$products->description}}
              </h6>
              <h6>
                  Product Quantity : {{$products->quantity}}
              </h6>
              <form action="{{url('add_cart', $products->id)}}" method="Post">
                @csrf
                {{-- <div class="row"> --}}
                    {{-- <div class="col-md-4"> --}}
                      <input type="number" name="quantity" value="1" min="1"
                      >
                    {{-- </div> --}}
                    {{-- <div class="col-md-4"> --}}
                        <input type="submit" value="Add To Cart">
                    {{-- </div> --}}
                {{-- </div> --}}
              </form>
            </div>
         </div>
      </div>

    <span style="padding-top:20px">
    </span>

      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
        <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
           Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
        </p>
     </div>
      <!-- jQery -->
      @include('home.script')
   </body>
</html>
