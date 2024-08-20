@extends('layouts.app')

@section('content')
    <section class="content">
        <div class="box">

            <div class="box-body">

                <!-- form start -->
                {{ Html()->form('PUT', route('users.update',$model->id))->attribute('enctype', 'multipart/form-data','files=>true')->open() }}

                <div class="box-body">
                    @include('users.form',[$model->id])
                </div>

                {{  html()->form()->close()  }}
            </div>
        </div>
    </section>
@stop
