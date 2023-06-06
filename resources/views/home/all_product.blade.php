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
    </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
          @include('home.header')
         <!-- end header section -->
      <!-- product section -->
      <section class="product_section layout_padding">
        <div class="container">
           <div class="heading_container heading_center">
              <h2>
                 Our <span>products</span>
              </h2>
           </div>
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close"
                         data-dismiss="alert" aria-hidden="true">X</button>
                          {{session()->get('message')}}
                    </div>
                @endif
           <div>
            <form action="{{url('search_product')}}" method="GET">
                @csrf
                <input  type="text" name="search"
                placeholder="Search for Something">
                <input type="submit" value="search">
            </form>
           </div>
           <div class="row">
            @foreach($products as $product)
              <div class="col-sm-6 col-md-4 col-lg-4">
                 <div class="box">
                    <div class="option_container">
                       <div class="options">
                          <a href="{{url('product_details', $product->id)}}"
                             class="option1">
                           Product Details
                          </a>
                          <form action="{{url('add_cart', $product->id)}}" method="Post">
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
                    <div class="img-box">
                       <img src="product/{{$product->image}}" alt="">
                    </div>
                    <div class="detail-box">
                       <h5>
                             {{$product->title}}
                       </h5>

                       @if($product->discount_price != null)
                        <h6 style="text-decoration: line-through;color:blue">
                            Price:
                            <br>
                            ${{$product->price}}
                       </h6>
                         <h6 style="color: red">
                            Discount Price:
                            <br>
                            ${{$product->discount_price}}
                         </h6>
                        @else
                        <h6 style="color:blue">
                            Price:
                            <br>
                            ${{$product->price}}
                         </h6>
                       @endif
                    </div>
                 </div>
              </div>
            @endforeach

            <span style="padding-top:20px">
                {!!$products->withQueryString()->links('pagination::bootstrap-5')!!}
            </span>

           </div>
           {{-- <div class="btn-box">
              <a href="">
              View All products
              </a>
           </div> --}}
        </div>
     </section>
          <!-- end product section -->
      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
        <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
           Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
        </p>
     </div>
     <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            var scrollpos = localStorage.getItem('scrollpos');
            if(scrollpos) window.scrollTo(0, scrollpos);
        });
        window.onbeforeunload = function(e) {
              localStorage.setItem('scrollpos', window.scrollY);
        };
     </script>
     @include('home.script')
    </body>
</html>
