@extends('front.master')

@section('content')
    <!-- Header-->
    <header id="header">
        <div class="container-fluid">
            <div class="header-text">
                <h1 class="head-text">بنك الدم نمضى قدماً لصحة افضل</h1>
                <p class="follow-text">هذا النص هو مثال لنص يمكن أن يستبدل
                    في نفس المساحة،<br> لقد تم توليد هذا النص
                    من مولد النص العرب</p>
                <a href="{{  url('/about') }}">
                    <button class="btn login-btn">المزيد</button>
                </a>
            </div>
        </div>
    </header>
    <section id="about">
        <div class="container-fluid">
            <p class="about-text">بنك الدم هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من
                مولد
                النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى
                يولدها التطبيق.
                يطلع على صورة حقيقية لتصميم الموقع
            </p>
        </div>
    </section>

    <!-- articles -->
    <section id="articles">
        <h2 class="articles-head">المقالات </h2>
        <div class="container custom" style="direction: ltr">
            <div class="owl-carousel owl-theme" id="owl-articles">
               @foreach($posts as $post)
                    <div class="item">
                        <div class="card" style="width: 22rem;">
                            <i id="{{$post->id}}" onclick="toggleFavourite(this)" class="fab fa-gratipay
                                    {{$post->is_favourite ? 'second-heart' : 'first-heart'}}
                                                                                            "></i>
                            <!---<i  class="fab fa-gratipay second-heart"></i>-->

                            <img class="card-img-top" src="{{asset('uploads/'.$post->image)}}" alt="Card image cap" width="100px" height="100px">
                            <div class="card-body">
                                <h5 class="card-title">{{$post->title}}</h5>
                                <p class="card-text">{{$post->content}}</p>
                                <a href="{{url('post/'.$post->id)}}">
                                    <button class="btn details-btn">التفاصيل</button>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>


    <!-- Donations offers  -->
    <section id="donations">
        <div class="requests">
            <div class="head-text" style="text-align: center">
                <h2>طلبات التبرع</h2>
            </div>

            <div class="content">
                <form class=" row filter " style="text-align: center">
                    <div class="col-md-5 blood">
                        <div class="form-group row">
                            <div class="inside-select">
                                <label for="blood_type">فصيلة الدم</label>
                                {{ html()->select('blood_type_id',$bloodtypes,[])
                                            ->class('custom-select custom-select-lg mb-3 mt-3 custom-width')
                                            ->id ('exampleFormControlSelect1')
                                            ->placeholder('اختر فصيلة الدم')
                                                        }}

                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 city">
                        <div class="form-group row">
                            <div class="inside-select">
                                <label for="city" class=" col-form-label">المدينة</label>
                                {{ html()->select('city_id',$cities,[])
                                       ->class('custom-select custom-select-lg mb-3 mt-3 custom-width')
                                       ->id('exampleFormControlSelect1')
                                       ->placeholder('اختر المدينة')
                                       }}
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1 search">
                        <button type="submit" class="search-btn">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>

                </form>


                @foreach($donations as $donation)
                    <div class="row background-div">
                        <div class="col-lg-2">
                            <div class="blood-type border-circle">
                                <div class="blood-txt">
                                    {{ optional($donation->bloodType)->name }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 ">
                            <ul class="order-details">
                                <li class="cutom-display "> اسم الحالة:</li>
                                <span class="cutom-display ">{{ $donation->patient_name }}</span>
                                <div>
                                    <li class="cutom-display custom-padding "> مستشفي:</li>
                                    <span
                                        class="cutom-display custom-padding ">{{ $donation->hospital_name }}</span>
                                </div>
                                <div class="adjust-position">
                                    <li class="cutom-display "> المدينة:</li>
                                    <span class="cutom-display  ">{{ optional($donation->city)->name }}</span>
                                </div>
                            </ul>

                        </div>
                        <div class="col-lg-3 ">
                            <a href="{{ url(route('request.edit',$donation->id)) }}">
                                <button class="btn more2-btn ">التفاصيل</button>
                            </a>
                        </div>
                    </div>

                @endforeach
                <div class="text-center mt-4 ">
                    <a href="{{ url('donations') }}">
                        <button class="btn more3-btn ">المزيد</button>
                    </a>
                </div>
                <div class="spacer" style="height: 40px;"></div>
            </div>
        </div>
    </section>

    <!-- call us section  -->
    <section id="call-us">
        <h3 class="call-us-head">اتـــصل بنا</h3>
        <P class="call-us-follow-text">يمكنكم الاتصال بنا للاستفسار عن المعلومات وسيتم التواصل معكم فوراً </P>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="whatsup" >
                        <a href="{{ $settings->whatup_link }}" target="_blank">201022084035<i class="whatsu"></i>
                        <img  class="whats-logo" src="{{asset('front/imgs/whats.png')}}">
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- mobile app   -->
    <section id="mobile-app">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <P class="app-head">تطبيق بنك الدم</P>
                    <P class="app-text">هذا النص هو مثال لنص يمكن ان يستبدل فى نفس المساحه, لقد تم توليد هذا النص من
                        مولد
                        النص العربى</P>
                    <p class="availbale">متـــوفر علي </p>
                    <div class="stores">
                        <img src="{{asset('front/imgs/google.png')}}">
                        <img src="{{asset('front/imgs/ios.png')}}">


                    </div>
                </div>
                <div class="col-md-6">
                    <img class="app image-responsive" src="{{asset('front/imgs/App.png')}}">
                </div>

            </div>

        </div>
    </section>
    @push('scripts')
         <script>
               function toggleFavourite(heart) {
                   var post_id = heart.id;
                   $.ajax({
                    url : '{{url(route('toggle-favourite'))}}',
                       type: 'post',
                       data: {_token:"{{csrf_token()}}",post_id:post_id},
                       success: function (data) {
                           if (data.status === 1)
                           {
                               console.log(data);
                               var currentClass = $(heart).attr('class');
                               if (currentClass.includes('first')) {
                                   $(heart).removeClass('first-heart').addClass('second-heart');
                               } else {
                                   $(heart).removeClass('second-heart').addClass('first-heart');
                               }
                           }
                       },
                       error: function (jqXhr, textStatus, errorMessage) { // error callback
                           alert(errorMessage);
                       }
                   });
               }
           </script>
    @endpush
@stop
