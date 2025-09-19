<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PostsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    public function index(){
        $posts = DB::table('posts')->join('users', 'posts.user_id','=', 'users.id')
        ->select('posts.*', 'users.name as author_name')->get();

        return response()->json($posts);    

    }
    public function store(Request $request){
        $validate = $request->validate([
            "title"=> "required|string|max:255",
            "content"=> "required|string",
            "is_published"=> "nullable|boolean",

        ]);

        $post = PostsModel::create([
            'user_id'=> Auth::id(),
            'title'=> $validate['title'],
            'content'=>$validate['content'],
            'is_published'=> $validate['is_published'],
        ]);

        $post->load('post_log');

        return response()->json([
            "post"=>$post,
            "log_created"=>true,
        ],201);
    }
   
}
