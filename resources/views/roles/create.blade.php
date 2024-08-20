@extends('layouts.app')
@section('page_title')
    إضافة صلاحية
@endsection

@section('content')

    <section class="content">
        @push('breadcrumb')
            @can('roles.view')
                <li class="breadcrumb-item"><a href="{{route('roles.index')}}">Governorates</a></li>
            @endcan
        @endpush
        <div class="box">

            <div class="box-body">
                {{ html()->form('POST', action([App\Http\Controllers\RolesController::class, 'store']))->open() }}

                @include('partials.validation_errors')
                @include('roles.form',['button_label' => 'حـــفــظ'])
                {{  html()->form()->close()  }}
            </div>


        </div>
    </section>
@endsection
