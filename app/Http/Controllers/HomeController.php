<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function home()
    {
        $posts = Post::take(6)->get();

        return view('front.home', compact('posts'));
    }

    public function index()
    {
        $posts = Post::take(6)->get();

        return view('front.home', compact('posts'));


    }
}
