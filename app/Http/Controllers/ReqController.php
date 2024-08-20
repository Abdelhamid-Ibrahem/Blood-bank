<?php

namespace App\Http\Controllers;

use App\Models\BloodType;
use App\Models\City;
use App\Models\DonationRequest;
use Illuminate\Http\Request;

class ReqController extends DonationController
{
    public function edit($id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {

        $donations = DonationRequest::all();
        $bloodtypes = BloodType::pluck('name', 'id')->toArray();
        $cities = City::pluck('name', 'id')->toArray();;
        $model = DonationRequest::findOrFail($id);
        view()->share(compact('donations', 'bloodtypes', 'cities', 'model' ));
        return view('front.request', compact('model', 'bloodtypes', 'cities', 'donations'));
    }

        public function index()
    {
        $donations = DonationRequest::all();

        return view('front.request', compact('donations'));
    }


}
