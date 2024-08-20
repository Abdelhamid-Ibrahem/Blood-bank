@extends('front.master')
@section('content')


<!--inside-article-->
<div class="about-us">
    <div class="container">
        <div class="path">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">الرئيسية</a></li>
                    <li class="breadcrumb-item active" aria-current="page">عن بنك الدم</li>
                </ol>
            </nav>
        </div>
        <div class="details">
            <div class="logo">
                <img src="{{ asset('front/imgs/logo.png')}}">
            </div>
            <div class="text">
                <p>
                   {{ $settings->about_app }}
                </p>
                <p>
                    هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق. العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.
                </p>
                <p>
                    هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق. العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.
                </p>
            </div>
        </div>
    </div>
</div>



@stop
