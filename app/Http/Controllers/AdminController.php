<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.adminhome');
    }

    public function post_page()
    {
        return view('admin.post_page');
    }

    public function add_post(Request $request) 
    {
        $user = Auth::user();
        $user_id = $user->id;
        $name = $user->name;
        $usertype = $user->usertype;

        $post = new Post;
        $post->user_id = $user_id;
        $post->name = $name;
        $post->usertype = $usertype;
        $post->title = $request->title;
        $post->description = $request->description;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('postimage', $imagename);
            $post->image = $imagename;
        } else {
            $post->image = null;
        }

        $post->post_status = 'active';
        $post->save();

        return redirect()->back()->with('message', 'Post Added Sucessfully');
    }

    public function show_post()
    {
        $posts = Post::all(); // Fetch all posts

        return view('admin.show_post', compact('posts')); // Pass the posts to the view
    }

    public function delete_post($id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect()->back()->with('messge', 'Post Delete Successfully');
    }

    public function edit_page($id){
        $post= Post::find($id);
        return view('admin.edit_page', compact('post'));
    }
    public function update_post(Request $request, $id){
        $data= Post::find($id);
        $data->title=$request->title;
        $data->description=$request->description;
        $image=$request->image;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('postimage', $imagename);
            $data->image = $imagename;
        } else {
            $post->image = null;
        }

        $data->save;
        return redirect()->back()->with('message','Post Update Successfully');
    }

    public function accept_post($id)
    {
        $data=Post::find($id);
        $data->post_status='active';
        $data->save();

        return redirect()->back()->with('message', 'Post Status changed to Active');
    }

    public function reject_post($id)
    {
        $data=Post::find($id);
        $data->post_status='rejected';
        $data->save();

        return redirect()->back()->with('message', 'Post Status changed to Rejected');
    }

}