@extends('layouts.app')
@section('page_title')
    إعدادات الموقع
@endsection

@section('content')

    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <h6 class="box-title">تعديل الإعدادات</h6>
            </div>
            <div class="box-body">
                {{ Html()->form('PUT', route('setting.update', $model->id))->open() }}

                @include('partials.validation_errors')
                @include('flash::message')
                <div class="form-group">
                    <label for="fb_link" class=" col-form-label">رابط فيس بوك</label>
                    {{ Html()->text('fb_link',old('fb_link',$model->fb_link))
                    ->class ('form-control') ->id ('fb_link') }}
                </div>
                <div class="form-group">
                    <label for="tw_link" class=" col-form-label">رابط تويتر</label>
                    {{ Html()->text('tw_link',old('tw_link',$model->tw_link))
                    ->class ('form-control') ->id ('fb_link') }}
                </div>
                <div class="form-group ">
                    <label for="youtube_link" class=" col-form-label">رابط يوتيوب</label>

                    {{ Html()->text('youtube_link',old('youtube_link',$model->youtube_link))
                      ->class ('form-control') ->id ('youtube_link') }}

                </div>
                <div class="form-group ">
                    <label for="insta_link" class=" col-form-row">رابط انستجرام</label>

                    {{ Html()->text('insta_link',old('insta_link',$model->insta_link))
                        ->class ('form-control') ->id ('insta_link') }}

                </div>
                <div class="form-group ">
                    <label for="goplus_link" class="col-form-row ">رابط جوجل بلس</label>

                    {{ Html()->text('goplus_link',old('goplus_link',$model->goplus_link))
                       ->class ('form-control') ->id ('goplus_link') }}

                </div>
                <div class="form-group ">
                    <label for="whatup_link" class=" col-form-label">واتس اب</label>

                    {{ Html()->text('whatup_link',old('whatup_link',$model->whatup_link))
                      ->class ('form-control') ->id ('whatup_link') }}

                </div>
                <hr>
                <div class="form-group">
                    <label for="phone" class=" col-form-label">الهاتف</label>

                    {{ Html()->text('phone',old('phone',$model->phone))
                      ->class ('form-control') ->id ('phone') }}

                </div>
                <div class="form-group ">
                    <label for="name" class=" col-form-label">الإيميل</label>

                    {{ Html()->text('email',old('email',$model->email))
                      ->class ('form-control') ->id ('email') }}

                </div>
                <div class="form-group ">
                    <label for="name" class=" col-form-label">عن التطبيق</label>

                    {{ Html()->textarea('about_app',old('about_app',$model->about_app))
                      ->class ('form-control') ->id ('about_app') }}

                </div>
                <div class="form-group ">
                    <div class="col-sm-10 offset-sm-2">
                        <button class="btn btn-primary" type="submit">تعديل</button>
                    </div>
                </div>
        {{  html()->form()->close()  }}


    </section>
@endsection
