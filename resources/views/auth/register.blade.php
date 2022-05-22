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
  <div class="container"  style="background: url({{asset('/images/bg-login.png')}});background-size: cover; background-position: center; background-repeat: no-repeat; position: relative; width: 100%; padding-top: 10px; padding-bottom: 30px;">
    <div class="login-page">
      
      <!-- <div class="logo">
        @if ($setting)
          <a href="{{url('/')}}" title="{{$setting->welcome_txt}}">
            <img src="{{asset('/images/logo/'.$setting->logo)}}" class="img-responsive login-logo" alt="{{$setting->welcome_txt}}">
          </a>
        @endif
      </div> -->

      <h3 class="user-register-heading text-center">Register</h3>
      <form class="form login-form" method="POST" action="{{ route('site.signup') }}">
        {{ csrf_field() }}
    
        <div class="form-group">
          <label for="name">Mobile Number</label> 
          <input id="number" type="number" class="form-control" name="mobile"  placeholder="Enter Phone Number" required>
        </div> 
      
        <div class="mr-t-20">
          <button type="submit" class="btn btn-wave">Send Otp</button>       
        </div>
      </form>

   
    </div>
  </div>
@endsection
