@extends('layouts.app')

@section('head')
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
  
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
  @if ($auth)
<div class="container">
    <div class="quiz-main-block">
      <div class="row">
        @if ($topics)
          @foreach ($topics as $topic)
            <div class="col-lg-4 col-md-4 col-sm-6">
              <div class="topic-block">
                <div class="card blue-grey darken-1">
                  <div class="card-content white-text">
                    <center><span class="card-title">{{$topic->title}}</span>
                    <p title="{{$topic->description}}">{{str_limit($topic->description, 120)}}</p></center>
                    <div class="row">
                      <div class="col-xs-6 pad-0">
                        <ul class="topic-detail">
                          <li>Total Number of Questions <i class="fa fa-long-arrow-right"></i></li> 
                          <li>Per Question Mark <i class="fa fa-long-arrow-right"></i></li>
                          <li>Total Marks <i class="fa fa-long-arrow-right"></i></li>
                          <li>Total Time <i class="fa fa-long-arrow-right"></i></li>
                          <li>Quiz Price <i class="fa fa-long-arrow-right"></i></li>
                        </ul>
                      </div>
                      <div class="col-xs-6">
                        <ul class="topic-detail right">
                          <li>
                            15
                          </li><br>
                          <li>{{$topic->per_q_mark}}</li>
                          <li>                            
                            {{$topic->per_q_mark*15}}
                          </li>
                          <li>
                            {{$topic->timer}} minutes
                          </li>

                          <li class="amount">
                            @if(!empty($topic->amount))
                            ₹{{$topic->amount}}</i> 
                             @else
                               Free
                            @endif
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>


               <div class="card-action text-center">
                  
                  @if (Session::has('added'))
                    <div class="alert alert-success sessionmodal">
                      {{session('added')}}
                    </div>
                  @elseif (Session::has('updated'))
                    <div class="alert alert-info sessionmodal">
                      {{session('updated')}}
                    </div>
                  @elseif (Session::has('deleted'))
                    <div class="alert alert-danger sessionmodal">
                      {{session('deleted')}}
                    </div>
                  @endif

                    @if($auth->topic()->where('topic_id', $topic->id)->exists())
                      <a href="{{route('start_quiz', ['id' => $topic->id])}}" class="btn btn-block" title="Start Quiz">Start Quiz </a>
                    @else

                    @php
                      $check_quiz=App\Answer::where('user_id',Auth::user()->id)->where('topic_id',$topic->id)->first();
                    @endphp
                      @if (empty($check_quiz))
                      {!! Form::open(['method' => 'POST', 'action' => 'PaypalController@paypal_post']) !!} 
                        {{ csrf_field() }}
                        <input type="hidden" name="topic_id" value="{{$topic->id}}"/>
                         @if(!empty($topic->amount)) 
                        <button type="submit" class="btn btn-default">Pay  <i class="{{$setting->currency_symbol}}"></i>{{$topic->amount}}</button>
                          @else 
                          <a href="{{route('start.quiz.index', ['id' => $topic->id])}}" class="btn btn-block" title="Start Quiz">Start Quiz  </a>
                        @endif

                      {!! Form::close() !!}   
                      
                      @else
                      <a href="../final_page/{{$topic->id}}" class="btn btn-block" title="Check Result">Check Result</a>
                      @endif
                   
                    @endif
                  </div>


                {{--   <div class="card-action">
                    @php 
                      $a = false;
                      $que_count = $topic->question->count();
                      $ans = $auth->answers;
                      $ans_count = $ans ? $ans->where('topic_id', $topic->id)->count() : null;
                      if($que_count && $ans_count && $que_count == $ans_count){
                        $a = true;
                      }
                    @endphp
                    <a href="{{$a ? url('start_quiz/'.$topic->id.'/finish') : route('start_quiz', ['id' => $topic->id])}}" class="btn btn-block" title="Start Quiz">Start Quiz
                    </a>
                  </div> --}}
                </div>
              </div>
            </div>
          @endforeach
        @endif
      </div>
    </div>
