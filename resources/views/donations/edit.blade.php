@extends('layouts.app')
@section('page_title')
    تعديل التبرع
@endsection

@section('content')

    <section class="content">

        <div class="form-group">

            <div class="box-body">

                {{ html()->form('PUT', route('donations.update', $model->id))->open() }}

               {{-- {!! Html()->Form( 'PUT', route('donations.update'),[$model->id],)->open() !!}  --}}
                @include('flash::message')
                @include('partials.validation_errors')
                @include('donations.form', ['model' => $model])

                {{ html()->form()->close()  }}
            </div>


        </div>
    </section>
@stop
