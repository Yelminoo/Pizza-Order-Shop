<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //list && search
    public function list() {
        $categories=Category::when(request('key'),function($query){
            $query->where('name','like','%'.request('key').'%');
        })
        ->orderBy('id','desc')
        ->paginate(5);
        return view('admin.category.list',compact('categories'));
    }




    //create page
    public  function createPage(){
        return view('admin.category.create');
    }
    //create
    public function create(Request $request){
        $this->validateCheck($request);
        $data=$this->requestCategoryData($request);
        Category::create($data);
        return redirect()->route('list#Page');


    }
    //delete category
    public function delete($id){
        Category::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Deleted successfully...']);
    }


    //edit page
    public function editPage($id){
        
        $category=Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }

    //update
    public function update(Request $request){
         $this->validateCheck($request);
        $data=$this->requestCategoryData($request);
        Category::where('id',$request->categoryId)->update($data);
        return redirect()->route('list#Page')->with(['updateSuccess'=> 'Updated successfully']);


    }

    //validation
    private function validateCheck($request){
        Validator::make($request->all(),[
            'categoryName' =>'required|unique:categories,name,'.$request->categoryId
        ])->validate();
    }

    //get data
    private function requestCategoryData($request){
        return[
            'name'=>$request->categoryName,
        ];
    }
}
