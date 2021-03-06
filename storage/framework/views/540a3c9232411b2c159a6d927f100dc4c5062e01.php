<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Traphaco</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo e(asset('template/AdminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo e(asset('template/AdminLTE/plugins/fontawesome-free/css/all.min.css')); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(asset('template/AdminLTE/dist/css/adminlte.min.css')); ?>">
  
   <link rel="stylesheet" href="<?php echo e(asset('template/css/admin.css')); ?>">
   <link rel="shortcut icon" href="<?php echo e(asset('images/favicon.ico')); ?>">

  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo e(asset('template/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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
</head>
<body class="bottom-login">
  <div id="page-login" class="w-full justify-center items-center flex h-screen bg-img" style="background-image: url(<?php echo e(asset('images/screen-8.jpg')); ?>);background-position: 50%;background-repeat: no-repeat;background-size: cover;">
    <div class="content-login">
     <div class="row no-margin flex justify-center items-center">
      <div class="logo-login col-md-6 col-sm-12 no-padding  text-center">
        <img src="<?php echo e(asset('template/images/AdminLTELogo.png')); ?>" alt="">
      </div>
      <div class="cont-login col-md-6 col-sm-12 no-padding items-center flex">
        <form action="<?php echo e(route('login')); ?>" method="post" class="w-full">
          <?php echo csrf_field(); ?>
          <div class="box-body">
            <h2 class="text-center"><img src="<?php echo e(asset('images/logo_vi.png')); ?>" alt=""></h2>
            
            <p class="text-center">????ng nh???p v??o h??? th???ng</p>
            <h6 style="font-size: .9rem">T??n ????ng nh???p</h6>
            <div class="input-group">
              <span class="input-group-prepend"><i class="fa fa-envelope input-group-text"></i></span>
              <input type="text" class="form-control" placeholder="username" name="username">
            </div>
            <?php if($errors->has('username')): ?>
              <div class="text-red" style="font-size: .9rem">
                <strong><?php echo e($errors->first('username')); ?></strong>
              </div>                 
            <?php endif; ?>
            <h6 class="mt-2" style="font-size: .9rem">M???t kh???u</h6>
            <div class="input-group">
              <span class="input-group-prepend"><i class="fa fa-key input-group-text" style="font-weight: 600"></i></span>
              <input type="password" class="form-control" placeholder="Password" name="password">
            </div>
            <?php if($errors->has('password')): ?>
                <div class="text-red" style="font-size: .9rem">
                  <strong><?php echo e($errors->first('password')); ?></strong>
                </div>                 
            <?php endif; ?>
            <div class="form-group clearfix" style="font-size: .9rem">
              <div class="row ">
                <div class="col-sm-6">
                  <div class="checkbox">
                    <label for="" style="font-weight:400">
                      <input type="checkbox" name="remember"> Nh??? m???t kh???u
                    </label>
                  </div>
                  <?php if($errors->has('fail')): ?>
                    <div class="text-red" style="font-size: .9rem">
                      <strong><?php echo e($errors->first('fail')); ?></strong>
                    </div>                 
                  <?php endif; ?>
                </div>
              </div>
            </div>
            
            <div class="form-group clearfix">
              <div class="row ">
                <div class="col-xs-6 ">
                    <button type="submit" class="btn btn-traphaco btn-info ">????NG NH???P</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo e(asset('template/AdminLTE/plugins/jquery/jquery.min.js')); ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo e(asset('template/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>

</body>
</html>
<?php /**PATH /home/admin/web/dg.traphaco.vn/public_html/resources/views/auth/login.blade.php ENDPATH**/ ?>