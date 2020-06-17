<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{

    public static $post = Null;


    public function __construct()
    {
    	if (self::$post == Null) {
    		self::$post = new Post;
    	}
    }
    public function index()
    {
        return view('posts.index');
    }

    public function create()
    {
        return view('posts.create');
    }


    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [ // <---
        'title' => 'required|unique:posts|max:255',
        'body' => 'required',
    ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        self::$post->create([
            'title'=>$request->title,
            'body'=>$request->body,
        ]);
        return redirect()->back()
        ->withInput(['status'=>"dome add post"]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
