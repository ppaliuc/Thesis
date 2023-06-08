<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function blogs(){
        try{
            $blogs = Blog::all();
            return response()->json(['status' => true, 'data' => BlogResource::collection($blogs), 'error' => []]);
        }
        catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function recentBlogs(){
        try{
            $blogs = Blog::orderBy('id','desc')->orderBy('id','desc')->limit(3)->get();
            return response()->json(['status' => true, 'data' => BlogResource::collection($blogs), 'error' => []]);
        }
        catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function blogDetails($slug){
        try{
            $blog = Blog::whereSlug($slug)
                         ->whereStatus(1)
                         ->first();
            return response()->json(['status' => true, 'data' => new BlogResource($blog), 'error' => []]);
        }
        catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function blogCategory(){
        try{
            $categories = BlogCategory::all();
            return response()->json(['status' => true, 'data' => $categories, 'error' => []]);
        }
        catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function categoryBlogs($slug){
        try{
            $bcat = BlogCategory::where('slug', '=', str_replace(' ', '-', $slug))->first();
            $blogs = $bcat->blogs()->orderBy('created_at','desc')->paginate(3);
            
            return response()->json(['status' => true, 'data' => BlogResource::collection($blogs), 'error' => []]);
        }
        catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }
}
