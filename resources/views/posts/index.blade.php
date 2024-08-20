@extends('layouts.app')
@section('page_title')
    Articles
@endsection

@section('content')


    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">إضافة مقال</h3>

            </div>
            <div class="box-body">
                <a href="{{url(route('posts.create'))}}" class="btn btn-sm btn-outline-primary"><i class="fas fa-plus"></i> أضف مقال</a>
                @include('flash::message')
                @if(count($records))
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead style="background-color: #3C8DBC; color:#ffffff;">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">العنوان</th>
                                <th class="text-center">القسم</th>
                                <th class="text-center">المحتوى</th>
                                <th class="text-center">الصورة</th>
                                <th class="text-center">تعديل </th>
                                <th class="text-center">حذف</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($records as $record)
                                <tr id="removable{{$record->id}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="text-center">{{$record->title}}</td>
                                    <td class="text-center">{{$record->category->name}}</td>
                                    <td class="text-center">{{$record->content}}</td>
                                    <td>
                                        <img src="{{asset('/uploads/' . $record->image)}}" style="width:90px; height:60px">
                                    </td>

                                    <td class="text-center">
                                        <a href="{{url(route('posts.edit',$record->id))}}" class="btn btn-success btn-xs">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>

                                    <td class="text-center">
                                        {{ html()->form('delete', route('posts.destroy', $record->id))->open() }}
                                        <button type="submit" class="btn btn-danger btn-xs" >
                                            <i class="fa fa-trash"></i></button>
                                        {{  html()->form()->close()  }}

                                        {{-- <button id="{{$record->id}}" data-token="{{ csrf_token() }}"
                                                data-route="{{URL::route('posts.destroy',$record->id)}}"
                                                type="button" class="destroy btn btn-danger btn-xs">
                                            <i class="fa fa-trash"></i></button>  --}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-center"> لا يوجد اى مقالات</p>
                @endif
            </div>
            <div class="text-center "> {{ $records->links() }}</div>
        </div>


    </section>
@endsection
