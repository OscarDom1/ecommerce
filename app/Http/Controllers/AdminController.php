<?php

namespace App\Http\Controllers;

use PDF;
use Notification;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\SendEmailNotification;

class AdminController extends Controller
{
    //show category page
    public function view_category()
    {
        if (Auth::id()) {

            $data = category::all();
            return view('admin.category', compact('data'));
        } else {
            return redirect('login');
        }
    }

    //add category
    public function add_category(Request $request)
    {
        $data = new category;

        $data->category_name = $request->category;

        $data->save();

        return redirect()->back()->with('message', 'Category added succesfully');
    }

    //delete category name
    public function delete_category($id)
    {

        if (Auth::id()) {
            $data = Category::find($id);
            $data->delete();

            return redirect()->back()->with('message', 'Category deleted successfully');
        } else {
            return redirect('login');
        }
    }
    //view product page
    public function view_product()
    {
        if (Auth::id()) {

            $category = category::all();
            return view('admin.product', compact('category'));
        } else {
            return redirect('login');
        }
    }
    //add product fuction
    public function add_product(Request $request)
    {

        if(Auth::id()){

            
        $product = new Product;

        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->discount_price = $request->dis_price;
        $product->category = $request->category;

        $image = $request->image;

        $imagename = time() . '.' . $image->getClientOriginalExtension();

        $request->image->move('product', $imagename);

        $product->image = $imagename;


        $product->save();

        return redirect()->back()->with('message', 'Product added successfully');

        }else{
            return redirect('login');
        }

    }

    //show added products
    public function show_product()
    {
        if(Auth::id()){

            $product = product::all();
            return view('admin.show_product', compact('product'));
        }else{
            return redirect('login');
        }
   
    }

    //delete added product
    public function delete_product($id)
    {

        if(Auth::id()){

            $product = product::find($id);

            $product->delete();
    
            return redirect()->back()->with('message', 'Product deleted successfully');

        }else{
            return redirect('login');
        }

      
    }

    //show update added product
    public function update_product($id)
    {

        $product = product::find($id);

        $category = category::all();

        return view('admin.update_product', compact('product', 'category'));
    }

    //update added product
    public function update_product_confirm(Request $request, $id)
    {

        $product = product::find($id);

        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount_price = $request->dis_price;
        $product->category = $request->category;
        $product->quantity = $request->quantity;

        $image = $request->image;
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();

            $request->image->move('product', $imagename);

            $product->image = $imagename;
        }


        $product->save();

        return redirect()->back()->with('message', 'Product details updated successfully');
    }

    //show order page
    public function order()
    {

        $order = Order::all();
        return view('admin.order', compact('order'));
    }

    //delivered status 
    public function delivered($id)
    {

        $order = order::find($id);

        $order->delivery_status = "delivered";

        $order->payment_status = 'Paid';

        $order->save();

        return redirect()->back();
    }

    //print pdf function
    public function print_pdf($id)
    {

        $order = order::find($id);

        $pdf = PDF::loadView('admin.pdf', compact('order'));

        return $pdf->download('order_details.pdf');
    }

    //email notification function
    public function send_email($id)
    {

        $order = order::find($id);

        return view('admin.email_info', compact('order'));
    }

    //send user notification function
    public function send_user_email(Request $request, $id)
    {

        $order = order::find($id);

        $details = [

            'greeting' => $request->greeting,
            'firstline' => $request->firstline,
            'body' => $request->body,
            'button' => $request->button,
            'url' => $request->url,
            'lastline' => $request->lastline,

        ];

        Notification::send($order, new SendEmailNotification($details));

        return redirect()->back()->with('message', 'Mail sent successfully');
    }

    //search function
    public function searchdata(Request $request)
    {

        $searchText = $request->search;

        $order = order::where('name', 'LIKE', "%$searchText%")->orWhere('phone', 'LIKE', "%$searchText%")->orWhere('payment_status', 'LIKE', "%$searchText%")->orWhere('product_title', 'LIKE', "%$searchText%")->get();

        return view('admin.order', compact('order'));
    }
}
