@extends('front.master')
@section('content')
@include('partials.validation_errors')
    <!--form-->
    <section id="breedcrumb">
        <div class="form">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">تسجيل الدخول</li>
                        </ol>
                    </nav>
                </div>
                <div class="signin-form">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="logo">
                            <img src="{{ asset('front/imgs/logo.png')}}">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                   placeholder="الجوال">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="exampleInputPassword1"
                                   placeholder="كلمة المرور">
                        </div>
                        <div class="row options">
                            <div class="col-md-6 remember">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">تذكرنى</label>
                                </div>
                            </div>
                            <div class="col-md-6 forgot">
                                <img src="{{ asset('front/imgs/complain.png')}}" width="10px" height="10px">
                                <a href="#">هل نسيت كلمة المرور</a>
                            </div>
                        </div>
                        <div class="row buttons">
                            <div class="col-md-6 ">
                                <a href="#">
                                <button class="btn btn-create" type="submit">دخول</button>
                                </a>
                            </div>
                            <div class="col-md-6 left">
                                <a href="">
                                <button class="btn btn-create " type="submit">انشاء حساب جديد</button>
                               </a>
                            </div>
                        </div>
                    </form>
                    <script>
                        // Example starter JavaScript for disabling form submissions if there are invalid fields
                        (function () {
                            'use strict';
                            window.addEventListener('load', function () {
                                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                var forms = document.getElementsByClassName('needs-validation');
                                // Loop over them and prevent submission
                                var validation = Array.prototype.filter.call(forms, function (form) {
                                    form.addEventListener('submit', function (event) {
                                        if (form.checkValidity() === false) {
                                            event.preventDefault();
                                            event.stopPropagation();
                                        }
                                        form.classList.add('was-validated');
                                    }, false);
                                });
                            }, false);
                        })();
                    </script>

                </div>
            </div>
        </div>
    </section>

@stop
