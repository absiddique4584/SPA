<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Intervention\Image\ImageManagerStatic as Image;
use Auth;
class PostController extends Controller
{




    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function all_post(){
        $posts = Post::with('user','category')->orderBy('id','desc')->get();
        //return $posts;
        return response()->json([
            'posts'=>$posts
        ],200);
    }





    /**
     * @param Request $request
     * @throws \Illuminate\Validation\ValidationException
     */
    public function save_post(Request $request){

        $this->validate($request,[
            'title'=>'required|min:2|max:50',
            'description'=>'required|min:2|max:1000'
        ]);
        $strpos = strpos($request->photo,';');
        $sub = substr($request->photo,0,$strpos);
        $ex = explode('/',$sub)[1];
        $name = time().".".$ex;
        $img = Image::make($request->photo)->resize(700, 370);
        $upload_path = public_path()."/assets/uploadImage/";
        $img->save($upload_path.$name);
        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->cat_id = $request->cat_id;
        $post->user_id = Auth::user()->id;
        $post->photo = $name;
        $post->save();
    }





    /**
     * @param $id
     */
    public function delete_post($id){
        $post = Post::find($id);
        $image_path = public_path()."/assets/uploadImage/";
        $image = $image_path. $post->photo;
        if(file_exists($image)){
            @unlink($image);
        }
        $post->delete();
    }




    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit_post($id){
        $post = Post::find($id);
        return response()->json([
            'post'=>$post
        ],200);
    }





    /**
     * @param Request $request
     * @param         $id
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update_post(Request $request, $id){
        $post = Post::find($id);
        $this->validate($request,[
            'title'=>'required|min:2|max:50',
            'description'=>'required|min:2|max:1000'
        ]);


        if($request->photo!=$post->photo){
            $strpos = strpos($request->photo,';');
            $sub = substr($request->photo,0,$strpos);
            $ex = explode('/',$sub)[1];
            $name = time().".".$ex;
            $img = Image::make($request->photo)->resize(700, 370);
            $upload_path = public_path()."/assets/uploadImage/";
            $image = $upload_path. $post->photo;
            $img->save($upload_path.$name);

            if(file_exists($image)){
                @unlink($image);
            }
        }else{
            $name = $post->photo;
        }

        $post->title = $request->title;
        $post->description = $request->description;
        $post->cat_id = $request->cat_id;
        $post->user_id = Auth::user()->id;
        $post->photo = $name;
        $post->save();
    }

}
