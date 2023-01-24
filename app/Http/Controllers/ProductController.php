<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Storage;

class ProductController extends Controller
{
    //product list
    function list() {
        $pizzas = Product::select('products.*', 'categories.name as category_name')
            ->when(request('key'), function ($query) {
                $query->where('products.name', 'like', '%' . request('key') . '%');
            })
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->orderBy('products.id', 'desc')->paginate(5);
        return view('admin.product.list', compact('pizzas'));
    }

    //createPage
    public function createPage()
    {
        $categories = Category::select('id', 'name')->get();
        return view('admin.product.create', compact('categories'));
    }

    // create
    public function create(Request $request)
    {

        $this->productValidationCheck($request, "create");
        $data = $this->getData($request);

        $fileName = uniqid() . $request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public/', $fileName);
        $data['image'] = $fileName;

        Product::create($data);
        return redirect()->route('product#listPage');

    }

    //edit

    public function edit($id)
    {

        $pizza = Product::where('id', $id)->first();
        $category = Category::get();
        return view('admin.product.edit', compact('pizza', 'category'));
    }

    //update
    public function update(Request $request)
    {
        $this->productValidationCheck($request, "update");
        $data = $this->getData($request);
        if ($request->hasFile('pizzaImage')) {
            $dbimage = Product::where('id', $request->pizzaId)->first();
            $dbimage = $dbimage->image;
            if ($dbimage != null) {
                Storage::delete('public/' . $dbimage);
            }
            $fileName = uniqid() . $request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public', $fileName);
            $data['image'] = $fileName;

        }
        Product::where('id', $request->pizzaId)->update($data);
        return redirect()->route('product#listPage')->with(['updateSuccess' => 'updated successfully...']);

    }

    //delete
    public function delete($id)
    {
        Product::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'Deleted successfully...']);

    }

    //details
    public function details($id)
    {
        $product = Product::where('id', $id)->first();

        return view('admin.product.details', compact('product'));
    }

    private function productValidationCheck($request, $action)
    {
        $validationRule = [
            'pizzaName' => 'required|min:5|unique:products,name,' . $request->pizzaId,
            'categoryId' => 'required',
            'pizzaPrice' => 'required',
            'pizzaDescription' => 'required|min:10',
            'waitingTime' => 'required',

        ];

        $validationRule['pizzaImage'] = $action == "create" ? 'required|mimes:png,jpeg,jpg,webp|file' : 'mimes:png,jpeg,jpg,webp|file';
        Validator::make($request->all(), $validationRule)->validate();

    }

    private function getData($request)
    {
        return [
            'name' => $request->pizzaName,
            'category_id' => $request->categoryId,
            'price' => $request->pizzaPrice,
            'description' => $request->pizzaDescription,
            'waiting_time' => $request->waitingTime,
        ];
    }
}