@extends('layouts.app')
@section('page_title')
    إضافة مقال
@endsection

@section('content')

    <section class="content">

        <div class="box">

            <div class="box-body">
                {{ html()->form('POST', route('posts.store'))->attribute('enctype','multipart/form-data')->open() }}
                @include('partials.validation_errors')
                <div class="form-group">
                    <label for="title">العنوان</label>
                    {{ html()->text('title')
                        ->class(['form-control', 'is-invalid' => $errors->has('title')])
                        ->id('title')
                        ->value(old('title', $model->title ?? ''))
                         }}
                    @if($errors->has('title'))
                        <div class="text-danger">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                    <label for="content">المحتوى</label>
                    {{ html()->text('content')
                        ->class(['form-control', 'is-invalid' => $errors->has('content')])
                          }}
                    @error('content')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                    <label class="form-control" for="image">اختر صورة : </label>
                    {{ html()->file('image')
                        ->class(['form-control', $errors->has('content') ? 'is-invalid' : ''])
                    }}
                    @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    <label class="form-control" for="select">القسم :</label>
                    {{ html()->select('category_id',$categories,null)
                        ->class( 'form-control')
                     }}
                    <label @class(['form-control']) for="publish_date">تاريخ النشر : </label>
                    {{ html()->date('publish_date', \Carbon\Carbon::now())-> class('form-control') }}
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit"> حفظ</button>
                </div>
                {{ html()->form()->close()  }}
            </div>

        </div>
    </section>
@endsection
