<!doctype html>
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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"rel="stylesheet" /> 
 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel = "stylesheet">

    @livewireStyles
    @livewireScripts
    <style>
        .test{
            background-color: red;
        }
        .dropdown:hover .dropdown-menu {
        display: block;
        }
      </style>
</head>
<body class="bg-gray-500 ">
  <div class="container-fluid">
    <div class="row flex-nowrap">
        <div id="nav" class="col-auto col-md-3 col-xl-2 px-sm-0 px-0  my-3 exemple " onmouseover="show()" onmouseout="hide()">
        
            <div class="d-flex flex-column align-items-center align-items-sm-start   pt-2 text-white min-vh-100  ">
                <a href="/" class=" ml-7  d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline ">Menu</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    
                    <li class="hover:bg-white  active:bg-white w-full mt-3 mb-2 ml-7 pr-14 rounded-l-3xl hover:text-black">
                        <a href="/dashboard"  class="   nav-link  my-1 align-middle  text-black   hover:text-black  ">
                          <i class='bx bx-tachometer' ></i> <span class="ms-1 d-none d-sm-inline pli ">Dashboard</span> </a>
                    </li >

                    <li id = "list" class="  w-full hover:bg-white active active:bg-white  mb-2 ml-7 pr-14 rounded-l-3xl hover:text-black">
                        <a onclick="activer()" href="/liste_projet" class="  nav-link my-1 align-middle text-black  hover:text-black  ">
                          <i class='bx bxs-component'></i> <span class="ms-1 d-none d-sm-inline pli">Projets</span></a>
                    </li>
                    <li class=" w-full hover:bg-white  mb-2 ml-7 pr-14 rounded-l-3xl hover:text-black">
                        <a href="/participant"  class="nav-link my-1 align-middle text-black hover:text-black  ">
                          <i class='bx bxs-group'></i> <span class="ms-1 d-none d-sm-inline pli">Participants</span> </a>
                    </li>
                    <li class=" w-full hover:bg-white  mb-2 ml-7 pr-14 rounded-l-3xl hover:text-black">
                        <a href="/liste_depot" class="nav-link my-1 align-middle text-black  hover:text-black">
                          <i class='bx bx-package'></i> <span class="ms-1 d-none d-sm-inline pli">Dépots</span> </a>
                    </li>
                    <li class=" w-full hover:bg-white   active:bg-white mb-2 ml-7 pr-14 rounded-l-3xl hover:text-black">
                        <a href="/liste_categorie"  class="nav-link my-1 align-middle text-black hover:text-black   ">
                          <i class='bx bx-category-alt'></i> <span class="ms-1 d-none d-sm-inline pli">Categories</span></a>
                    </li>
                    <li class=" w-full hover:bg-white  mb-2 ml-7 pr-14 rounded-l-3xl hover:text-black">
                      <a href="#" class="nav-link my-1 align-middle  hover:text-black text-black ">
                        <i class='bx bx-archive'></i> <span class="ms-1 d-none d-sm-inline pli">Archives</span> </a>
                    </li>
                    <li class=" w-full hover:bg-white  mb-2 ml-7 pr-10 rounded-l-3xl hover:text-black">
                        <a href="#" class="nav-link my-1 align-middle hover:text-black text-black ">
                            <i class='bx bx-group'></i> <span class="ms-1 d-none d-sm-inline pli">Liste des developpeurs</span> </a>
                    </li>
                    <li class="dropdown  ">
                            <a href = "#" class="nav-link my-1 align-middle  hover:text-black  text-black inline-flex items-center w-full hover:bg-white  mb-2 ml-7 pr-14 rounded-l-3xl hover:text-black">
                                <i class='bx bx-group'></i>
                                <span class=" ms-2 d-none d-sm-inline pli">CDO
                                    <span id ='nombre_notif' class="text-white bg-red-700 absolute rounded-full text-xs  py-0 px-1.5"> 
                                        @php
                                            $nombre_notif = auth()->user()->unreadNotifications->count();
                                        @endphp
                                        @if($nombre_notif != 0 )
                                        {{$nombre_notif}}
                                        @endif
                                    </span>
                                </span> 
                            </a> 

                            <ul class="dropdown-menu relative hidden border-none pt-1 bg-gray-500 text-black">
                              <li class="w-full hover:bg-white   mb-2 ml-7 pr-14 rounded-l-3xl hover:text-black">
                                <a class="rounded-t    py-2 px-4 block whitespace-no-wrap" href="/liste_demande" onclick="loadDoc()">
                                    Demandes       
                                    <span id ='nombre_notif' class="text-white bg-red-700 absolute rounded-full text-xs py-0 px-1.5"> 
                                        @if($nombre_notif != 0 )
                                        {{$nombre_notif}}
                                        @endif</span>
                                </a>
                              </li>
                              <li class="w-full hover:bg-white  mb-2 ml-7 pr-14 rounded-l-3xl hover:text-black"><a class="  py-2 px-4 block whitespace-no-wrap" href="/liste_partenaire">Liste</a></li>
                            </ul>

                    </li>

                    <li class=" w-full hover:bg-white  mb-2 ml-7  rounded-l-3xl hover:text-black">
                        <a href="/parametre" class="nav-link my-1 align-middle  hover:text-black  text-black">
                            <i class='bx bx-cog'></i>
                               <span class="ms-1 d-none d-sm-inline pli">Paramètre</span> 
                        </a>
                    </li>

                    <li class=" w-full hover:bg-white  mb-2 ml-7 pr-14 rounded-l-3xl hover:text-black">
                            <a class=" nav-link my-1 align-middle  hover:text-black text-black" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class='bx bx-log-out'></i> <span class="ms-1 d-none d-sm-inline pli">Deconnexion</span>                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                    </li>

                </ul>
                
            </div>
        </div>

    <div class="col py-3 bg-white my-3 mr-5 rounded-3xl h-screen overflow-auto	">
        @yield('content')
    </div>
    </div>
  </div>
    <script>
        function activer()
        {
            document.getElementById('list').classList.add("test");

        }
        function loadDoc() {
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            document.getElementById("nombre_notif").innerHTML = this.responseText;
            }
        xhttp.open("GET", "/markasread", true);
        xhttp.send();
}
    </script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/app.js') }}"  ></script>
    <script src="{{ asset('js/projet.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>


 
</body>
</html>