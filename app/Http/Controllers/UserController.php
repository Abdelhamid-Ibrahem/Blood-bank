<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function changePassword()
    {

        return view('users.reset-password');
    }

    public function changePasswordSave(Request $request)
    {
        $rules = [
            'old-password' => 'required',
            'password' => 'required|confirmed',
        ];
        $messages = [
            'old-password.required' => 'كلمة السر الحالية مطلوبة',
            'password.required' => 'كلمة السر مطلوبة',
        ];
        $request->validate($rules,$messages);

        $user = Auth::user();

        if (Hash::check($request->input('old-password'), $user->password)) {
            // The passwords match...
            $user->password = bcrypt($request->input('password'));
            $user->save();
            flash()->success('تم تحديث كلمة المرور');
            return view('users.reset-password');
        }else{
            flash()->error('كلمة المرور غير صحيحة');
            return view('users.reset-password');
        }

    }

    public function index()
    {
      //  Gate::Authorize('users.view');

        $users = User::paginate(20);

        return view('users.index',compact('users'));
    }

    public function create(User $model)
    {
      //  Gate::Authorize('users.view');

        return view('users.create',compact('model'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
//
        $request->validate( [
            'name' => 'required',
            'password' => 'required|confirmed',
            'email' => 'email',//required

        ]);
        $request->merge(['password' => bcrypt($request->password)]);
        $user = User::create($request->except('role_user'));
        $user->roles()->attach($request->input('role_user'));

        flash()->success('تم إضافة المستخدم بنجاح');
        return redirect(route('users.index'));
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $model = User::findOrFail($id);
        return view('users.edit',compact('model'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request , $id)
    {
        $request->validate( [
            'name' => 'required',
            'password' => 'confirmed',
            'email' => 'email',//|required|unique:users,email,'.$id

        ]);

        $user = User::findOrFail($id);
        $user->roles()->sync((array) $request->input('role_user'));
        $request->merge(['password' => bcrypt($request->password)]);
        $update = $user->update($request->all());

        flash()->success('تم تعديل بيانات المستخدم بنجاح.');
        return redirect(route('users.index',$id));

    }

    public function destroy($id)
    {
        $record = User::findOrFail($id);

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
        ]);
    }
}