</div>
  @endif
  @if (!$auth)
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
                <h3 class="user-register-heading text-center">Login / Register</h3>
                <form class="form login-form" method="POST" action="{{ route('site.signup') }}">
                  {{ csrf_field() }}
              
                  <div class="form-group">
                    <label for="name">ENTER MOBILE No.</label> 
                    <input id="number" type="text" class="form-control" name="mobile"  maxlength="10" pattern="[0-9]{10}"  placeholder="Enter Your Mobile Number" required>
                    </div>
                
                  <div class="mr-t-20">
                    <button type="submit" class="btn btn-wave">Send Otp</button>       
                  </div>
                </form>
                   <br>
                <!-- <div class="text-center"> <span class="mob"> Already Registered?</span>   <a href="#" title="Login now" class="mob-a" >Login now</a> </div> -->
                
            </div>

          </div>
      </div>
    </div>
    </div>
    <section class="container section2">
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="cntbr">
              <img class="imgbanner" src="https://brilliantpatna.com/wp-content/uploads/2021/03/BRILLIANT-BANNER-300x99.jpg">
              <p>Take the test at a date and time of your choice</p>
              <!-- <p><b>Timings </b>: 9AM to 7PM Daily | <b>Duration</b> : 35 mins</p>
              <p><b>Mode </b>: Online (from home)</p>
              <h5>Free Registration</h5>
               <span> Use Code <b>iACST2223</b> </span>  -->
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="cntbr">
              <img class="imgbanner" src="https://brilliantpatna.com/wp-content/uploads/2021/03/BRILLIANT-BANNER-300x99.jpg">
              <p>Take the test at a date and time of your choice</p>
              <!-- <p><b>Timings </b>: 9AM to 7PM Daily | <b>Duration</b> : 35 mins</p>
              <p><b>Mode </b>: Online (from home)</p>
              <h5>Free Registration</h5>
               <span> Use Code <b>iACST2223</b> </span>  -->
            </div>
        </div>

        
      </div>    
    </section>

    <section class="section3">
      <div class="container">
      <div class="panel-group" id="accordion1">
      <div class="panel panel-default">
        <div class="panel-heading"  data-target="#Exampleone" data-toggle="collapse" data-parent="#accordion1">
          <h4 class="panel-title"  data-target="#Exampleone" data-toggle="collapse" data-parent="#accordion1">
              How to choose the best web development company in Varanasi?
          </h4>
        </div>
        <div class="panel-collapse collapse in" id="Exampleone">
          <div class="panel-body">
            <p>Hiring a web development company can be tricky, especially if you are doing it for the time. There are countless factors you need to check before hiring a company to build your website. Some of these factors are experience, portfolio, industry reputation, communication, and budget.</p>
          </div>
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading" data-target="#Exampletwo" data-toggle="collapse" data-parent="#accordion1">
          <h4 class="panel-title"data-target="#Exampletwo" data-toggle="collapse" data-parent="#accordion1">
              Why is having a mobile-friendly or responsive website so important?
          </h4>
        </div>
        <div class="panel-collapse collapse" id="Exampletwo">
          <div class="panel-body">
            <p>Since the advent of smartphone and smart devices, people like to browse websites on their mobile devices. That means simply having a desktop version of your website will not serve you well. Building a mobile-friendly and responsive website is crucial if you want to attract both mobile and desktop users.</p>
          </div>
        </div>
      </div>
  	 </div>
      </div>
    </section>

    <section class="section4">
      <div class="container">
        <div class="row">
          <h2 class="whatmk">ABOUT BRILLIANT - 30</h2>
          <p class="text-justify">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
        </div>

       
    </div>
    </section>
    <section class="section4">
      <div class="container toppers" style="border-top: 1px dotted #cccccc; margin-top: 30px; padding-top: 20px;">
        <img alt="NEET Topper" class="dis-desk" data-entity-type="file" data-entity-uuid="82397c29-2c86-4f91-a464-74c19e0df9cf" src="https://brilliantpatna.com/wp-content/uploads/2021/03/Neeraj-300x225.jpg">
        <img alt="NEET Topper" class="dis-mob" data-entity-type="file" data-entity-uuid="82397c29-2c86-4f91-a464-74c19e0df9cf" src="https://brilliantpatna.com/wp-content/uploads/2021/03/Neeraj-300x225.jpg">
        <img alt="JEE Topper" class="dis-desk" data-entity-type="file" data-entity-uuid="82397c29-2c86-4f91-a464-74c19e0df9cf" src="https://brilliantpatna.com/wp-content/uploads/2021/03/Neeraj-300x225.jpg">
        <img alt="JEE Topper" class="dis-mob" data-entity-type="file" data-entity-uuid="82397c29-2c86-4f91-a464-74c19e0df9cf" src="https://brilliantpatna.com/wp-content/uploads/2021/03/Neeraj-300x225.jpg">
      </div>
    </section>
  @endif


@endsection

@section('scripts')

<script>
   $(document).ready(function() {
       $('.sessionmodal').addClass("active");
       setTimeout(function() {
           $('.sessionmodal').removeClass("active");
      }, 4500);
    });
</script>


 @if($setting->right_setting == 1)
  <script type="text/javascript" language="javascript">
   // Right click disable
    $(function() {
    $(this).bind("contextmenu", function(inspect) {
    inspect.preventDefault();
    });
    });
      // End Right click disable
  </script>
@endif

@if($setting->element_setting == 1)
<script type="text/javascript" language="javascript">
//all controller is disable
      $(function() {
      var isCtrl = false;
      document.onkeyup=function(e){
      if(e.which == 17) isCtrl=false;
}

      document.onkeydown=function(e){
       if(e.which == 17) isCtrl=true;
      if(e.which == 85 && isCtrl == true) {
     return false;
    }
 };
      $(document).keydown(function (event) {
       if (event.keyCode == 123) { // Prevent F12
       return false;
  }
      else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I
     return false;
   }
 });
});
     // end all controller is disable
 </script>


@endif
@endsection
