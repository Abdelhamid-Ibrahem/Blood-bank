@extends('layouts.app')
@section('page_title')
     Users
@endsection

@section('content')
    <section class="content">
    <div class="box box-danger">
        <div class="box-body">
            <div class="pull-right">
                <a href="{{url(route('users.create'))}}" class="btn btn-outline-primary"><i class="fa fa-plus"></i> مستخدم جديد</a>

            </div>
            <div class="clearfix"></div>
            <br>
            @include('flash::message')
            @if(!empty($users))
                <div class="table-responsive">
                    <table class="data-table table table-bordered">
                        <thead style="background-color: #3C8DBC; color:#ffffff;" >
                        <th class="text-center">#</th>
                        <th class="text-center">اسم المستخدم</th>
                        <th class="text-center">الايميل</th>
                        <th class="text-center">الصلاحية</th>
                        <th class="text-center">تعديل</th>
                        <th class="text-center">حذف</th>
                        </thead>
                        <tbody>
                        @php $count = 1; @endphp
                        @foreach($users as $user)
                            <tr id="removable{{$user->id}}">
                                <td class="text-center">{{$count}}</td>
                                <td class="text-center">{{$user->name}}</td>
                                <td class="text-center">{{$user->email}}</td>
                                <td class="text-center">{{$user->super_admin}}</td>
                                <td class="text-center">
                                    <a href="{{url(route('users.edit', $user->id))}}"
                                       class="btn btn-success btn-xs">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    {{ html()->form('delete', route('users.destroy', $user->id))->open() }}
                                    <button type="submit" class="btn btn-danger btn-xs" >
                                        <i class="fa fa-trash"></i></button>
                                    {{  html()->form()->close()  }}
                            </tr>
                            @php $count ++; @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center">
                    {!! $users->render() !!}
                </div>
            @endif
            <div class="clearfix"></div>
        </div>
    </div>
    </section>
@stop
