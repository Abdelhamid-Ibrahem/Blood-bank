<div class="box-body">
<div class="form-group">
    <label for="patient_name"class=" col-form-label" >اسم المريض</label>

    {{  html()->text('patient_name',old('patient_name',$model->patient_name)) ->class('form-control') }}

    <label for="patient_age" class=" col-form-label" >العمر</label>

    {{ html()->text('patient_age',old('patient_age',$model->patient_age))  ->class( 'form-control') }}

    <label for="patient_phone" class=" col-form-label">الهاتف</label>

    {{ html()->text('patient_phone',old('patient_phone',$model->patient_phone))  ->class( 'form-control') }}

    <label for="hospital_name"class=" col-form-label" >اسم المستشفى</label>

    {{ html()->text('hospital_name',old('hospital_name',$model->hospital_name))  ->class( 'form-control') }}

    <label for="hospital_address"class=" col-form-label" >عنوان المستشفى</label>

    {{ html()->text('hospital_address',old('hospital_address',$model->hospital_address)) ->class( 'form-control') }}

    <label for="bags_num" class=" col-form-label">أكياس الدم</label>

    {{ html()->text('bags_num',old('bags_num',$model->bags_num) ) ->class( 'form-control') }}

    <label for="blood_type" >فصيلة الدم</label>
    {{ html()->select('blood_type_id',$bloodtypes,[])
                            ->class('form-control') }}

    <div class="form-group">
    <label for="city" class=" col-form-label">المدينة</label>
    {{ html()->select('city_id',$cities,[])
           ->class('form-control') }}
    </div>

    <label for="details"class=" col-form-label" >ملاحظات</label>

    {{ html()->text('details',old('details',$model->details)) ->class( 'form-control') }}

</div>

<div class="form-group ">
    <button class="btn btn-primary" type="submit"> تحديث</button>
</div>
</div>

