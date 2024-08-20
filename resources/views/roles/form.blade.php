
<div class="form-group">
    <label for="name">Role Name</label>
    <input type="text" id="name" name="name" class="form-control" placeholder="Enter role name" value="{{ old('name', $role->name) }}">
</div>

<fieldset>
    <legend style="background-color: #3C8DBC; color:#ffffff;"> {{ __('Abilities') }}</legend>

    @foreach(app('abilities') as $ability_code => $ability_name)
        <div class="row mb-2">
            <div class="col-md-6">
                {{ is_callable($ability_name) ? $ability_name() : $ability_name }}
            </div>
            <div class="col-md-3">
                <label for="abilities_{{ $ability_code }}_allow">Allow</label>
                <input type="radio" name="abilities[{{ $ability_code }}]" id="abilities_{{ $ability_code }}_allow" value="allow" @checked(($role_abilities[$ability_code] ?? '') == 'allow')>
            </div>
            <div class="col-md-3">
                <label for="abilities_{{ $ability_code }}_deny">Deny</label>
                <input type="radio" name="abilities[{{ $ability_code }}]" id="abilities_{{ $ability_code }}_deny" value="deny" @checked(($role_abilities[$ability_code] ?? '') == 'deny')>
            </div>
        </div>
     {{-- <label for="blood_type" >فصيلة الدم</label>
        {{ html()->select('blood_type_id',$bloodtypes,[])
                                ->class('form-control') }}

        <div class="form-group">
            <label for="city" class=" col-form-label">المدينة</label>
            {{ html()->select('city_id',$cities,[])
                   ->class('form-control') }}
        </div> --}}
    @endforeach
    <div class="form-group">
        <button class="btn btn-primary" type="submit"> {{ $button_label ?? 'Save' }}</button>
    </div>
</fieldset>



