<?php

namespace App\Http\Controllers;

use App\Models\Governorate;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Gate;

class GovernorateController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
         Gate::Authorize('governorates.view');

        $records = Governorate::where(function($q) use($request) {
            if ($request->has('name')) {
                $q->where('name', 'LIKE', '%' . $request->name . '%');
            }
        })->simplepaginate(10);

        return view('governorates.index', compact('records'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
      //  Gate::Authorize('governorates.create');

        return view('governorates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    //    Gate::Authorize('governorates.create');

        $rules =[
            'name' => 'required'
            ];
        $messages = [
            'name.required' => 'Name is Required'
        ];
        $this->validate($request,$rules,$messages);
        $record = new Governorate;
        $record->name = $request->input('name');
        $record->save();
        flash()->success("Successfully Record Added");
        return redirect()->route('governorates.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
  //      Gate::Authorize('governorates.update');

        $model = Governorate::findorfail($id);
        return view('governorates.edit',compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
   //     Gate::Authorize('governorates.update');

        $record = Governorate::findorfail($id);
        $record->update($request->all());
        flash()->success("Successfully Record Updated");
        return redirect()->route('governorates.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
  //      Gate::Authorize('governorates.delete');

        $record = Governorate::findorfail($id);
        $record->delete();
        flash()->success("Successfully Record Deleted");
        return redirect()->route('governorates.index');
    }
}
