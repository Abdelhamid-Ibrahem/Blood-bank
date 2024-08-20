    @extends('layouts.app')
@section('content')
    <div class="box box-danger">
        <div class="box-body">
            <div class="pull-right">
                <a href="{{url('admin/user/create')}}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> مستخدم جديد
                </a>
            </div>
            <div class="clearfix"></div>
            <br>
            @include('flash::message')
            @if(!empty($users))
                <div class="table-responsive">
                    <table class="data-table table table-bordered">
                        <thead>
                        <th>#</th>
                        <th>اسم المستخدم</th>
                        <th>الايميل</th>
                        <th>الرتبة</th>
                        <th class="text-center">تعديل</th>
                        <th class="text-center">حذف</th>
                        </thead>
                        <tbody>
                        <div class="py-12">
                            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                                    @livewire('user-management')
                                </div>
                            </div>
                        </div>

                    </table>
                </div>
                <div class="text-center">
                    {!! $users->render() !!}
                </div>
            @endif
            <div class="clearfix"></div>
        </div>
    </div>
@stop
