@extends('layouts.app')
@inject('model','App\Models\Category')
@section('page_title')
   Create Categories
@endsection

@section('content')


    <section class="content">

        <div class="box">


            </div>
            <div class="box-body">
                @can('categories.create')
                {{ html()->form('POST', action([App\Http\Controllers\CategoryController::class, 'store']))->open() }}
                @include('partials.validation_errors')
                @include('categories.form', ['model' => $model])
                {{  html()->form()->close()  }}
                @endcan
            </div>


    </section>
@endsection
