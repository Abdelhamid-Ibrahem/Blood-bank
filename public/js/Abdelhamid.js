
$(document).on('click','.destroy',function(){

    var route   = $(this).data('route');
    var token   = $(this).data('token');
    $.confirm({
        icon                : 'glyphicon glyphicon-floppy-remove',
        animation           : 'rotateX',
        closeAnimation      : 'rotateXR',
        title               : 'تأكد عملية الحذف',
        autoClose           : 'cancel|6000',
        text             : 'هل أنت متأكد من الحذف ؟',
        confirmButtonClass  : 'btn-outline',
        cancelButtonClass   : 'btn-outline',
        confirmButton       : 'نعم',
        cancelButton        : 'لا',
        dialogClass			: "modal-danger modal-dialog",
        confirm: function () {
            $.ajax({
                url     : route,
                type    : 'post',
                data    : {_method: 'delete', _token :token},
                dataType:'json',
                success : function(data){
                    if(data.status === 0)
                    {
                        //toastr.error(data.msg)
                        Swal.fire("خطأ!", data.message, "error")
                    }else{
                        $("#removable"+data.id).remove();
                        Swal.fire("أحسنت!", data.message, "success")
                        //toastr.success(data.msg)
                    }
                }
            });
        }
    });
});



$( ".datepicker" ).datepicker({
    format: "mm/dd/yy",
    weekStart: 0,
    calendarWeeks: true,
    autoclose: true,
    todayHighlight: true,
    rtl: true,
    orientation: "auto"
});

$('.select2').select2({
    dir: "rtl"
});



