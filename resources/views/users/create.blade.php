@extends('layouts.app')

@section('content')

<div class="box">
    <!-- form start -->
    <div class="box-body">
        {{ html()->form('POST', action([App\Http\Controllers\UserController::class, 'store']))->open() }}

        @include('partials.validation_errors')
        @include('users.form', ['model' => $model])
        {{  html()->form()->close()  }}
    </div>


</div>
@stop
