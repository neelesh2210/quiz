@extends('layouts.app')

@section('head')
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  <style>
    #ResendBtn .btn-wave {
    background: #bc080891 !important;
    border-radius: 100px !important;}
    span#counter {
    font-size: 16px;
    color: #bc0808;}

    .otpContainer {
    display: flex;}
    .otp {
    text-align: center;
    border: 1px solid #bc0808 !important;
    margin: 5px!important;
    background-color: white !important;}
    .banner-detail h1 {
    padding-top: 0px;}
  </style>
  
  <script>
    window.Laravel =  <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
  </script>
@endsection
@section('top_bar')
<nav class="navbar navbar-default navbar-static-top">
    <!-- <div class="logo-main-block">
      <div class="container">
        @if ($setting)
          <a href="{{ url('/') }}" title="{{$setting->welcome_txt}}">
            <img src="{{asset('/images/logo/'. $setting->logo)}}" class="img-responsive" alt="{{$setting->welcome_txt}}">
          </a>
        @endif
      </div>
    </div> -->
    <div class="nav-bar">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5">
            <div class="navbar-header">
              <!-- Branding Image -->
              @if($setting)
              <a href="{{ url('/') }}" title="{{$setting->welcome_txt}}">
                <img src="{{asset('/images/logo/logo1.jpg')}}" class="img-responsive w-50" alt="{{$setting->welcome_txt}}">
              </a>
                    <!-- <a class="tt" title="Quick Quiz Home" href="{{url('/')}}"><h4 class="heading">{{$setting->welcome_txt}}</h4></a> -->
              @endif
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-7">
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
              <!-- Right Side Of Navbar -->
              <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                <li><a href="tel:9386806850" title="callus" class="call"><i class="fa fa-phone fa-lg" aria-hidden="true"></i> +91 9386806850</a></li>
                  <!-- <li><a href="{{ route('login') }}" title="Login">Login</a></li>
                  <li><a href="{{ route('site.signup') }}" title="Register">Register</a></li> -->
                @else
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                      {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    
                    <ul class="dropdown-menu" id="dropdown">
                      @if ($auth->role == 'A')
                        <li><a href="{{url('/admin')}}" title="Dashboard">Dashboard</a></li>
                      @elseif ($auth->role == 'S')
                        <li><a href="{{url('/admin/my_reports')}}" title="Dashboard">Dashboard</a></li>
                      @endif
                      <li>
                        <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        Logout
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                      </form>
                      </li>
                    </ul>
                  </li>
                 
                  <li><a href="{{ route('faq.get') }}">FAQ</a></li>
                @endguest
                  @if(!empty($menus))
                    @foreach($menus as $menu)
                      <li><a href="{{ url('pages/'.$menu->slug) }}">{{$menu->name}}</a></li>
                    @endforeach
                  @endif
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
@endsection

@section('content')

      <div class="container-fluid"  style="background: url({{asset('/images/bg-login.png')}});background-size: cover; background-position: center; background-repeat: no-repeat; position: relative; width: 100%; padding-top: 50px; padding-bottom: 40px;">
      <div class="container">
        <div class="row banner">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 banner-detail">
            <h1> BRILLIANT - 30 </h1>
            <h5>पूर्णतः निःशुल्क शिक्षा</h5>
            <h5>NEET /AIIMS Preparation</h5>
            <h6>(Only for Xth BOARD (CBSE/ICSE/Bihar BOARD))</h6>
            <!-- <a href="">पूर्णतः निःशुल्क शिक्षा</a> -->
          </div>

          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="login-page"  style="margin:auto;">
                  @if (Session::has('error'))
                    <div class="alert alert-danger sessionmodal">
                      {{session('error')}}
                    </div>
                  @endif
             <h4 class="user-register-heading text-center">Get Otp</h4>
        
              <form class="form login-form" method="POST" action="{{ route('site.otp.send') }}">
                {{ csrf_field() }}
                <p>Receive OTP verification code on your mobile no.</p>
                <h4 style="color:#BC0808;text-align: center;">{{$user->mobile}}</h4>
                <input name="mobile" type="hidden" class="form-control" value="{{$user->mobile}}" />
                <!-- <div class="form-group">
                  <input id="otp_num" type="number" class="form-control" name="otp"  placeholder="Enter OTP" required>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-wave"> Submit </button>
                </div> -->

                <div class="otpContainer">
                  <input name="otp0" class="otp" type="text" oninput='digitValidate(this)' onkeyup='tabChange(1)' maxlength=1 required >
                  <input name="otp1" class="otp" type="text" oninput='digitValidate(this)' onkeyup='tabChange(2)' maxlength=1 required >
                  <input name="otp2" class="otp" type="text" oninput='digitValidate(this)' onkeyup='tabChange(3)' maxlength=1 required>
                  <input name="otp3" class="otp" type="text" oninput='digitValidate(this)' onkeyup='tabChange(4)' maxlength=1 required>
                </div>
                <div class="form-group text-center" style="margin-top:15px;"> 
                  <span class="timer">
                    <span id="counter"></span>
                  </span>
                </div>
                <div class="text-center" id="verifiBtn">
                  <button type="submit" class="btn btn-wave"> Verify </button>
                </div>

              </form> 

                <div class="text-center err-msg"> Opps!! OTP incorrect.</div>


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

<script type="text/javascript">
        let digitValidate = function(ele){
  console.log(ele.value);
  ele.value = ele.value.replace(/[^0-9]/g,'');
}
let tabChange = function(val){
    let ele = document.querySelectorAll('.otp');
    if(ele[val-1].value != ''){
      ele[val].focus()
    }else if(ele[val-1].value == ''){
      ele[val-2].focus()
    }   
 }
        </script>

  <script>

function countdown() {
        var seconds = 30;
        function tick() {
          var counter = document.getElementById("counter");
          seconds--;
          counter.innerHTML =
            "0:" + (seconds < 10 ? "0" : "") + String(seconds);
          if (seconds > 0) {
            setTimeout(tick, 1000);
          } else {
            document.getElementById("verifiBtn").innerHTML = `
                <div class="Btn" id="ResendBtn">
                    <button type="submit" class="btn-sm btn-wave">Resend</button>
                </div>
            `;
            document.getElementById("counter").innerHTML = "";
          }
        }
        tick();
      }
      countdown();
  </script>
@endsection
