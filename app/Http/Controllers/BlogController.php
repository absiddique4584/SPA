<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
class BlogController extends Controller
{



    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function  get_all_blog_post(){
        $posts = Post::with('user','category')->orderBy('id','desc')->get();
        return response()->json([
            'posts'=>$posts
        ],200);
    }




    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getpost_by_id($id){
        $post = Post::with('user','category')->where('id',$id)->orderBy('id','desc')->first();
        return response()->json([
            'post'=>$post
        ],200);
    }




    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_all_category(){
        $categories = Category::all();
        return response()->json([
            'categories'=>$categories
        ],200);
    }





    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_all_post_by_cat_id($id){
        $posts = Post::with('user','category')->where('cat_id',$id)
            ->orderBy('id','desc')
            ->get();
        //return $posts;
        //exit();
        return response()->json([
            'posts'=>$posts
        ],200);
    }




    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function search_post(){

        $search = \Request::get('s');
        if($search!=null){
            $posts = Post::with('user','category')
                ->where('title','LIKE',"%$search%")
                ->orWhere('description','LIKE',"%$search%")
                ->get();
            return response()->json([
                'posts'=>$posts
            ],200);
        }else{
            return $this->get_all_blog_post();
        }
    }




    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function latest_post(){
        $posts = Post::with('user','category')->orderBy('id','desc')->latest()->get();
        return response()->json([
            'posts'=>$posts
        ],200);
    }
}
