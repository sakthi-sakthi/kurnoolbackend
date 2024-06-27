<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  {{-- <link rel="icon" sizes="48x48" href="{{App\Models\File::find(App\Models\Option::where('key','=','favicon')->first()->value)->getMedia()->first()->getUrl('thumb')}}" type="image/x-icon" /> --}}
  <link rel="icon" href="{{asset('admin')}}/img/Kurnoollogo.png" type="image/x-icon" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Welcome To The Diocese  Of Kurnool | {{ __('main.Login') }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="{{asset('admin')}}/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="{{asset('admin')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="{{asset('admin')}}/dist/css/adminlte.min.css">
  <style>
    @import url("https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700");
    .wrapper {
    width: 420px;
    /* background: transparent; */
    border:2px solid rgba(255, 255, 255, .2);
    backdrop-filter:blur(20px);
    box-shadow: 0 0 10px rgba(0 , 0 , 0 , .2);
    color: #fff;
    border-radius: 10px;
    padding: 30px 40px;

}
body {
  font-family: "Poppins", sans-serif !important;
  margin: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  background: #f5f5f5;
  color: #333;
}

/* .body{
  background:url(https://www.freecodecamp.org/news/content/images/size/w2000/2022/09/jonatan-pie-3l3RwQdHRHg-unsplash.jpg);
  background-size: cover;
} */
  </style>
</head>
<body class="hold-transition login-page body" 
style="background-color: #001c38;"
 >
<div class="register-logo">
  <img src="{{asset('admin')}}/img/kurnoollogo.png" alt="UAC-logo" style="width: 30%;" class="mb-3">
   <br>
    <center><h1 style="color: #f19f14; font-weight: 700;"><b>WELCOME TO THE DIOCESE  <br> OF KURNOOL</b>
    </h1></center>
</div>
<div class="login-box">
    
  <div class="card" >
    <div class="card-body login-card-body wrapper">
      <p class="login-box-msg" style="color: rgb(17 38 134); font-weight:600">{{ __('main.Sign in to start your session') }}</p>
        @if ($errors->any()) <div class="alert alert-danger">{{$errors->first()}}</div> @endif
      <form action="{{route('login.check')}}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="{{ __('main.E-mail') }}" name="email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="{{ __('main.Password') }}" name="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember" style="color: rgb(17 38 134)">
                {{ __('main.Remember me') }}
              </label>
            </div>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">{{ __('main.Sign in') }}</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="{{asset('admin')}}/plugins/jquery/jquery.min.js"></script>
<script src="{{asset('admin')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('admin')}}/dist/js/adminlte.min.js"></script>

</body>
</html>
