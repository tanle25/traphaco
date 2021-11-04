<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Font Awesome -->
<link rel="stylesheet" href="<?php echo e(asset('template/AdminLTE/plugins/fontawesome-free/css/all.min.css')); ?>">
<!-- Ionicons -->

<!-- Tempusdominus Bbootstrap 4 -->
<link rel="stylesheet" href="<?php echo e(asset('template/AdminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')); ?>">
<!-- iCheck -->
<link rel="stylesheet" href="<?php echo e(asset('template/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">
<!-- Select 2 -->
<link rel="stylesheet" href="<?php echo e(asset('template\AdminLTE\plugins\select2\css\select2.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('template\AdminLTE\plugins\select2-bootstrap4-theme\select2-bootstrap4.min.css')); ?>">
<!-- JQVMap -->

<!-- Theme style -->
<link rel="stylesheet" href="<?php echo e(asset('template/AdminLTE/dist/css/adminlte.min.css')); ?>">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="<?php echo e(asset('template/AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')); ?>">
<!-- Daterange picker -->
<link rel="stylesheet" href="<?php echo e(asset('template/AdminLTE/plugins/daterangepicker/daterangepicker.css')); ?>">
<!-- summernote -->

<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<!-- Sweet Alert2 -->
<link rel="stylesheet" href="<?php echo e(asset('template\AdminLTE\plugins\sweetalert2\sweetalert2.min.css')); ?>">

<link rel="stylesheet" href="<?php echo e(asset('template\css\custom_style.css')); ?>">

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



<?php
    $user = Auth::user();
?>
<?php if(!$user->can('sửa khách hàng')): ?>
<style>
    .customer-edit{
        display: none;
    }
</style>
<?php endif; ?>

<?php if(!$user->can('xóa khách hàng')): ?>
<style>
    .customer-delete{
        display: none;
    }
</style>
<?php endif; ?>

<?php if(!$user->can('xóa khách hàng')): ?>
<style>
    .customer-delete{
        display: none;
    }
</style>
<?php endif; ?>

<?php if(!$user->can('xem bài khảo sát khách hàng')): ?>
<style>
    .customer-result{
        display: none;
    }
</style>
<?php endif; ?>

<?php if(!$user->can('thêm bài khảo sát khách hàng')): ?>
<style>
    .customer-survey{
        display: none;
    }
</style>
<?php endif; ?>

<?php if(!$user->can('xóa bài khảo sát khách hàng')): ?>
<style>
    .test-delete{
        display: none;
    }
</style>
<?php endif; ?>

<?php if(!$user->can('xem bài khảo sát khách hàng')): ?>
<style>
    .test-details{
        display: none;
    }
</style>
<?php endif; ?>


<?php if(!$user->can('xuất_excel thống kê khách hàng')): ?>
<style>
    .customer-result-excel{
        display: none;
    }
</style>
<?php endif; ?>

<?php if(!$user->can('xóa bộ đề')): ?>
<style>
    .remove-survey-btn{
        display: none;
    }
</style>
<?php endif; ?>

<?php if(!$user->can('sửa bộ đề')): ?>
<style>
    .edit-survey-btn{
        display: none;
    }
</style>
<?php endif; ?>

<?php if(!$user->can('xem báo cáo đợt đánh giá')): ?>
<style>
    .survey-round-result{
        display: none;
    }
</style>
<?php endif; ?>

<?php if(!$user->can('sửa đợt đánh giá')): ?>
<style>
    .survey-round-edit{
        display: none;
    }
</style>
<?php endif; ?>

<?php if(!$user->can('xóa đợt đánh giá')): ?>
<style>
    .round-survey-delete{
        display: none;
    }
</style>
<?php endif; ?>

<?php if(!$user->can('gửi bài đánh giá')): ?>
<style>
    .send-test-to-user{
        display: none;
    }
</style>
<?php endif; ?>

<?php if(!$user->can('xóa bài đánh giá')): ?>
<style>
    .user-test-delete{
        display: none;
    }
</style>
<?php endif; ?>

<?php if(!$user->can('xem lịch sử thông tin khách hàng')): ?>
<style>
    .customer-history{
        display: none;
    }
</style>
<?php endif; ?>




<?php echo $__env->yieldContent('custom-css'); ?><?php /**PATH /home/admin/web/dg.traphaco.vn/public_html/resources/views/admin/partials/css.blade.php ENDPATH**/ ?>