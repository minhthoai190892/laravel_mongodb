<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */
    public function index()
    {
        // lấy dữ liệu
        $posts = Post::get()->toArray();
        // hiển thị dữ liệu tạm thời
        // dd($posts);
        // trả về tra hiển thị
        return view('posts.show')->with(compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // trả vê trang cần hiển thị
        return view("posts.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        if ($request->isMethod('post')) {
            # code...
            $data = $request->all();
            // echo "<pre>";
            // print_r($data);
            // die;
            $post = new Post;
            $post->title = $data['title'];
            $post->description = $data['description'];
            $post->status =1;
            $post->save();
            return redirect()->back()->with('success_message','Post add success');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
