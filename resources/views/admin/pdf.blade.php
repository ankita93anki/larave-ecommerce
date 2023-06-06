<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-SHOP Admin</title>
</head>
<body>
    <h1>Order Details</h1>
  Customer Name :<h3>{{$order->name}}</h3>
  Customer Email :<h3>{{$order->email}}</h3>
  Customer Phone :<h3>{{$order->phone}}</h3>
  Customer Address :<h3>{{$order->address}}</h3>
   Product Name :<h3>{{$order->product_title}}</h3>
   Quantity :<h3>{{$order->quantity}}</h3>
   Price :<h3>{{$order->price}}</h3>
   {{-- Image :<img height="250" width="250"
   src="product/{{$order->image}}" /> --}}
   Payment Status :<h3>{{$order->payment_status}}</h3>
   Delivery Status :<h3>{{$order->delivery_status}}</h3>


</body>
</html>
