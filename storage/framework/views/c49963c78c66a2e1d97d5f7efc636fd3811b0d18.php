<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>HRM Admin | Log in</title>
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
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo e(asset('template/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="bottom-login">
  <div id="page-login" class="w-full justify-center items-center flex h-screen bg-img" style="background-image: url(<?php echo e(asset('template/images/vuexy-login-bg.jpg')); ?>);background-position: 50%;background-repeat: no-repeat;background-size: cover;">
    <div class="content-login">
     <div class="row no-margin flex justify-center items-center">
      <div class="logo-login col-md-6 col-sm-12 no-padding  text-center">
        <img src="<?php echo e(asset('template/images/AdminLTELogo.png')); ?>" alt="">
      </div>
      <div class="cont-login col-md-6 col-sm-12 no-padding items-center flex">
        <form action="<?php echo e(route('login')); ?>" method="post" class="w-full">
          <?php echo csrf_field(); ?>
          <div class="box-body">
            <h2 class="text-center">LOGIN</h2>
            
            <p class="text-center">Welcome back, please login to your account.</p>
            <h6 style="font-size: .9rem">Email</h6>
            <div class="input-group mb-2">
              <span class="input-group-prepend"><i class="fa fa-envelope input-group-text"></i></span>
              <input type="text" class="form-control" placeholder="username" name="username">
            </div>
            <h6 style="font-size: .9rem">Password</h6>
            <div class="input-group">
              <span class="input-group-prepend"><i class="fa fa-key input-group-text" style="font-weight: 600"></i></span>
              <input type="password" class="form-control" placeholder="Password" name="password">
            </div>
            <div class="form-group clearfix">
              <?php $__errorArgs = ['fail'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <span class="invalid-feedback text-red" role="alert">
                      <strong><?php echo e($message); ?></strong>
                  </span>
              <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group clearfix" style="font-size: .9rem">
              <div class="row ">
                <div class="col-sm-6">
                  <div class="checkbox">
                    <label for="" style="font-weight:400">
                      <input type="checkbox" name="remember"> Remember Me
                    </label>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="text-right checkbox">
                    <a href="">Forgot Password?</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group clearfix">
              <div class="row ">
                <div class="col-xs-6 ">
                    <button type="submit" class="btn btn-primary btn-info ">Login</button>
                </div>
              </div>
            </div>
            <?php echo e($errors); ?>


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
<?php /**PATH E:\DEV\Employees management\HR manager\resources\views/auth/login.blade.php ENDPATH**/ ?>