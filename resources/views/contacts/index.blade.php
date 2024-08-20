@extends('layouts.app')
@section('page_title')
    Contact us
@endsection

@section('content')


    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">كل الرسائل</h3>


            </div>
            <div class="box-body">
                @include('flash::message')
                @if(count($records))
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead style="background-color: #3C8DBC; color:#ffffff;">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">العنوان</th>
                                <th class="text-center">الرسالة</th>
                                <th class="text-center">اسم العميل</th>
                                <th class="text-center">حذف</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($records as $record)
                                <tr id="removable{{$record->id}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="text-center">{{$record->subject}}</td>
                                    <td class="text-center">{{$record->message}}</td>
                                    <td class="text-center">{{$record->name}}</td>

                                    <td class="text-center">
                                        @can('contact.delete')
                                            {{ html()->form('delete', route('contact.destroy', $record->id))->open() }}
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
                    <p class='text-center h3'>لا توجد رسائل !!</p>
                @endif
            </div>

        </div>


    </section>
@endsection
