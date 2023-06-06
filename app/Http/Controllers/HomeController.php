<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
//use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

// use Session;

use Stripe;

class HomeController extends Controller
{
    //

    public function blog()
    {
        return view('home.blog');
    }
    public function redirect()
    {
       $usertype = Auth::user()->usertype;
       if($usertype == '1')
       {
          $total_product = Product::all()->count();
          $total_order = Order::all()->count();
          $total_customer = User::all()->count();
          $total_delivered = Order::where('delivery_status','delivered')->count('id');
          $total_processing = Order::where('delivery_status','processing')->count('id');
          $orders = Order::all();
          $total_revenue = 0;
          foreach($orders as $order)
          {
             $total_revenue = $total_revenue + $order->price;
          }
          return view('admin.home',compact('total_product','total_order','total_customer','total_delivered','total_processing','total_revenue'));
       }
       else
       {
        $products = Product::paginate(3);
        return view('home.userpage',compact('products'));       }
    }

    public function index()
    {
        $products = Product::paginate(3);
        return view('home.userpage',compact('products'));
    }

    public function product_details($id)
    {
           $products = product::find($id);
           return view('home.product_details',compact('products'));
    }

    public function add_cart(Request $request,$id)
    {
         if(Auth::id())
         {
            $user = Auth::user();
            $userid = $user->id;
            $product = Product::find($id);
            $product_exist_id = cart::where('product_id', '=',$id)
                        ->where('user_id','=',$userid)
                        ->get('id')->first();
            if($product_exist_id !=null)
            {
                  $cart = cart::find($product_exist_id)->first();
                  $quantity=$cart->quantity;
                  $cart->quantity = $quantity + $request->quantity;
                  if($product->discount_price != null)
                  {
                      $cart->price = $product->discount_price * $cart->quantity;
                  }
                  else
                  {
                      $cart->price = $product->price * $cart->quantity;
                  }

                  $cart->save();

                  Alert::success('Product Added Successfully',
                'We have added product to the cart');

                  return redirect()->back();

                //   return redirect()->back()->with('message','Product has added successfully');
            }
            else
            {
                $cart = new Cart;
                $cart->name =  $user->name;
                $cart->email =  $user->email;
                $cart->phone =  $user->phone;
                $cart->address =  $user->address;
                $cart->product_title = $product->title;
                if($product->discount_price != null)
                {
                    $cart->price = $product->discount_price * $request->quantity;
                }
                else
                {
                    $cart->price = $product->price * $request->quantity;
                }
                $cart->quantity = $request->quantity;
                $cart->product_id = $product->id;
                $cart->user_id = $user->id;
                $cart->image = $product->image;
                $cart->save();
            }
            Alert::success('Product Added Successfully',
                'We have added product to the cart');
            return redirect()->back();
           // dd($user);
         }
         else
         {
              return redirect('login');
         }
    }

    public function show_cart()
    {
        if(Auth::user()->id)
        {
            $id = Auth::user()->id;
            $cart = Cart::where('user_id','=', $id)->get();
            return view('home.showcart',compact('cart'));
        }

        else
        {
            return redirect('login');

        }

    }

    public function remove_cart($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->back();
    }

    public function cash_order()
    {
        $user = Auth::user();
        $userid = $user->id;
        $datas = Cart::where('user_id','=', $userid)->get() ;
        foreach($datas as $data)
        {
            $order = new Order;
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->quantity = $data->quantity;
            $order->price = $data->price;
            $order->image = $data->image;
            $order->product_id = $data->product_id;
            $order->payment_status = 'cash on delivery' ;
            $order->delivery_status = 'processing';
            $order->save();
            $cart_id = $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }

        return redirect()->back()->with('message','We have received your order. we will connect with you soon');

      }

      public function stripe($totalprice)
      {
          return view('home.stripe',compact('totalprice'));
      }

      public function stripePost(Request $request, $totalprice)
    {
        $user = Auth::user();
        $userid = $user->id;
        $datas = Cart::where('user_id','=', $userid)->get() ;
        foreach($datas as $data)
        {
            $order = new Order;
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->quantity = $data->quantity;
            $order->price = $data->price;
            $order->image = $data->image;
            $order->product_id = $data->product_id;
            $order->payment_status = 'paid' ;
            $order->delivery_status = 'processing';
            $order->save();
            $cart_id = $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        \Stripe\Charge::create([
                "amount" => $totalprice * 100,
                "currency" => "INR",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com."
        ]);

        Session::flash('success', 'Payment successful!');

        return back();
    }

    public function show_order()
    {
          if(Auth::id())
          {
            $user = Auth::user();
            $userid = $user->id;
            $order = Order::where('user_id','=',$userid)->get();
              return view('home.order',compact('order'));
          }
          else
          {
              return redirect('login');
          }
    }

    public function cancel_order($id)
    {
        $order = Order::find($id);
        $order->delivery_status = 'You canceled the order';
        $order->save();
        return redirect()->back();
    }

    public function product_search(Request $request)
    {
        $searchText = $request->search;
        $products = Product::where('title','LIKE',"%$searchText%")
        ->paginate(10);
        return view('home.userpage',compact('products'));

    }
    public function search_product(Request $request)
    {
        $searchText = $request->search;
        $products = Product::where('title','LIKE',"%$searchText%")
        ->paginate(10);
        return view('home.all_product',compact('products'));

    }

    public function product()
    {
        $products = Product::paginate(6);

        return view('home.all_product',compact('products'));
    }
}
