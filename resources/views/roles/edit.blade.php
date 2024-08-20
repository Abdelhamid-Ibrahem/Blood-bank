@extends('layouts.app')
@section('page_title')
    تعديل صلاحية
@endsection

@section('content')

    <section class="content">

        <div class="box">

            <div class="box-body">
                {{ Html()->form('PUT', route('roles.update',$role->id))->attribute('enctype', 'multipart/form-data','files=>true')->open() }}
        {{--       {{ html()->form('put', action([App\Http\Controllers\RolesController::class, 'update']))->open() }}     --}}
                @include('flash::message')
                @include('partials.validation_errors')
                @include('roles.form' , [ 'role' => $role ])
                {{  html()->form()->close()  }}

            </div>

        </div>


    </section>
@endsection
