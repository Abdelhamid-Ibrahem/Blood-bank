<?php

namespace App\Http\Controllers;

use App\Models\BloodType;
use App\Models\City;
use App\Models\DonationRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DonationController extends Controller
{
    use ValidatesRequests;

    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index()
    {
   //     Gate::Authorize('donations.view');

        $records = DonationRequest::paginate(20);
        return view('donations.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return
     */
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
       // Gate::Authorize('donations.create');

        $bloodtypes = BloodType::pluck('name', 'id')->toArray();
        $cities = City::pluck('name', 'id')->toArray();

        return view('donations.create', compact('bloodtypes', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param
     * @return
     */
    public function store(Request $request)
    {
        //

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id

     */
    public function edit($id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
     //   Gate::Authorize('donations.update');

        $bloodtypes = BloodType::pluck('name', 'id')->toArray();
        $cities = City::pluck('name', 'id')->toArray();;
        $model = DonationRequest::findOrFail($id);
        return view('donations.edit', compact('model', 'bloodtypes', 'cities'));

    }


    public function update(Request $request, $id): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
      //  Gate::Authorize('donations.update');

        $rules = [
            'patient_name' => 'required',
            'patient_age' => 'required',
            'hospital_name' => 'required',
            'hospital_address' => 'required',
            'bags_num' => 'required',
            'patient_phone' => 'required',
            'blood_type_id' => 'required',
            'city_id' => 'required',
            'details' => 'required',
        ];
        $this->validate($request, $rules);
        $record = DonationRequest::findOrFail($id);
        $record->update($request->all());
        flash()->success('تــم التحديث');
        return redirect(route('donations.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return
     */
    public function destroy($id)
    {
    //    Gate::Authorize('donations.delete');

        $record = DonationRequest::find($id);
        if (!$record) {
            return response()->json([
                'status' => 0,
                'message' => 'تعذر الحصول على البيانات'
            ]);
        }

        $record->delete();
        return response()->json([
            'status' => 1,
            'message' => 'تم الحذف بنجاح',
            'id' => $id
        ]);
    }

}
