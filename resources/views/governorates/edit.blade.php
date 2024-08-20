@extends('layouts.app')
    @section('page_title')
        Edit Governorates
    @endsection

    @section('content')
        @push('breadcrumb')
          {{--  @can('governorates.view')  --}}
            <li class="breadcrumb-item"><a href="{{route('governorates.index')}}">Governorates</a></li>
        {{--    @endcan  --}}
        @endpush
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">

                <div class="box-body">
                    @include('flash::message')
                  {{--  @can('governorates.update')  --}}
                    {{ html()->form('PUT', route('governorates.update', $model->id))->open() }}
                    @include('partials.validation_errors')
                    @include('governorates.form', ['model' => $model], ['button_label' => 'تحديث'])
                    {{ html()->form()->close()  }}
                 {{--   @endcan  --}}
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
        <!-- /.content -->

    @endsection


