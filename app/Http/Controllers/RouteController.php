<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    //product list
    public function productList()
    {
        $data = Product::orderBy('id', 'desc')->get();
        return response()->json($data, 200);
    }

    //category list
    public function categoryList()
    {
        $data = Category::orderBy('id', 'desc')->get();
        return response()->json($data, 200);
    }

    //all data list
    public function dataList()
    {
        $product = Product::orderBy('id', 'desc')->get();

        $category = Category::orderBy('id', 'desc')->get();
        $data = [
            'product' => $product,
            'category' => $category,

        ];
        return response()->json($data['product'][0]->name, 200);
    }

    //create data
    //create category
    public function categoryCreate(Request $request)
    {
        $data = $this->getCategoryData($request);
        $contact = Category::create($data);
        return response()->json([$contact, 'message' => 'success'], 200);

    }

    //contact create
    public function contactCreate(Request $request)
    {
        $data = $this->getContactData($request);
        $category = Contact::create($data);
        return response()->json([$category, 'message' => 'success'], 200);

    }

    //delete data
    //delete category
    public function categoryDelete($id)
    {

        $data = Category::where('id', $id)->first();
        if (isset($data)) {
            Category::where('id', $id)->delete();
            return response()->json(['status' => true, 'message' => 'delete success'], 200);
        } else {
            return response()->json(['status' => false, 'message' => 'not exist'], 200);
        }

    }

    //contact delete
    public function contactDelete($id)
    {
        $data = Contact::where('id', $id)->first();
        if (isset($data)) {
            Contact::where('id', $id)->delete();
            return response()->json(['status' => true, 'message' => 'delete success'], 200);
        } else {
            return response()->json(['status' => false, 'message' => 'not exist'], 200);
        }

    }

    //edit data
    //edit category
    public function categoryEdit(Request $request)
    {
        $dbSource = Category::where('id', $request->id)->first();
        if (isset($dbSource)) {
            $data = $this->updateCategoryData($request);
            $response = Category::where('id', $request->id)->update($data);
            return response()->json(['status' => true, 'message' => 'update success', 'update' => $response], 200);

        } else {
            return response()->json(['status' => false, 'message' => 'update id not exist'], 200);
        }

    }

    //edit contact
    public function contactEdit(Request $request)
    {
        $dbSource = Contact::where('id', $request->id)->first();
        if (isset($dbSource)) {
            $data = $this->updateContactData($request);
            $response = Contact::where('id', $request->id)->update($data);
            return response()->json(['status' => true, 'message' => 'update success', 'update' => $response], 200);

        } else {
            return response()->json(['status' => false, 'message' => 'update id not exist'], 200);
        }

    }

    private function getCategoryData($request)
    {
        return [
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    private function getContactData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    private function updateCategoryData($request)
    {
        return [
            'name' => $request->name,
            'updated_at' => Carbon::now(),
        ];
    }

    private function updateContactData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'updated_at' => Carbon::now(),
        ];
    }

}