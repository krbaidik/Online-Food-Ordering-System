<!DOCTYPE html>
<html lang="en">
<head>
  <title>
    @yield('title')
  </title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" type="text/css" href="https://pro.fontawesome.com/releases/v6.0.0-beta1/css/all.css">
  @yield('css')
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

</head>
<body onload="myfunction();">

  <div id="loading"> 
  </div>

<nav class="navbar navbar-expand-md navbar-dark main-header">
  <a class="navbar-brand logo" href="/">Food4Me</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse text-danger" id="collapsibleNavbar">
    <ul class="navbar-nav pr-2 list">
      <li class="nav-item">
        <a class="nav-link @yield('menuactive')" href="{{ route('food_menu')}}">Menu List</a>
      </li>
      </ul>

@if(Auth::user())

 <ul class="navbar-nav"> 
      <li class="nav-item">
        <a class="nav-link @yield('orderactive')" href="{{asset('myorders')}}">My order</a>
      </li>
      </ul>
    
  </ul>
@endif
   <ul class="navbar-nav ml-auto"> 
    <li class="nav-item pr-5">
        <a class="nav-link @yield('cartactive')" style="font-size: 18px; color: white" href="{{asset('cart')}}"><i class="fa-solid fa-cart-shopping" aria-hidden="true" style="font-size: 25px; color: white"></i> Cart <sup style="background: green; padding: 4px; color: white; border-radius: 5px;" class="cartcount">{{Cart::count() ?? ''}}</sup></a>
      </li>
@if(Auth::user())
   <li class="nav-item dropdown " style="font-size: 18px;">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="font-size: 18px; color: white"> WELCOME <span> {{ Auth::user()->name }}</span>
                                     <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <a href="profile" class="dropdown-item">profile</a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
    </ul>

                          @else
<ul class="navbar-nav ml-auto">

      <li class="nav-item ">
        <a class="nav-link" href="login" style="font-size: 18px; color: white"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
      </li> 
</ul>
    @endif
     
  </div>  
</nav>

<div class="container-fluid ">
  <div class="backgroundsearch">
  <center>
  <form action="/searchfood" method="post">
        @csrf
     <input type="search" name="search" class="p-2 m-1" placeholder="search food menu / blank it to browse all " style="outline-width: 0" value="{{old('search',$value?? '')}}">
     <button class="btn btn-success" type="submit" style="margin-left: -59px; border-top-right-radius: 30px; border-bottom-right-radius: 30px; margin-bottom: 1px"><i class="fa fa-search" style="padding: 3px; font-size: 20px"></i></button> 
  </form>
      <div style="background-color: rgba(0,0,0, 0.8); padding: 10px">
          <h2 style=" font-weight: bold; font-size: 40px; color: red">Are You Hungry ??</h2>
          <p style="font-size: 30px; color: yellow;">You are in right place ! order from here..</p>
      </div>
  </center>
</div>
  @yield('content')
</div>


  <div class="container-fluid main-footer">
    <div class="row footer-row">
      <div class="col-md-2 column">
        <h4>Food4Me</h4>
        <ul type="circle" class="u_list">
          <li><a href="/about-us">About Us</a></li>
          {{-- <li>  <a href="">Areas</a></li> --}}
        </ul>
      </div>
      <div class="col-md-2 column" >
        <h4>Get Help</h4>
        <ul type="circle" class="u_list">
          <li><a href="/how-to-order">How to Order?</a></li>
          {{-- <li><a href="">FAQs</a></li> --}}
        </ul>
      </div>
      <div class="col-md-5 column" >
        <h4>Map Location</h4>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1042.8729861469787!2d85.32994872200382!3d27.67987503968123!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19ca771e9e55%3A0xc94f84d1f057520f!2sNagarjuna%20College%20of%20IT!5e0!3m2!1sen!2snp!4v1618764241344!5m2!1sen!2snp" style="border:0;" loading="lazy"></iframe>
      </div>
      <div class="col-md-3 column">
        <h4>Contact Us</h4>
        <form method="post" action="feedback">
          @csrf
          <input type="email" name="email" class="form-control" placeholder="Enter Email...">
          <input type="text" name="subject" class="form-control" placeholder="Enter Subject...">
          <textarea rows="3" cols="10" placeholder="Give your Feedback..." class="form-control" name="feedback"></textarea>
          <input type="submit" name="submit" value="Give Feedback" class="btn btn-primary">

        </form>
      </div>
    </div>
  </div>
  <div class="last-footer">
    <div class="f1"><p>Food4Me</p></div>
    <div  class="f1"><p>{{ date('Y')}} All Right Reserved</p></div>
</div>
</footer>


<script src="{{ asset('assets/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="https://use.fortawesome.com/1ce05b4b.js"></script>
<script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

@yield('js')
<script type="text/javascript"> 

  var preloader = document.getElementById('loading');

function myfunction(){
  preloader.style.display = 'none';
}



</script>

</body>
</html>


