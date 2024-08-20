<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SettingController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     *
     * @param Setting $model
     * @return
     */
    public function index(Setting $model): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
      //  Gate::Authorize('settings.view');

        if ($model->all()->count() > 0) {
            $model = Setting::find(1);
        }
        return view('settings.index', compact('model'));
    }


    public function update(Request $request)
    {
     //   Gate::Authorize('settings.view');

        $this->validate($request, [
            'fb_link'  => 'url',
            'tw_link'   => 'url',
            'insta_link' => 'url',
            'goplus_link'    => 'url',
            'youtube_link'    => 'url',



        ]);
        if (Setting::all()->count() > 0) {
            Setting::find(1)->update($request->all());
        } else {
            Setting::create($request->all());
        }
        flash()->success('تم الحفظ بنجاح');
        return redirect()->route('setting.index')->with('success', 'تم التحديث بنجاح');

    }

}
