<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


@section('page_title')
       Cities
@endsection
@inject('governorate','App\Models\Governorate')
@php
    $governorates = $governorate->pluck('name','id')->toArray();
@endphp
@section('content')


    <section
        class="content">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">كل المدن</h3>
                <div class="box-header">
                    {{ html()->form('GET', url()->current())->open() }}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ html()->text('name', request()->input('name')) ->placeholder( 'اسم المدينة')->class( 'form-control') }}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {{ html()->select('governorate_id',$governorates,request()->input('governorate_id'))
                                ->class('select form-control')
                                ->placeholder(  'اختر المحافظة')
                                 }}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    {{  html()->form()->close()  }}
                </div>

            </div>
            <div class="box-body">
                <div class="box-header">
                    <a href="{{url(route('cities.create'))}}" class="btn btn-primary"><i class="fa fa-plus"> </i>أضف
                        مدينة</a>
                </div>
                @include('flash::message')
                @if(count($records))
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead style="background-color: #3C8DBC; color:#ffffff;">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">المدينة</th>
                                <th class="text-center">المحافظة</th>
                                <th class="text-center">تعديل</th>
                                <th class="text-center">حذف</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($records as $record)
                                <tr id="removable{{$record->id}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="text-center">{{$record->name}}</td>
                                    <td class="text-center">{{$record->governorate->name}}</td>
                                    <td class="text-center">
                                        <a href="{{url(route('cities.edit',$record->id))}}"
                                           class="btn btn-success btn-xs">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        {{ html()->form('delete', route('cities.destroy', $record->id))->open() }}
                                        <button type="submit" class="btn btn-danger btn-xs" >
                                            <i class="fa fa-trash"></i></button>
                                        {{  html()->form()->close()  }}

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-center">
                            {!! $records->links() !!}
                        </div>
                    </div>
                @else
                    <div class="alert alert-danger" role="alert">
                        لا توجد بيانات
                    </div>
                @endif
            </div>

        </div>


    </section>
@endsection
</x-app-layout>
