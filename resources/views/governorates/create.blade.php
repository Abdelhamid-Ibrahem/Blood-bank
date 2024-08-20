<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @inject('model','App\Models\Governorate')
    @section('page_title')
        Create Governorates
    @endsection

    @section('content')
        @push('breadcrumb')
            @can('governorates.view')
            <li class="breadcrumb-item"><a href="{{route('governorates.index')}}">Governorates</a></li>
            @endcan
        @endpush
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">

                <div class="box-body">
                    @can('governorates.create')
                    {{ html()->form('POST', action([App\Http\Controllers\GovernorateController::class, 'store']))->open() }}
                    @include('partials.validation_errors')
                    @include('governorates.form', ['model' => $model])
                    {{  html()->form()->close()  }}
                    @endcan
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
        <!-- /.content -->

    @endsection('content')


</x-app-layout>
