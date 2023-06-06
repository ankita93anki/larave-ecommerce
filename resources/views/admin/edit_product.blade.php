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

        label
        {
            display: inline-block;
            width: 200px;
        }
        .div_design
        {
            padding-bottom: 50px;
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
                <div class="div_center">
                    <h1 class="h2_font">Edit Products</h1>
                    <form action="{{ url('/update_product_confirm',$product->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                     <div class="div_design">
                        <label>Product Title :</label>
                        <input class="input_color" type="text"
                        name="title" placeholder="Write a title"
                        value="{{ $product->title}}"
                        required="">
                     </div>
                     <div class="div_design">
                        <label>Product Description :</label>
                        <input class="input_color" type="text"
                        name="description"
                        value="{{ $product->description}}"
                        placeholder="Write a description" required="">
                     </div>
                     <div class="div_design">
                        <label>Product Price :</label>
                        <input class="input_color" type="number"
                        name="price"
                        value="{{ $product->price}}"
                        placeholder="Write a price" required="">
                     </div>
                     <div class="div_design">
                        <label>Discount Price :</label>
                        <input class="input_color" type="number"
                        name="dis_price"
                        value="{{ $product->discount_price}}"
                        placeholder="Write a discount price">
                     </div>
                     <div class="div_design">
                        <label>Product Quantity :</label>
                        <input class="input_color" type="number"
                         min="0"
                         value="{{ $product->quantity}}"
                        name="quantity" placeholder="Write a quantity" required="">
                     </div>
                     <div class="div_design">
                        <label>Product Category :</label>
                        <select class="input_color" name="category" required="">
                            <option value="{{$product->category}}" selected="">{{$product->category}}</option>
                            @foreach($category as $categories)
                            <option value="{{$categories->category_name}}">
                                {{$categories->category_name}}</option>
                            @endforeach
                        </select>
                     </div>
                     <div class="div_design">
                        <label>Current Product Image :</label>
                        <img src="/product/{{$product->image}}" alt="" style="margin:auto;width:150px">
                     </div>
                     <div class="div_design">
                        <label>Change Product Image :</label>
                        <input class="input_color" type="file"
                        name="image">
                     </div>
                        <input type="submit" class="btn btn-primary" name="submit" value="Update Product">
                    </form>
                </div>

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
