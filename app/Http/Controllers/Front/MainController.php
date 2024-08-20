<?php

namespace App\Http\Controllers\Front;

use App\Models\BloodType;
use App\Models\City;
use App\Models\Client;
use App\Models\DonationRequest;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function home(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $clients = Client::first();
        Auth('client-web')->login($clients);

        $bloodtypes = BloodType::pluck('name', 'id')->toArray();
        $cities = City::pluck('name', 'id')->toArray();
        $donations = DonationRequest::all();
        $posts = Post::where('publish_date', '<', carbon::now()->toDateString())->take(6)->get();
        return view('front.home', compact('posts', 'bloodtypes', 'cities', 'donations'));
    }


    public function about()
    {
        return view('front.about');
    }

    public function article()
    {
        $posts = Post::all();
        return view('front.article', compact('posts'));
    }

    public function donationRequests()
    {
        $donations = DonationRequest::all();
        $bloodtypes = BloodType::pluck('name', 'id')->toArray();
        $cities = City::pluck('name', 'id')->toArray();

        return view('front.donations', compact('donations', 'bloodtypes', 'cities'));

    }

    public function contact()
    {
        return view('front.contact');
    }

    public function toggleFavourite(Request $request): \Illuminate\Http\JsonResponse
    {
        $toggle = $request->user()->favourites()->toggle($request->post_id);
        return responseJson(1, 'success', $toggle);
    }
}
