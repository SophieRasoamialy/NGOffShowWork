<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    
        <title>{{ config('app.name', 'Laravel') }}</title>
    
    
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <!-- Styles -->
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"rel="stylesheet" /> 
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
 
        <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel = "stylesheet">
        <link rel="stylesheet" href="{{ asset('css/template.css')}}">
        
      <style>
        

         .submenu{ 
        list-style: none; 
        margin: 0; 
        padding: 0; 
        padding-left: 1rem; 
        padding-right: 1rem;
      }

      </style>
             
    </head>
    @livewireStyles
        @livewireScripts
    <body  x-data="{ show: false}" class="  bg-gray-800    ">

            <nav class="
  fixed top-0 z-10 
  
  w-full
  flex flex-wrap
  items-center
  justify-between
  py-2
  bg-gray-800
  text-gray-100
  hover:text-whitye
  focus:text-gray-500
  shadow-lg
  shadow-gray-600/50
   navbar-expand-lg navbar-light
  ">
  <div class="container-fluid w-full flex flex-wrap items-center justify-between px-6">
  <button class="
      navbar-toggler
      text-gray-500
      border-0
      hover:shadow-none hover:no-underline
      py-2
      px-2.5
      bg-transparent
      focus:outline-none focus:ring-0 focus:shadow-none focus:no-underline
    " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
  aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bars"
    class="w-6" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
    <path fill="currentColor"
      d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z">
    </path>
  </svg>
  </button>
  <div class=" navbar-collapse flex-grow items-center" id="navbarSupportedContent">
  <a class="
        flex
        items-center
        text-gray-400
        hover:text-white
        focus:text-gray-500
        mt-2
        lg:mt-0
        mr-1
      " href="#">
    <img src="{{asset('/storage/images/logoP.png')}}" class="w-16" alt=""
      loading="lazy" />
  </a>
  <!-- Left links -->
  <ul class="navbar-nav flex flex-col pl-0 list-style-none mr-auto">
    
    <li class="nav-item p-2">
      <a class="nav-link text-gray-300 hover:text-white focus:text-gray-500 p-0" href="/projets">Liste des Projets</a>
    </li>
    <li class="nav-item p-2">
      <a class="nav-link text-gray-300 hover:text-white focus:text-gray-500 p-0" href="/user_projet">Mes Projets</a>
    </li>
    <li class="nav-item p-2">
      <a class="nav-link text-gray-300 hover:text-white focus:text-gray-500 p-0" href="/form_depot">Dépot de projet</a>
    </li>
    <li class="nav-item p-2">
      <a class="nav-link text-gray-300 hover:text-white focus:text-gray-500 p-0" href="/resultat">Résultat</a>
    </li>
    {{--<li class="nav-item p-2">
      <a class="nav-link text-gray-300 hover:text-white focus:text-gray-500 p-0" href="/chatify">Chat</a>
    </li>--}}

  </ul>
  <!-- Left links -->
  </div>
  <!-- Collapsible wrapper -->

  <!-- Right elements -->
  <div class="flex items-center relative  ">
    @php
        $devPremium = App\Models\Abonnement::where('abonnement_type','dev_premium')->first();
        $montant = $devPremium->abonnement_tarif;
    @endphp
  @can('devBasic')
  <i class='bx bxs-crown text-white mr-8 ' ></i>
    <a class=" text-gray-300 hover:text-white
    focus:text-gray-500
    mr-4
    flex items-center"
    href="/choix_paiement?montant={{$montant}}&val=1" ><span>Devenir <b style="color: #f59e0b" > Premium</b></span></a>
  @endcan
  @can('devPremium')
  <i class='bx bxs-crown mr-8 ' style="color: gold" ></i>
  @endcan
  @can('devGuest')
  <a class=" text-gray-300 hover:text-white
    focus:text-gray-500
    mr-4
    flex items-center"
    href="/validation" ><span>S'abonner</span></a>
  @endcan
  <!-- Icon -->
  <a class="
  text-gray-300 hover:text-white
          focus:text-gray-500
          mr-4
          dropdown-toggle
          hidden-arrow
          flex items-center"
          href="#" 
          id="dropdownMenuButton1" 
            x-on:click="show = !show" :aria-expanded="show ? 'true' : 'false'" :class="{ 'active': show }"
            onclick="loadDoc()">
      <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bell"
        class="w-4" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
        <path fill="currentColor"
          d="M224 512c35.32 0 63.97-28.65 63.97-64H160.03c0 35.35 28.65 64 63.97 64zm215.39-149.71c-19.32-20.76-55.47-51.99-55.47-154.29 0-77.7-54.48-139.9-127.94-155.16V32c0-17.67-14.32-32-31.98-32s-31.98 14.33-31.98 32v20.84C118.56 68.1 64.08 130.3 64.08 208c0 102.3-36.15 133.53-55.47 154.29-6 6.45-8.66 14.16-8.61 21.71.11 16.4 12.98 32 32.1 32h383.8c19.12 0 32-15.6 32.1-32 .05-7.55-2.61-15.27-8.61-21.71z">
        </path>
      </svg>
      <span id ='nombre_notif' class="text-white bg-red-700 absolute rounded-full text-xs -mt-2.5 ml-2 py-0 px-1.5">
         @php
            $nombre_notif = auth()->user()->unreadNotifications->count();
            @endphp
            @if($nombre_notif != 0)
            {{$nombre_notif}}
            @endif
      </span>
  </a>
  
  <!-- Right Side Of Navbar -->
  <ul class="navbar-nav ms-auto">
    
    <!-- Authentication Links -->
    @guest
        @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
        @endif

        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif
    @else
        <li class="nav-item dropdown">
            
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              <img class="image rounded-circle" src="{{asset('/storage/profile/'.Auth::user()->avatar)}}" alt="profile_image" style="width: 30px;height: 30px;  "> 
               {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-end border border-gray-600 bg-gray-800" aria-labelledby="navbarDropdown">
                
              <a class="dropdown-item text-gray-300 hover:text-white focus:text-gray-500 hover:bg-gray-700" href="/user_profile">Profile</a>
              {{--<a class="dropdown-item text-gray-300 hover:text-white focus:text-gray-500 hover:bg-gray-700" href="/validation">Payer mon abonnement</a>--}}
              
                <hr class="dropdown-divider bg-gray-300 ">
            
                <a class="dropdown-item text-gray-300 hover:text-white focus:text-gray-500 hover:bg-gray-700" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Se déconnecter') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    @endguest
</ul>
  </div>
  </div>
</nav>

<div class="flex bg-gray-800">
    
  <div class="col mt-20">
    
      @yield('content')
      
  </div>

<!--notification-->
  <div id="sidebar" class="bg-gray-700 overflow-y-auto	mt-20 h-screen sticky top-20 md:block shadow-xl px-3 w-30 md:w-60 lg:w-60  transition-transform duration-300 ease-in-out" x-show="show" >
    <div class="space-y-6 md:space-y-10 mt-10">
      <div class="flex items-center mb-3">
        <span class=" text-sm font-semibold text-white">Nouveau notification</span>
        
    </div>
    <div id="toast-notification" class=" w-full max-w-xs text-gray-900 dark:bg-gray-800 dark:text-gray-300" role="alert">
      @php
          $not = auth()->user()->notifications;
      @endphp
      @if(is_null($not))
      <p>Aucune notification</p>
      @endif
      @foreach($not as $notif)

      <div class="flex items-center mb-3 bg-gray-600 py-3 shadow-md">
        <img class="w-12 h-12 rounded-full" src="{{asset('/storage/images/'.$notif->data['illustration'])}}" alt="">
          
          <div class="ml-3 text-sm font-normal">
              <div class="text-sm font-bold text-white ">
                {{$notif->data['titre']}}
              </div>
              <div class="text-sm font-normal text-white">
                @if($notif->data['notif1'] != null)
                {{$notif->data['notif1']}}
                @endif
              </div>
              <div class="text-sm font-normal text-gray-400">
                {{$notif->data['notif2']}}
              </div>  
              <span class="text-xs font-medium text-blue-300 dark:text-blue-500">
              @php
                  $myDate = $notif->created_at;
                  $result = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $myDate)->diffForHumans();
              @endphp 
              {{$result}}  
              </span>   
          </div>
      </div>
      @endforeach

    </div>

    </div>
    </div>
</div>  
</body>
<script>
        
  document.addEventListener("DOMContentLoaded", function(){
  document.querySelectorAll('.sidebar .nav-link').forEach(function(element){
    
    element.addEventListener('click', function (e) {

      let nextEl = element.nextElementSibling;
      let parentEl  = element.parentElement;	

        if(nextEl) {
            e.preventDefault();	
            let mycollapse = new bootstrap.Collapse(nextEl);
            
            if(nextEl.classList.contains('show')){
              mycollapse.hide();
            } else {
                mycollapse.show();
                // find other submenus with class=show
                var opened_submenu = parentEl.parentElement.querySelector('.submenu.show');
                // if it exists, then close all of them
                if(opened_submenu){
                  new bootstrap.Collapse(opened_submenu);
                }
            }
        }
    }); // addEventListener
  }) // forEach
}); 

function loadDoc() {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    
    document.getElementById("nombre_notif").innerHTML = this.responseText;
    }
  xhttp.open("GET", "/markasread", true);
  xhttp.send();
}

    </script>   
     <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('js/app.js') }}"  ></script>
    <script src="{{ asset('js/projet.js') }}"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/flowbite@1.5.4/dist/flowbite.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</html>