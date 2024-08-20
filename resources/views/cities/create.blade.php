@extends('layouts.app')
@inject('model','App\Models\Governorate')
@section('page_title')
    Create Cities
@endsection

@section('content')
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
            </div>
            <div class="box-body">
                {{ html()->form('POST', action([App\Http\Controllers\CityController::class, 'store']))->open() }}
                @include('cities.form', ['model' => $model])
                @include('partials.validation_errors')

                <div class="form-group">
                    {{ html()->select('governorate_id', $governorates, null)
                     ->placeholder('اختر المحافظة')
                     ->class('form-control')
                         }}
                </div>
                {{  html()->form()->close()  }}
            </div>
        </div>
    </section>
@endsection
