<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Governorate;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Gate;

class CityController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
      //  Gate::Authorize('cities.view');

        $records = City::where(function ($q) use ($request) {
            if ($request->name) {
                $q->where('name', 'LIKE', '%' . $request->name . '%');
            }
            if ($request->governorate_id) {
                $q->where('governorate_id', $request->input('governorate_id'));
            }
        })->paginate(10);
        return view('cities.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return
     */
    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
    //    Gate::Authorize('cities.create');

        $governorates = Governorate::pluck('name', 'id')->toArray();
        return view('cities.create', compact('governorates'));
    }


    public function store(Request $request)
    {
     //   Gate::Authorize('cities.create');

        $rules = [
            'name'           => 'required|unique:cities,name',
            'governorate_id' => 'required|integer|exists:governorates,id'
        ];
        $messages = [
            'name.required'           => 'الاسم مطلوب',
            'name.unique'             => 'اسم المدينة مستخدم من قبل',
            'governorate_id.required' => 'المحافظة مطلوبة',
            'governorate_id.integer'  => 'المحافظة يجب أن تكون رقم صحيح',
            'governorate_id.exists'   => 'المحافظة المختارة غير موجودة'

        ];
        $this->validate($request,$rules,$messages);
        $record = City::create($request->all());
        $record->save();
        flash()->success("Successfully Record Added");
        return redirect()->route('cities.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return
     */
    public function show($id)
    {
      //  Gate::Authorize('cities.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
      //  Gate::Authorize('cities.update');

        $model = City::findOrFail($id);
        return view('cities.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param
     * @param
     * @return
     */
    public function update(Request $request, $id): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
      //  Gate::Authorize('cities.update');

        $record = City::findOrFail($id);
        $record->update($request->all());
        flash()->success('تم التحديث بنجاح');
        return redirect(route('cities.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return
     */
    public function destroy($id)
    {
      //  Gate::Authorize('cities.delete');

        $record = City::findorfail($id);
        $record->delete();
        flash()->success("Successfully Record Deleted");

        return redirect()->route('cities.index');
    }

}
