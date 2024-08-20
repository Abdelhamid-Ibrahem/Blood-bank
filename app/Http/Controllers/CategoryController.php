<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
      /*  if (!Gate::allows('categories.view')) {
            abort(403);
        } */
        $records = Category::paginate(10);
        return view('categories.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return
     */
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
       /* if (!Gate::allows('categories.create')) {
            abort(403);
        } */
        return view('categories.create');
    }


    public function store(Request $request)
    {
       // Gate::Authorize('categories.create');
        $rules = [
            'name' => 'required'
        ];
        $messages = [
            'name.required' => 'Name is required'
        ];
        $this->validate($request,$rules,$messages);
        $record = Category::create($request->all());
        flash()->success('تــم اضــافة القسم بنجــاح');
        return redirect(route('categories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return
     */
    public function show($id)
    {
     //   Gate::Authorize('categories.view');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return
     */
    public function edit($id)
    {
     //   Gate::Authorize('categories.update');

        $model = Category::findOrFail($id);
        return view('categories.edit',compact('model'));
    }


    public function update(Request $request, $id)
    {
       // Gate::Authorize('categories.update');

        $rules = [
                 'name' => 'required'
        ];
        $messages = [
                  'name.required' => 'Name is required'
        ];
        $this->validate($request,$rules,$messages);
        $record = Category::findOrFail($id);
        $record->update($request->all());
        flash()->success('تم التحديث بنجاح');
        return redirect(route('categories.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return
     */
    public function destroy($id)
    {
     //   Gate::Authorize('categories.delete');

        $record = Category::findorfail($id);
        $record->delete();
        flash()->success("Successfully Record Deleted");

        return redirect()->route('categories.index');

    }



}
