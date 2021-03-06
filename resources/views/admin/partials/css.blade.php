<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('template/AdminLTE/plugins/fontawesome-free/css/all.min.css')}}">
<!-- Ionicons -->
{{-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}"> --}}
<!-- Tempusdominus Bbootstrap 4 -->
<link rel="stylesheet" href="{{asset('template/AdminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
<!-- iCheck -->
<link rel="stylesheet" href="{{asset('template/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
<!-- Select 2 -->
<link rel="stylesheet" href="{{asset('template\AdminLTE\plugins\select2\css\select2.min.css')}}">
<link rel="stylesheet" href="{{asset('template\AdminLTE\plugins\select2-bootstrap4-theme\select2-bootstrap4.min.css')}}">
<!-- JQVMap -->
{{-- <link rel="stylesheet" href="{{asset('template/AdminLTE/plugins/jqvmap/jqvmap.min.css')}}"> --}}
<!-- Theme style -->
<link rel="stylesheet" href="{{asset('template/AdminLTE/dist/css/adminlte.min.css')}}">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="{{asset('template/AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
<!-- Daterange picker -->
<link rel="stylesheet" href="{{asset('template/AdminLTE/plugins/daterangepicker/daterangepicker.css')}}">
<!-- summernote -->
{{-- <link rel="stylesheet" href="{{asset('template/AdminLTE/plugins/summernote/summernote-bs4.css')}}"> --}}
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<!-- Sweet Alert2 -->
<link rel="stylesheet" href="{{asset('template\AdminLTE\plugins\sweetalert2\sweetalert2.min.css')}}">

<link rel="stylesheet" href="{{asset('template\css\custom_style.css')}}">

<style>
    .btn-traphaco{
        background-color: #008a43;
        border: #008a43;
        color: white;
    }
    .btn-traphaco:hover{
        background-color: orange;
        color: white !important;
    }
</style>

{{-- Hide all by permission style --}}

@php
    $user = Auth::user();
@endphp
@if (!$user->can('s???a kh??ch h??ng'))
<style>
    .customer-edit{
        display: none;
    }
</style>
@endif

@if (!$user->can('x??a kh??ch h??ng'))
<style>
    .customer-delete{
        display: none;
    }
</style>
@endif

@if (!$user->can('x??a kh??ch h??ng'))
<style>
    .customer-delete{
        display: none;
    }
</style>
@endif

@if (!$user->can('xem b??i kh???o s??t kh??ch h??ng'))
<style>
    .customer-result{
        display: none;
    }
</style>
@endif

@if (!$user->can('th??m b??i kh???o s??t kh??ch h??ng'))
<style>
    .customer-survey{
        display: none;
    }
</style>
@endif

@if (!$user->can('x??a b??i kh???o s??t kh??ch h??ng'))
<style>
    .test-delete{
        display: none;
    }
</style>
@endif

@if (!$user->can('xem b??i kh???o s??t kh??ch h??ng'))
<style>
    .test-details{
        display: none;
    }
</style>
@endif


@if (!$user->can('xu???t_excel th???ng k?? kh??ch h??ng'))
<style>
    .customer-result-excel{
        display: none;
    }
</style>
@endif

@if (!$user->can('x??a b??? ?????'))
<style>
    .remove-survey-btn{
        display: none;
    }
</style>
@endif

@if (!$user->can('s???a b??? ?????'))
<style>
    .edit-survey-btn{
        display: none;
    }
</style>
@endif

@if (!$user->can('xem b??o c??o ?????t ????nh gi??'))
<style>
    .survey-round-result{
        display: none;
    }
</style>
@endif

@if (!$user->can('s???a ?????t ????nh gi??'))
<style>
    .survey-round-edit{
        display: none;
    }
</style>
@endif

@if (!$user->can('x??a ?????t ????nh gi??'))
<style>
    .round-survey-delete{
        display: none;
    }
</style>
@endif

@if (!$user->can('g???i b??i ????nh gi??'))
<style>
    .send-test-to-user{
        display: none;
    }
</style>
@endif

@if (!$user->can('x??a b??i ????nh gi??'))
<style>
    .user-test-delete{
        display: none;
    }
</style>
@endif

@if (!$user->can('xem l???ch s??? th??ng tin kh??ch h??ng'))
<style>
    .customer-history{
        display: none;
    }
</style>
@endif



{{-- Hide all by permission style --}}
@yield('custom-css')