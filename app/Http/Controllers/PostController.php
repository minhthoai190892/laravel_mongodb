<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
/**
 * PostController
 * @method function index()
 * @method function create()
 * @method function store()
 * @method function show()
 * @method function edit()
 * @method function destroy()
 * destroy
 */
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */
    public function index()
    {
        //!TODO: lấy dữ liệu
        $posts = Post::get()->toArray();
        //!TODO: hiển thị dữ liệu tạm thời
        // dd($posts);
        //!TODO: trả về tra hiển thị
        return view('posts.show')->with(compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //!TODO: trả vê trang cần hiển thị
        return view("posts.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //!TODO:
        if ($request->isMethod('post')) {
            # code...
            $data = $request->all();
            // echo "<pre>";
            // print_r($data);
            // die;
            $post = new Post;
            $post->title = $data['title'];
            $post->description = $data['description'];
            $post->status = 1;
            $post->save();
            return redirect()->back()->with('success_message', 'Post add success');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //!TODO:
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //!TODO: test thông tin bài post
        // echo $post['_id'];die;
        //!TODO: tìm bài post trong csdl
        $postDetails = Post::find($post['id']);
        //!TODO: dùng để kiểm tra mảng bài post
        // dd($postDetail);
        return view('posts.edit')->with(compact('postDetails'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //!TODO: xem dữ liệu trước update
        echo $post;
        echo '--';
        if ($request->isMethod('PUT')) {
            //!TODO: lấy dữ liệu được update
            $data = $request->all();
            //!TODO: kiểm tra dữ liệu sau update
            // echo "<pre>";print_r($data);die;
            //!TODO: UPdate vào database
            Post::where('_id', $post['_id'])->update(['title' => $data['title'], 'description' => $data['description']]);
            //!TODO: hiển thị trang show với message
            return redirect('/posts')->with('success_message','Post updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
