<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //list page
    public function contactList()
    {
        $contact = Contact::
            select('contacts.*', 'users.image as user_image', 'users.address as user_address', 'users.phone as user_phone', "users.gender as user_gender")
            ->leftJoin('users', 'users.name', 'contacts.name')
            ->when(request('key'), function ($query) {
                $query->orWhere('name', 'like', '%' . request('key') . '%')
                    ->orWhere('email', 'like', '%' . request('key') . '%')
                    ->orWhere('message', 'like', '%' . request('key') . '%')

                ;
            })

            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('admin.contact.contact', compact('contact'));

    }
    public function details($id)
    {
        $c = Contact::where('id', $id)->first();
        $c = Contact::select('contacts.*', 'users.image as user_image', 'users.address as user_address', 'users.phone as user_phone', "users.gender as user_gender")
            ->leftJoin('users', 'users.name', 'contacts.name')
            ->first();

        return view('admin.contact.contactDetails', compact('c'));
    }

    public function delete($id)
    {
        Contact::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'deleted successfully...']);

    }
}