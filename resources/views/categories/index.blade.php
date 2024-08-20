@extends('layouts.app')
@section('page_title')
    Categories
@endsection

@section('content')

    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">كل الأقسام</h3>
            </div>
            <div class="box-body">
                @can('categories.create')
                <a href="{{url(route('categories.create'))}}" class="btn btn-outline-primary"><i class="fa fa-plus"></i> أضف قسم</a>
                @endcan
                @include('flash::message')
                @if(count($records))
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead style="background-color: #3C8DBC; color:#ffffff;">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">القسم</th>
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
                                        @can('categories.update')
                                        <a href="{{url(route('categories.edit',$record->id))}}" class="btn btn-success btn-xs">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        @endcan
                                    </td>
                                    <td class="text-center">
                                        @can('categories.delete')
                                        {{ html()->form('delete', route('categories.destroy', $record->id))->open() }}
                                        <button type="submit" class="btn btn-danger btn-xs" >
                                            <i class="fa fa-trash"></i></button>
                                        {{  html()->form()->close()  }}
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-danger" role="alert">
                        {{ $record->link() }}
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
