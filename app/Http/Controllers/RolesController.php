<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Gate;

class RolesController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index()
    {
       // Gate::Authorize('roles.view');

        $roles = Role::paginate(10);
        return view('roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return
     */
    public function create(Role $role)
    {
        //Gate::Authorize('roles.create');

        return view('roles.create', ['role' => new Role(),]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request )
    {
      //  Gate::Authorize('roles.create');

        $request->validate([
            'name' => 'required|string|max:255',
            'abilities' => 'required|array',
            'abilities.*' => 'required|string|in:allow,deny',
        ]);
        $role = Role::createWithAbilities($request);
        flash()->success('تــم اضــافة الصـــلاحية بنجــاح');
        return redirect()->route('roles.index');
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
    public function edit(Role $role)
    {
    //    Gate::Authorize('roles.update');

        $role_abilities = $role->abilities()->pluck('type', 'ability')->toArray();
        return view('roles.edit',compact('role', 'role_abilities'));
    }


    /**
     * @param Request $request
     * @param $id
     * @return
     */
    public function update(Request $request, Role $role)
    {
       // Gate::Authorize('roles.update');

        $request->validate([
            'name' => 'required|string|max:255',
            'abilities' => 'required|array',
        ]);
        $role->updateWithAbilities($request);
        flash()->success('تم التحديث بنجاح');

        return redirect(route('roles.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return
     */
    public function destroy($id)
    {
      //  Gate::Authorize('roles.delete');

        Role::destroy($id);
        flash()->success('تم الحــذف بنــجـاح ');
         return redirect(route('roles.index'));

/* $record = Role::find($id);
        if (!$record) {
            return response()->json([
                'status'  => 0,
                'message' => 'تعذر الحصول على البيانات'
            ]);
        }

        $record->delete();
        return response()->json([
                'status'  => 1,
                'message' => 'تم الحذف بنجاح',
                'id'      => $id
            ]);  -*/
    }

}
