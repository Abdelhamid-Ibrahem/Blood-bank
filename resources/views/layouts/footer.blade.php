<footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
        تصميم وبرمجة شركة ابداع تك
    </div>
    <!-- Default to the left -->
    <strong>&copy; {{date('Y')}} <a href="{{url('admin/home')}}">{{config('app.name')}}</a>.</strong> جميع الحقوق محفوظة

<!-- jQuery -->
<script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('adminlte/js/demo.js')}}"></script>

<script src="{{asset('js/Abdelhamid.js')}}"></script>

<!-- FastClick -->
<script src="{{asset('adminlte/plugins/fastclick/fastclick.js')}}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<script src="{{asset('adminlte/plugins/jquery/jquery.slim.js')}}"></script>
<script src="{{asset('adminlte/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/sweetalert2/sweetalert2.all.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>
    $(document).ready(function () {
        $('.sidebar-menu').tree()
    })
</script>

<script>
    $.ready(function () {
        $('#select2').select2();
    });
</script>
<style>
    .swal2-popup{
        font-size: 1.5rem !important;
    }
</style>

<script>
    @if (session()->has('flash_notification.message'))
    @if(session()->get('flash_notification.level') == "success")
    Swal.fire({
        title: "نجحت العملية!",
        text: "{!! session('flash_notification.message') !!}",
        type: "success",
        confirmButtonText: "حسناً"
    });
    @else
    Swal.fire({
        title: "فشلت العملية!",
        text: "{!! session('flash_notification.message') !!}",
        type: "error",
        confirmButtonText: "حسناً"
    });
    @endif
    @endif
</script>
@stack('scripts')
</footer>
</body>
</html>

