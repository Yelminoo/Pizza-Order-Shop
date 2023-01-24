<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Storage;

class UserController extends Controller
{
    //user privielge
    //Home page
    public function home()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $history = Order::where('user_id', Auth::user()->id)->get();

        return view('user.main.home', compact('products', 'category', 'cart', 'history'));
    }

    //Contact
    public function contactPage()
    {
        return view('user.contact.contact');
    }

    //contact
    public function contact(Request $request)
    {

        $this->contactValidationCheck($request);
        $data = $this->getContactData($request);
        Contact::create($data);
        return back()->with(['sentSuccess' => 'Message sent successfully']);

    }

    //change password page
    public function changePasswordPage()
    {
        return view('user.password.change');
    }
    //details page
    public function details($id)
    {$p = Product::where('id', $id)->first();
        $pizzaList = Product::get();
        return view('user.main.details', compact('p', 'pizzaList'));
    }

    //cartList
    public function cartList()
    {$cart = Cart::select('carts.*', 'products.name as pizza_name', 'products.price as pizza_price', 'products.image as image')

            ->leftJoin('products', 'products.id', 'carts.product_id')
            ->where("carts.user_id", Auth::user()->id)
            ->paginate(5);
        $total = 0;
        foreach ($cart as $c) {
            $total += $c->pizza_price * $c->qty;
        }

        return view('user.main.cart', compact('cart', 'total'));
    }

    //orderlist
    public function orderList()
    {
        $order = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(5);
        return view('user.main.order', compact('order'));

    }

    //filter
    public function filter($catergoryid)
    {
        $products = Product::where('category_id', $catergoryid)->orderBy('created_at', 'desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $history = Order::where('user_id', Auth::user()->id)->get();

        return view('user.main.home', compact('products', 'category', 'cart', 'history'));

    }

    //password change
    public function changePassword(Request $request)
    {
        $this->passwordValidationCheck($request);
        $user = User::where('id', Auth::user()->id)->first();
        $dbHashpw = $user->password;
        if (Hash::check($request->oldPassword, $dbHashpw)) {
            $data = [
                'password' => Hash::make($request->newPassword),
            ];
            User::where('id', Auth::user()->id)->update($data);
            Auth::logout();
            return redirect()->route('auth#loginPage');

        } else {
            return back()->with(['notSame' => 'old password not correct']);
        }
    }
    //editpage

    public function editpage()
    {
        return view('user.profile.account');
    }

    //edit
    public function edit($id, Request $request)
    {

        $this->accountValidationCheck($request);
        $data = $this->getData($request);

        if ($request->hasFile('image')) {
            $dbImage = User::where('id', $id)->first();
            $dbImage = $dbImage->image;

            if ($dbImage != null) {
                Storage::delete('public/' . $dbImage);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;

        }
        User::where('id', $id)->update($data);
        return redirect()->route('user#editPage')->with(['editSuccess' => 'Edited Successfully..']);

    }
    private function passwordValidationCheck($request)
    {
        Validator::make($request->all(), [
            'oldPassword' => 'required|min:6|max:10',
            'newPassword' => 'required|min:6|max:10',
            'confirmPassword' => 'required|min:6|max:10|same:newPassword',

        ])->validate();
    }

    private function accountValidationCheck($request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
            'gender' => 'required',

        ])->validate();
    }

    private function contactValidationCheck($request)
    {

        Validator::make($request->all(), [

            'username' => 'required',
            'useremail' => 'required',
            'name' => 'required|same:username',

            'email' => 'required|same:useremail',
            'message' => 'required',

        ],
        )->validate();

    }

    private function getData($request)
    {
        return
            [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
            'updated_at' => Carbon::now(),

        ];

    }
    private function getContactData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'updated_at' => Carbon::now(),
        ];
    }

    //user privelege end

    //user account control by admin
    //user list

    public function userlist()
    {
        $user = User::
            when(request('key'), function ($query) {
            $query->orWhere('name', 'like', '%' . request('key') . '%')
                ->orWhere('email', 'like', '%' . request('key') . '%')
                ->orWhere('address', 'like', '%' . request('key') . '%')
                ->orWhere('gender', 'like', '%' . request('key') . '%')

            ;
        })
            ->where('role', 'user')
            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('admin.account.userlist', compact('user'));

    }

    //delete user
    public function userdelete($id)
    {
        User::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'deleted successfully...']);

    }

    //ajax change user role
    public function ajaxchangeuserRole(Request $request)
    {
        User::where('id', $request->user_id)->update(['role' => 'admin']);

    }

    public function usereditPage($id)
    {
        $user = User::where('id', $id)->get();

        return view('admin.account.useredit', compact('user'));
    }

    //edit users

    public function useredit($id, Request $request)
    {
        $this->userAccountValidationCheck($request);
        $data = $this->getUserData($request);

        if ($request->hasFile('image')) {
            $dbImage = User::where('id', $id)->first();
            $dbImage = $dbImage->image;

            if ($dbImage != null) {
                Storage::delete('public/' . $dbImage);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;

        }
        User::where('id', $id)->update($data);
        return redirect()->route('user#listPage')->with(['editSuccess' => 'Edited Successfully..']);

    }

    private function userAccountValidationCheck($request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
            'gender' => 'required',

        ])->validate();
    }

    private function getUserData($request)
    {
        return
            [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
            'updated_at' => Carbon::now(),

        ];
    }

    //user account control end

}