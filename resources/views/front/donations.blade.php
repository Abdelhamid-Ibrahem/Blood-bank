@extends('front.master')
@section('content')
    @include('partials.validation_errors')
    <!--inside-article-->
    <div class="all-requests">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">طلبات التبرع</li>
                    </ol>
                </nav>
            </div>

            <!--requests-->
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
        @push('scripts')
            <script>
                $("#governorates").change(function (e) {
                    e.preventDefault();
                    // get gov
                    // send ajax
                    // append cities
                    var governorate_id = $("#governorates").val();
                    if (governorate_id) {
                        $.ajax({
                            url: '{{url('api/v1/cities?governorate_id=')}}' + governorate_id,
                            type: 'get',
                            success: function (data) {
                                if (data.status == 1) {
                                    $("#cities").empty();
                                    $("#cities").append('<option value="">اختر مدينة</option>');
                                    $.each(data.data, function (index, city) {
                                        $("#cities").append('<option value="' + city.id + '">' + city.name + '</option>');
                                    });
                                }
                            },
                            error: function (jqXhr, textStatus, errorMessage) { // error callback
                                alert(errorMessage);
                            }
                        });
                    } else {
                        $("#cities").empty();
                        $("#cities").append('<option value="">اختر مدينة</option>');
                    }
                });
            </script>
    @endpush
@stop
