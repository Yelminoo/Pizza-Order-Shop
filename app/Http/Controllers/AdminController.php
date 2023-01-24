<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Storage;

class AdminController extends Controller
{
    //list page
    function list() {
        $admin = User::
            when(request('key'), function ($query) {
            $query->orWhere('name', 'like', '%' . request('key') . '%')
                ->orWhere('email', 'like', '%' . request('key') . '%')
                ->orWhere('address', 'like', '%' . request('key') . '%')
                ->orWhere('gender', 'like', '%' . request('key') . '%')

            ;
        })
            ->where('role', 'Admin')
            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('admin.account.list', compact('admin'));
    }





    //delete admin
    public function delete($id)
    {
        User::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'deleted successfully...']);

    }

    //change role
    public function changeRole($id)
    {
        $admin = User::where('id', $id)->first();
        return view('admin.account.changeRole', compact('admin'));
    }

    //change
    public function change(Request $request)
    {

        $data = $this->requestUserData($request);
        $id = $request->id;
        User::where('id', $id)->update($data);
        return redirect()->route('admin#listPage');

    }

    //ajax change role
    public function ajaxchangeRole(Request $request)
    {
        User::where('id', $request->user_id)->update(['role' => 'user']);

    }



    //get data for change
    private function requestUserData($request)
    {
        return [
            'role' => $request->role,
        ];
    }

    //account
    //password change page
    //password change page
    public function passwordchangePage()
    {
        return view('admin.account.changepassword');

    }

    //account
    public function details()
    {
        return view('admin.account.details');
    }

    //acc editpage

    public function editpage()
    {
        return view('admin.account.edit');
    }
    //acc edit

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
        return redirect()->route('admin#details')->with(['editSuccess' => 'Edited Successfully..']);

    }

    //password change
    public function passwordchange(Request $request)
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

}
