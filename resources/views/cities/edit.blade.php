@extends('layouts.app')
@section('page_title')
    تعديل المدينة
@endsection
@inject('governorates','App\Models\Governorate')
@section('content')


    <section class="content">

        <div class="box">

            <div class="box-body">
                {{ html()->form('PUT', route('cities.update', $model->id))->open() }}

                @include('flash::message')
                @include('partials.validation_errors')
                @include('cities.form', ['model' => $model], ['button_label' => 'تحديث'])

                <div class="form-group">
                    <label for="name">المحافظة</label>
                    {{ html()->select('governorate_id',$governorates->pluck('name','id')->toArray())
                    ->class( 'form-control')
                         }}
                </div>
                {{ html()->form()->close()  }}
            </div>

        </div>
    </section>
@endsection
