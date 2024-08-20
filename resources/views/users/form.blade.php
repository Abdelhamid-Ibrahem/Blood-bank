@include('partials.validation_errors')
@include('flash::message')
@inject('user','App\Models\user')

<div class="box-body">

    <div class="form-group">
        <label for="name" class=" col-form-label">الاسم</label>

        {{ html()->text('name',old('name',$model->name)) ->class( 'form-control') }}

        <label for="email" class=" col-form-label">الايميل</label>
        {{ html()->text('email',old('email',$model->email)) ->class( 'form-control') }}

        <label for="password" class=" col-form-label">كلمة المرور</label>
        {{ html()->password('password',old('password',$model->password)) ->class( 'form-control') }}

        <label for="password_confirmation" class=" col-form-label">تأكيد كلمة المرور</label>
        {{ html()->password('password_confirmation',old('password_confirmation',$model->password_confirmation)) ->class( 'form-control') }}

        <label for="super_admin" class=" col-form-label">صلاحيات المستخدمين</label>
            {{ html()->select('super_admin',old('super_admin',$model->super_admin))
                  ->class('form-control') }}

        <div class="form-group">
            <button class="btn btn-primary" type="submit"> حفظ</button>
        </div>
    </div>
</div>



