<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
  @inject('client','App\Models\Client')
    @inject('DonationRequest','App\Models\DonationRequest')
    @inject('post','App\Models\post')
    @inject('Notification','App\Models\Notification')
    @inject('governorates','App\Models\Governorate')
    @inject('cities','App\Models\City')
    @inject('categories','App\Models\Category')
    @inject('contact','App\Models\Contact')


    @section('page_title')
        Dashboard
    @endsection
    @section('small_title')
        Statistics
    @endsection
    @section('content')
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- Clients -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="fa fa-user"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Clients</span>
                            <span class="info-box-number">{{ $client->count() }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- Donation Requests -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="fa fa-chart-line"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Donation Requests</span>
                            <span class="info-box-number">{{ $DonationRequest->count() }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- Governorates -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fa fa-landmark"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Governorates</span>
                            <span class="info-box-number">{{ $governorates->count() }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- Cities -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="fa fa-city"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Cities</span>
                            <span class="info-box-number">{{ $cities->count() }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- Categories -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-secondary"><i class="fa fa-folder"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Categories</span>
                            <span class="info-box-number">{{ $categories->count() }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- Posts -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger"><i class="fa fa-newspaper"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Posts</span>
                            <span class="info-box-number">{{ $post->count() }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- Contact Us -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-dark"><i class="far fa-envelope"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Contact Us</span>
                            <span class="info-box-number">{{ $contact->count() }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->


            <div class="card-body">
                @if(session('status'))
                    <div class="alert alert-success" role="alert" >
                        {{ session('status') }}
                    </div>
                @endif
            </div>
                @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            <div class="card-footer">

            </div>
            <!-- /.card-footer-->

        <!-- /.card -->

    </section>
    <!-- /.content -->

    @endsection('content')


</x-app-layout>
