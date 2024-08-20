@extends('layouts.app')
@section('page_title')
    Role Users
@endsection
@section('small_title')

@endsection


@section('content')

    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">كل الصلاحيات</h3>

                @push('breadcrumb')
                        <li class="breadcrumb-item active">Roles</li>
                @endpush
                @include('flash::message')
                <div class="box-body">
                    <a href="{{url(route('roles.create'))}}" class="btn btn-sm btn-outline-primary"><i
                            class="fa fa-plus"></i> أضف صلاحية</a>

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
                                @foreach ($roles as $role)
                                    <tr id="removable{{$role->id}}">
                                        <td class="text-center">{{$loop->iteration}}</td>
                                        <td class="text-center">{{$role->name}}</td>
                                        <td class="text-center">
                                            <a href="{{url(route('roles.edit', $role->id))}}"
                                               class="btn btn-success btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            {{ html()->form('delete', route('roles.destroy', $role->id))->open() }}
                                            <button type="submit" class="btn btn-danger btn-xs" >
                                                <i class="fa fa-trash"></i></button>
                                            {{  html()->form()->close()  }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>

                            {{-- {{ html()->form('edit', route('roles.update'))->open() }}  --}}

                            @include('partials.validation_errors')

                        </div>
                </div>
            </div>
    </section>

@endsection
