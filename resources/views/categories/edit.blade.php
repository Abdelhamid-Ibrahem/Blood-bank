@extends('layouts.app')
@section('page_title')
  Edit Categories
@endsection

@section('content')


    <section class="content">

        <div class="box">


            <div class="box-body">
                @include('flash::message')
                @can('categories.update')
                {{ html()->form('PUT', route('categories.update', $model->id))->open() }}
                @include('partials.validation_errors')
                @include('categories.form', ['model' => $model], ['button_label' => 'تحديث'])
                {{  html()->form()->close()  }}
                @endcan
            </div>

        </div>
    </section>
@endsection
