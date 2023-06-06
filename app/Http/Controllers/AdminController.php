<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Notifications\SendEmailNotification;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{
    //
    public function view_category()
    {
        if(Auth::id())
        {
            $data = Category::all();
           return view('admin.category',compact('data'));
        }

        else
        {
            return redirect('login');
        }

    }

    public function add_category(Request $request)
    {
        if(Auth::id())
        {
            $data = new Category;
            $data->category_name = $request->name;
            $data->save();
            return redirect()->back()->with('message','Category Added Successfully');
        }

        else
        {
            return redirect('login');
        }
    }

    public function delete_category($id)
    {
        if(Auth::id())
        {
            $data = Category::find($id);
            $data->delete();
            return redirect()->back()->with('info','Category Deleted Successfully');
        }

        else
        {
            return redirect('login');
        }

    }

    public function view_product()
    {
        if(Auth::id())
        {
          $categories = Category::all();
          return view('admin.product',compact('categories'));
        }
        else
        {
            return redirect('login');
        }
    }

    public function add_product(Request $request)
    {
        if(Auth::id())
        {
            $products = new Product;
            $products->title = $request->title;
            $products->description = $request->description;
            $products->price = $request->price;
            $products->discount_price = $request->dis_price;
            $products->quantity = $request->quantity;
            $products->category = $request->category;
            $image =   $request->image;
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('product', $imageName);
            $products->image =  $imageName;
            $products->save();
            return redirect()->back()->with('message','Product Added Successfully');

        }
        else
        {
            return redirect('login');
        }
    }

    public function show_product()
    {

        if(Auth::id())
        {

        $data = Product::all();
        return view('admin.show_product',compact('data'));
        }
        else
        {
            return redirect('login');
        }

    }

    public function delete_product($id)
    {
           $data = Product::find($id);
           $data->delete();
           return redirect()->back()->with('info','Product Deleted Successfully');
    }

   public function edit_product($id)
   {
        $product = Product::find($id);
        $category = Category::all();
        return view('admin.edit_product',compact('product','category'));
   }

   public function update_product_confirm(Request $request,$id)
   {
      $product = Product::find($id);
      $product->title = $request->title;
      $product->description = $request->description;
      $product->price = $request->price;
      $product->discount_price = $request->dis_price;
      $product->quantity = $request->quantity;
      $product->category = $request->category;
      $image =   $request->image;
      if($image)
      {
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product', $imageName);
        $product->image =  $imageName;
      }

      $product->save();
      return redirect()->back()->with('message','Product Updated Successfully');

   }

   public function order()
   {
        if(Auth::id())
        {
            $data = Order::all();
            return view('admin.order',compact('data'));
        }
        else
        {
            return redirect('login');
        }

   }

   public function delivered($id)
   {
    if(Auth::id())
        {
            $order = Order::find($id);
            $order->delivery_status = "delivered";
            $order->payment_status = "paid";
            $order->save();
            return redirect()->back();
        }
        else
        {
            return redirect('login');
        }

   }

   public function print_pdf($id)
   {
        if(Auth::id())
         {
            $order = Order::find($id);
            $pdf = pdf::loadView('admin.pdf', compact('order'));
            return $pdf->download('order_details.pdf');
         }
         else
         {
             return redirect('login');
         }
   }

   public function send_email($id)
   {
        if(Auth::id())
        {
            $order = order::find($id);
            return view('admin.email_info',compact('order'));
        }
        else
        {
            return redirect('login');
        }
   }

   public function send_user_email(Request $request,$id)
   {
        $order = Order::find($id);
        $details = [
                'greeting' => $request->greeting,
                'firstline' => $request->firstline,
                'body' => $request->body,
                'button' => $request->button,
                'url' => $request->url,
                'lastline' => $request->lastline
        ];

        Notification::send($order,new SendEmailNotification($details));
        return redirect()->back();
   }

   public function searchdata(Request $request)
   {

      if(Auth::id())
        {
            $searchText = $request->search;
            $data = Order::where('name','LIKE',"%$searchText%")
             ->orWhere('phone','LIKE',"%$searchText%")
             ->orWhere('product_title','LIKE',"%$searchText%")
             ->get();
            return view('admin.order',compact('data'));
        }
        else
        {
            return redirect('login');
        }
   }
}
