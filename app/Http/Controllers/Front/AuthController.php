<?php

namespace App\Http\Controllers\Front;

use App\Actions\Fortify\CreateNewUser;
use App\Models\Governorate;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function register(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {

        return view('front.register');
    }

    public function login(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        return view('front.login');
    }
    public function registerSave(Request $request)
    {

    }
  /*  public function loginClient(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $posts = Post::where('publish_date', '<', carbon::now()->toDateString())->take(6)->get();
        return view('front.home' , compact('posts'));
    }*/
}
