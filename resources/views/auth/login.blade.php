@extends('layouts.app')

@section('head')
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  
  <script>
    window.Laravel =  <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
  </script>
@endsection

@section('content')
  <div class="" style="background: url({{asset('/images/bg-login.png')}});background-size: cover; background-position: center; background-repeat: no-repeat; position: relative; width: 100%; padding-top: 70px; padding-bottom: 70px;">
    <div class="container">
    <div class="row">

    <div class="col-lg-7 col-md-7 col-sm-7">
    <div class="welcome-font">
			<h1>Welcome Back!</h1>
      <p>Sign in to your account using the form on the right side. Please feel free to reach us anytime if you have any issues signing into your account.</p>
    </div>

    </div>
    <div class="col-lg-5 col-md-5 col-sm-5">

      @if (Session::has('error'))
        <div class="alert alert-danger sessionmodal">
          {{session('error')}}
        </div>
      @endif

      <div class="login-page">
        <!-- <div class="logo">
          @if ($setting)
            <a href="{{url('/')}}" title="{{$setting->welcome_txt}}">
              <img src="{{asset('/images/logo/'.$setting->logo)}}" class="login-logo img-responsive" alt="{{$setting->welcome_txt}}">
            </a>
          @endif
        </div> -->

        <h4 class="user-register-heading text-center">Login</h4>

        <br>

        // <form class="form login-form" method="POST" action="{{ route('login') }}">
        //   {{ csrf_field() }}
        //   <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        //     <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter Your Email" required>
        //     @if ($errors->has('email'))
        //       <span class="help-block">
        //         <strong>{{ $errors->first('email') }}</strong>
        //       </span>
        //     @endif
        //   </div>

        //   <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        //     <input id="password" type="password" class="form-control" name="password" placeholder="Enter Password" required>
        //     @if ($errors->has('password'))
        //       <span class="help-block">
        //         <strong>{{ $errors->first('password') }}</strong>
        //       </span>
        //     @endif
        //   </div>
          
          
        //   <div class="form-group">
        //     <div class="checkbox remember-me">
        //       <label>
        //         <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
        //       </label>
        //       Keep me signed in
        //     </div>
        //   </div>

        //   <div class="text-center">
        //     <button type="submit" class="btn btn-wave"> Login </button>
        //     <br>
        //     <a href="{{url('/password/reset')}}" title="Forgot Password" style="color:#888 !important;" >Forgot your Password?</a>
           
        //   </div>
       
        
        // </form>

                        
        <form class="form login-form" method="POST" action="{{ route('login') }}">
          {{ csrf_field() }}
          <div class="form-group">
            <input id="number" type="number" class="form-control" name="mobb"  placeholder="Enter Phone Number" required>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-wave"> Get OTP </button>
          </div>
        </form>





      </div>
      <div class="msg text-center">
          <span >Want to create a new account? </span>
              <a href="{{url('/register')}}" title="Create An Account" style="color:yellow !important;"> Signup Here </a>
      </div>

    </div>
    
    </div>
  </div>    
  </div>    
@endsection

@section('scripts')
  <script>
    $(function () {
      $( document ).ready(function() {
         $('.sessionmodal').addClass("active");
         setTimeout(function() {
             $('.sessionmodal').removeClass("active");
        }, 4500);
      });
    });
  </script>
@endsection
