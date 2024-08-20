<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @section('page_title')
        Clients
    @endsection

    @section('content')

        <section class="content">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">كل العملاء</h3>

                </div>
                <div class="box-body">
                    <div class="box-header">
                        {{ html()->form('GET')->open() }}

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    {{ html()->text('keyword')
                                        ->class('form-control')
                                        ->placeholder('بحث بالاسم ورقم الهاتف والايميل')
                                        ->value(request('keyword'))
                                    }}
                                </div>
                            </div>
                            @inject('bloodType','App\Models\BloodType')
                            <div class="col-sm-3">
                                {{ html()->select('blood_type_id', $bloodType->pluck('name', 'id')->toArray())
                                     ->class('form-control')
                                     ->placeholder('بحث بفصيلة الدم')
                                     ->value(request('blood_type_id'))
                                 }}
                            </div>
                            <div class="col-sm-3"></div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">بحث</button>
                                </div>
                            </div>
                        </div>
                        {{  html()->form()->close()  }}
                    </div>
                    @include('flash::message')
                    @if(count($records))
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead style="background-color: #3C8DBC; color:#ffffff;">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">الإسم</th>
                                    <th class="text-center">الإيميل</th>
                                    <th class="text-center">تاريخ الميلاد</th>
                                    <th class="text-center">الهاتف</th>
                                    <th class="text-center">فصيلة الدم</th>
                                    <th class="text-center">اخر تاريخ تبرع بالدم</th>
                                    <th class="text-center">المدينة</th>
                                    <th class="text-center">تفعيل / الغاء التفعيل</th>
                                    <th class="text-center">حذف</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($records as $record)
                                    <tr id="removable{{$record->id}}">
                                        <td class="text-center">{{$loop->iteration}}</td>
                                        <td class="text-center">{{$record->name}}</td>
                                        <td class="text-center">{{$record->email}}</td>
                                        <td class="text-center">{{$record->birth_date}}</td>
                                        <td class="text-center">{{$record->phone}}</td>
                                        <td class="text-center">{{optional($record->bloodType)->name}}</td>
                                        <td class="text-center">{{$record->last_donation}}</td>
                                        <td class="text-center">{{optional($record->city)->name}}</td>

                                        <td class="text-center">
                                            @if($record->is_active)
                                                <a href="{{url(route('clients.toggle-activation',$record->id))}}"
                                                   class="btn btn-danger btn-xs">إلغاء
                                                    التفعيل</a>
                                            @else
                                                <a href="{{url(route('clients.toggle-activation',$record->id))}}"
                                                   class="btn btn-success btn-xs">تفعيل</a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{ html()->form('delete', route('clients.destroy', $record->id))->open() }}
                                            <button type="submit" class="btn btn-danger btn-xs" >
                                                <i class="fa fa-trash"></i></button>
                                            {{  html()->form()->close() }}

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center"> لا يوجد عملاء !!</p>
                    @endif
                </div>

            </div>


        </section>
    @endsection
</x-app-layout>
