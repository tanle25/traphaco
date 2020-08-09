<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{asset("css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>

<body>
    <div class="login-container">
        <div class="login-head">
            <img src="{{asset('storage/images/website_image/logo2.png')}}" alt="LOGO">
            <span>ADMIN</span>
        </div>
        <div class="login-body">
            <h5 class="login-body-title">Đăng nhập tài khoản admin</h5>
            <div class="login-body-form row">
                <form action="{{route('admin.login.submit')}}" method="post" class="col-lg-6">
                    @csrf
                    <input type="text" name="username" id="" placeholder="Username">
                    @error('username')
                        
                    @enderror

                    <input type="text" name="password" id="" placeholder="Password">

                    <div>
                        <input type="checkbox" name="remember_user" id="remember-checkbox">
                        <label for="remember-checkbox">Nhớ mật khẩu</label>
                        <a href="#" class="forgot-password">Quên mật khẩu</a>
                    </div>
                    <button type="submit" class="btn btn-traphaco">Đăng nhập</button>
                </form>
                <div class="social-login col-lg-6">
                    <button class="social-login-btn btn btn-outline-warning">Google</button>
                    <button class="social-login-btn btn btn-outline-primary">Facebook</button>
                </div>
                {{$errors}}
            </div>
        </div>
    </div>
</body>


<script src="{{asset("js/jquery.min.js")}}"></script>
<script src="{{asset("js/popper.min.js")}}"></script>
<script src="{{asset("js/bootstrap.min.js")}}"></script>

</html>