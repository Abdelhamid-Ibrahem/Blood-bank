<div class="form-group">
    <label for="name">الإسم</label>
    {{ html()->text('name', old('name', $model->name))->class( 'form-control') ->id('name') }}

</div>
<div class="form-group">
    <button class="btn btn-primary" type="submit"> {{ $button_label ?? 'حفظ' }}</button>
</div>
