@extends('layouts.app')
@inject('donation','App\Models\DonationRequest')
@section('page_title')
    Donations
@endsection

@section('content')


    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">كل التبرعات</h4>
            </div>
            <div class="box-body">

                @include('flash::message')
                @if(count($records))
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead style="background-color: #3C8DBC; color:#ffffff;">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">اسم المريض</th>
                                <th class="text-center">العمر</th>
                                <th class="text-center">عدد أكياس الدم</th>
                                <th class="text-center">اسم المستشفى</th>
                                <th class="text-center">عنوان المستشفى</th>
                                <th class="text-center">الهاتف</th>
                                <th class="text-center">المدينة</th>
                                <th class="text-center">فصيلة الدم</th>
                                <th class="text-center">تعديل</th>
                                <th class="text-center">حذف</th>
                            </tr>
                            </thead>
                            <tbody>
                            @inject('bloodType','App\Models\BloodType')
                            @foreach($records as $record)
                                <tr id="removable{{$record->id}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="text-center">{{$record->patient_name}}</td>
                                    <td class="text-center">{{$record->patient_age}}</td>
                                    <td class="text-center">{{$record->bags_num}}</td>
                                    <td class="text-center">{{$record->hospital_name}}</td>
                                    <td class="text-center">{{$record->hospital_address}}</td>
                                    <td class="text-center">{{$record->patient_phone}}</td>
                                    <td class="text-center">{{optional($record->city)->name}}</td>
                                    <td class="text-center">{{optional($record->bloodType)->name}}</td>
                                    <td class="text-center">
                                        <a href="{{url(route('donations.edit',$record->id))}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                                    </td>
                                    <td class="text-center">
                                        <button id="{{$record->id}}" data-token="{{ csrf_token() }}"
                                                data-route="{{URL::route('donations.destroy',$record->id)}}"
                                                type="button" class="destroy btn btn-danger btn-xs">
                                            <i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-center">لا يوجد تبرعات !!</p>
                @endif
            </div>

        </div>


    </section>
@endsection
