@extends('layouts.app')
@section('page_title')
    تعديل مقال
@endsection
@inject('categories','App\Models\Category')
@section('content')


    <section class="content">

        <div class="box">

            <div class="box-body">
                {{ Html()->form('PUT', route('posts.update',$model->id))->attribute('enctype', 'multipart/form-data','files=>true')->open() }}

                @include('partials.validation_errors')
                <div class="form-group">
                    <label for="name">العنوان</label>
                    {{ html()->text('title',old('title',$model->title))
                    ->class ('form-control')
                     }}
                    <label for="name">المحتوى</label>
                    {{ Html()->text('content',old('content',$model->content))
                    ->class ('form-control')
                            }}
                    <label class="form-control" for="image">اختر صورة : </label>
                    <img src="<?php echo asset("uploads/$model->image")?>" alt="Current Image path" style="width:90px; height:60px"/>
                    {{ html()->file('image')
                          ->class('form-control file_upload_preview')
                          ->accept('image/*')
                          }}
                      <label class="form-control" for="select">القسم :</label>
                      {{ html()->select('category_id',$categories->pluck('name','id')->toArray())
                          ->class ('form-control')
                         }}
                      <label class="form-control" for="publish_date">تاريخ النشر :  </label>
                      {{ html()->date('publish_date', old('publish_date',$model->publish_date)) ->class ('form-control') }}
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit"> تحديث </button>
                </div>
                {{  html()->form()->close()  }}
            </div>

        </div>
    </section>
@endsection
