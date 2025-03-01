<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Alert;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::id()) {
            $post = Post::where('post_status', '=','active')->get();
            $usertype = Auth()->user()->usertype;
            if ($usertype == 'user') {
                return view('home.homepage', compact('post'));
            } else if ($usertype == 'admin') {
                return view('admin.adminhome', compact('post'));
            } else {
                return view('home.homepage', compact('post'));
            }
        } else {
            return view('home.homepage');
        }
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $usertype = $request->input('usertype');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($usertype === 'admin' && $user->usertype === 'admin') {
                $request->session()->put('test_session', 'test_value');
                return redirect()->route('admin.index');
            } else {
                return redirect()->route('home');
            }
        }

        return redirect()->route('login.form')->withErrors(['message' => 'Invalid credentials']);
    }

    public function homepage()
    {
        $post = Post::where('post_status', '=','active')->get();
        return view('home.homepage', compact('post'));
    }

    public function post_details($id)
    {
        $post = Post::find($id);
        return view('home.post_details', compact('post'));
    }

    public function create_post()
    {
        return view('home.create_post');
    }

    public function user_post(Request $request)
    {
        $user = Auth()->user();
        $user_id = $user->id;
        $username = $user->name;
        $usertype = $user->usertype;

        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;

        $post->user_id = $user_id;
        $post->name = $username;
        $post->usertype = $usertype;
        $post->post_status = 'pending';

        $image = $request->image;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('postimage', $imagename);
            $post->image = $imagename;
        } else {
            $post->image = null;
        }

        $post->save();

        Alert::success('Congrats', 'You have Added the data Sucessfully');

        return redirect()->back();
    }

    public function my_post()
    {
        if (auth()->check()) {
            
            $user = Auth()->user();
            $user_id = $user->id;

            $data = Post::all();

            return view('home.my_post', compact('data'));
        } else {
            return redirect()->route('login');
        }
    }

    public function my_post_del($id) 
{
    $data = Post::find($id);
    if ($data) { 
        $data->delete();
        return redirect()->back()->with('message', 'Post deleted successfully');
    } else {
        return redirect()->back()->with('error', 'Post not found'); 
    }
}

    public function post_update_page($id)
    {
        $data = Post::find($id);
        return view('home.post_page', compact('data'));
    }
    public function update_post_data(Request $request, $id)
    {
        $data = Post::find($id);
        $data->title = $request->title;
        $data->description = $request->description;
    
        if ($request->hasFile('image')) { // Check if a new image was uploaded
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('postimage', $imagename);
            $data->image = $imagename;
        }
    
        $data->save();
    
        return redirect()->back()->with('message', 'Post Updated Successfully');
    }
}