<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @section('page_title')
        Governorates
    @endsection


    @section('content')
        @push('breadcrumb')
            @can('governorates.view')
            <li class="breadcrumb-item"><a href="{{url(route('governorates.index'))}}">Governorates</a></li>
            @endcan
        @endpush

        <section

            class="content">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">كل المحافظات</h3>
                </div>
                <div class="box-body">
                    <div class="box-header">
                        @can('governorates.view')
                        {{ html()->form('GET', url()->current())->open() }}
                        @endcan
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ html()->text('name', request()->input('name')) ->placeholder( 'اسم المحافظة') ->class('form-control') }}
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        {{  html()->form()->close()  }}
                    </div>
                    <div class="box-header">
                        @can('governorates.view')
                        <a href="{{url(route('governorates.create'))}}" class="btn btn-primary"><i class="fa fa-plus"> </i>
                            إضافة محافظة </a>
                        @endcan
                    </div>
                    @include('flash::message')
                    @if(count($records))
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead style="background-color: #3C8DBC; color:#ffffff;">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">الإسم</th>
                                    <th class="text-center">تعديل</th>
                                    <th class="text-center">حذف</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($records as $record)
                                    <tr id="removable{{$record->id}}">
                                        <td class="text-center">{{$loop->iteration}}</td>
                                        <td class="text-center">{{$record->name}}</td>
                                        <td class="text-center">
                                            @can('governorates.update')
                                            <a href="{{url(route('governorates.edit',$record->id))}}"
                                               class="btn btn-success btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            @endcan
                                        </td>
                                        <td class="text-center">
                                            @can('governorates.delete')
                                            {{ html()->form('delete', route('governorates.destroy', $record->id))->open() }}
                                            <button type="submit" class="btn btn-danger btn-xs" >
                                                <i class="fa fa-trash"></i></button>
                                            {{  html()->form()->close()  }}
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="text-center">
                                {{ $records->links() }}
                            </div>
                        </div>
                    @else
                        <div class="col-md-4 col-md-offset-4 text-center alert alert-info bg-blue">
                            لاتوجد اى بيانات
                        </div>
                    @endif
                </div>

            </div>


        </section>
    @endsection


</x-app-layout>
