<?php

namespace App\Http\Controllers;

use Stripe;
use Session;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Reply;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{

    //show user page
    public function index()
    {

        $product = Product::paginate(9);
        $comment = Comment::orderby('id', 'desc')->get();
        $reply = Reply::all();


        return view('home.userpage', compact('product', 'comment', 'reply'));
    }
    public function redirect()
    {

        $usertype = Auth::user()->usertype;
        if ($usertype == '1') {

            $total_product = product::all()->count();

            $total_order = order::all()->count();

            $total_user = user::all()->count();

            $order = order::all();

            $total_revenue = 0;

            foreach ($order as $order) {
                $total_revenue = $total_revenue + $order->price;
            }

            $total_delivered = order::where('delivery_status', '=', 'delivered')->get()->count();

            $total_processing = order::where('delivery_status', '=', 'processing')->get()->count();


            return view('admin.home', compact('total_product', 'total_order', 'total_user', 'total_revenue', 'total_delivered', 'total_processing'));
        } else {

            $product = Product::paginate(9);

            $comment = Comment::orderby('id', 'desc')->get();

            $reply = Reply::all();

            return view('home.userpage', compact('product', 'comment', 'reply'));
        }
    }

    //product details
    public function product_details($id)
    {

        $product = Product::find($id);

        return view('home.product_details', compact('product'));;
    }

    //add to cart function
    public function add_cart(Request $request, $id)
    {
        if (Auth::id()) {
            $user = Auth::user();
            $product = product::find($id);

            // Check if the product already exists in the cart for the current user
            $existingCart = Cart::where('user_id', $user->id)->where('product_id', $product->id)->first();

            if ($existingCart) {
                // The product is already in the cart, display a message

                Alert::warning('Product Already in the cart', 'Check your cart');

                return redirect()->back();;
            }

            $cart = new Cart;
            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->user_id = $user->id;
            $cart->product_title = $product->title;

            if ($product->discount_price != null) {
                $cart->price = $product->discount_price * $request->quantity;
            } else {
                $cart->price = $product->price * $request->quantity;
            }

            $cart->image = $product->image;
            $cart->product_id = $product->id;
            $cart->quantity = $request->quantity;

            $cart->save();

            // Get the cart count for the current user
            $cartCount = 0;
            if (Auth::check()) {
                $cartCount = Cart::where('user_id', Auth::id())->count();
            }

            Alert::success('Product Added Successfully', 'We have added product to the cart');

            return redirect()->back()->with('cartCount', $cartCount);
        } else {
            return redirect('login');
        }
    }


    //show cart 
    public function show_cart()
    {

        if (Auth::id()) {

            $id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $id)->get();

            return view('home.showcart', compact('cart'));
        } else {
            return redirect('login');
        }
    }

    //remove cart item
    public function remove_cart($id)
    {

        $cart = cart::find($id);
        $cart->delete();

        return redirect()->back()->with('message', 'product removed from cart');
    }

    //cash order function
    public function cash_order()
    {

        $user = Auth::user();

        $userid = $user->id;

        $data = cart::where('user_id', '=', $userid)->get();

        foreach ($data as $data) {

            $order = new order;

            $order->name = $data->name;

            $order->email = $data->email;

            $order->phone = $data->phone;

            $order->address = $data->address;

            $order->user_id = $data->user_id;

            $order->product_title = $data->product_title;

            $order->price = $data->price;

            $order->quantity = $data->quantity;

            $order->image = $data->image;

            $order->product_id = $data->product_id;

            $order->payment_status = 'cash on delivery';

            $order->delivery_status = 'processing';

            $order->save();

            $cart_id = $data->id;

            $cart = cart::find($cart_id);

            $cart->delete();
        }

        return redirect()->back()->with('message', 'We have recieved your order and will connnect with you soon');
    }

    //stripe payment page
    public function stripe($totalprice)
    {


        return view('home.stripe', compact('totalprice'));
    }

    //stripe payment function
    public function stripePost(Request $request, $totalprice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            "amount" => $totalprice * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Thanks for the purchase"
        ]);

        $user = Auth::user();

        $userid = $user->id;

        $data = cart::where('user_id', '=', $userid)->get();

        foreach ($data as $data) {

            $order = new order;

            $order->name = $data->name;

            $order->email = $data->email;

            $order->phone = $data->phone;

            $order->address = $data->address;

            $order->user_id = $data->user_id;

            $order->product_title = $data->product_title;

            $order->price = $data->price;

            $order->quantity = $data->quantity;

            $order->image = $data->image;

            $order->product_id = $data->product_id;

            $order->payment_status = 'Paid';

            $order->delivery_status = 'processing';

            $order->save();

            $cart_id = $data->id;

            $cart = cart::find($cart_id);

            $cart->delete();
        }

        Session::flash('success', 'Payment successful!');

        return back();
    }

    //show order function 
    public function show_order()
    {

        if (Auth::id()) {
            $user = Auth::user();

            $userid = $user->id;

            $order = order::where('user_id', '=', $userid)->get();

            return view('home.order', compact('order'));
        } else {
            return redirect('login');
        }
    }

    //cancel order function
    public function cancel_order($id)
    {

        $order = order::find($id);

        $order->delivery_status = 'Cancelled';

        $order->save();

        return redirect()->back()->with('message', 'Your order has been cancelled successfully');
    }

    //comment function
    public function add_comment(Request $request)
    {

        if (Auth::id()) {

            $comment = new comment;

            $comment->name = Auth::user()->name;

            $comment->user_id = Auth::user()->id;

            $comment->comment = $request->comment;

            $comment->save();

            return redirect()->back();
        } else {
            return redirect('login');
        }
    }

    //add reply function

    public function add_reply(Request $request)
    {

        if (Auth::id()) {

            $reply = new Reply;

            $reply->name = Auth::user()->name;

            $reply->user_id = Auth::user()->id;

            $reply->comment_id = $request->commentId;

            $reply->reply = $request->reply;

            $reply->save();

            return redirect()->back();
        } else {

            return redirect('login');
        }
    }

    //search product function
    public function product_search(Request $request)
    {


        $comment = Comment::orderby('id', 'desc')->get();

        $reply = Reply::all();

        $search_text = $request->search;

        $product = product::where('title', 'LIKE', "%$search_text%")->orWhere('category', 'LIKE', "$search_text")->paginate(9);

        return view('home.userpage', compact('product', 'comment', 'reply'));
    }

    //delete comment section
    public function delete_comment($id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            // Handle the case where the comment with the given ID is not found
            return redirect()->back()->with('message', 'Comment not found.');
        }

        // Check if the authenticated user owns the comment (Optional, if you want to restrict deletion)
        if (Auth::id() !== $comment->user_id) {
            return redirect()->back()->with('message', 'You are not authorized to delete this comment.');
        }

        $comment->delete();

        return redirect()->back()->with('message', 'Comment deleted successfully.');
    }

    //product page function
    public function product()
    {

        $product = Product::paginate(9);
        $comment = Comment::orderby('id', 'desc')->get();
        $reply = Reply::all();


        return view('home.all_product', compact('product', 'comment', 'reply'));
    }

    //product search function for product page

    public function search_product(Request $request)
    {


        $comment = Comment::orderby('id', 'desc')->get();

        $reply = Reply::all();

        $search_text = $request->search;

        $product = product::where('title', 'LIKE', "%$search_text%")->orWhere('category', 'LIKE', "$search_text")->paginate(9);

        return view('home.all_product', compact('product', 'comment', 'reply'));
    }
}
