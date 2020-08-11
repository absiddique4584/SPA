<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{


    /**
     * @param Request $request
     * @return string[]
     * @throws \Illuminate\Validation\ValidationException
     */
    public function add_category(Request $request){
        $this->validate($request,[
            'cat_name'=>'required|min:2|max:50'
        ]);

        $category =new Category();
        $category ->cat_name =$request->cat_name;
        $category->save();
        return ['message'=>'ok'];
        // Category::create([
        //     'cat_name' =>$request->cat_name,
        // ]);

        //return redirect()->back();
    }




    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function all_category(){
        $categories = Category::orderBy('id','DESC')->get();
        return response()->json([
            'categories'=>$categories
        ],200);
    }




    /**
     * @param $id
     */
    public function delete_category($id){
        $category = Category::find($id);
        $category->delete();
    }




    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit_category($id){
        $category = Category::find($id);
        //return $category;
        return response()->json([
            'category'=>$category
        ],200);
    }




    /**
     * @param Request $request
     * @param         $id
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update_category(Request $request,$id){
        $this->validate($request,[
            'cat_name'=>'required|min:2|max:50'
        ]);
        $category = Category::find($id);
        $category->cat_name = $request->cat_name;
        $category->save();
    }




    /**
     * @param $ids
     */
    public function selected_category($ids){
        $all_id = explode(',',$ids);
        foreach ($all_id as $id){
            $category = Category::find($id);
            $category->delete();
        }
    }
}
