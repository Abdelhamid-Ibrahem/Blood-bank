<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return
     */
    public function index(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
    //    Gate::Authorize('clients.view');

        $records = Client::where(function ($query) use($request){
            if ($request->input('keyword'))
            {
                $query->where(function ($query) use($request){
                    $query->where('name','like','%'.$request->keyword.'%');
                    $query->orWhere('phone','like','%'.$request->keyword.'%');
                    $query->orWhere('email','like','%'.$request->keyword.'%');
                    $query->orWhereHas('city',function ($city) use($request){
                    $city->where('name','like','%'.$request->keyword.'%');
                    });
                });
            }

            if ($request->input('blood_type_id'))
            {
                $query->where('blood_type_id',$request->blood_type_id);
            }
        })->cursorpaginate(20);
        return view('clients.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return
     */
    public function create()
    {
     //   Gate::Authorize('clients.create');
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
     * @param  int  $id
     * @return
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param
     * @param  int  $id
     * @return
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return
     */
    public function destroy($id)
    {
      //  Gate::Authorize('clients.delete');

        $record = Client::findorfail($id);
        $record->delete();
        flash()->success("Successfully Record Deleted");
        return Redirect::route('clients.index')->with('success','Record deleted successfully');
/*-
           if (!$record) {
            return response()->json([
                    'status' => 0,
                    'message' => 'تعذر الحصول على البيانات',
                ]);
        }


        if ($record->requests()->count() || $record->contacts()->count()) {
            return response()->json([
                    'status' => 0,
                    'message' => 'يوجد عمليات مرتبطة بهذا العميل',
                ]);
        }

        $record->delete();
        return response()->json([
            'status' => 1,
            'message' => 'تم الحذف بنجاح',
            'id' => $id,
        ]);
-*/
    }

    public function activate($id): \Illuminate\Http\RedirectResponse
    {

        $client = Client::findOrFail($id);
        $client->update(['is_active' => 1]);
        flash()->success('تم التفعيل');
        return back();
    }

    public function deactivate($id): \Illuminate\Http\RedirectResponse
    {
        $client = Client::findOrFail($id);
        $client->update(['is_active' => 0]);
        flash()->success('تم إلغاء التفعيل');
        return back();
    }

    public function toggleActivation($id): \Illuminate\Http\RedirectResponse
    {
        $client = Client::findOrFail($id);
        $msg = 'تم التفعيل';
        if ($client->is_active)
        {
            $msg = 'تم إلغاء التفعيل';
            $client->update(['is_active' => 0]);
        }else{
            $client->update(['is_active' => 1]);
        }
        flash()->success($msg);
        return back();
    }

}
