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

      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

      <link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="{{ asset('js/tinymce/js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>

    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel = "stylesheet">

    @livewireStyles
    @livewireScripts
    <style>
       body{
            font-size: 0.9rem;
            line-height: 1.6;
        }
        
        .dropdown:hover .dropdown-menu {
        display: block;
        }
        
      </style>
</head>

<body class="bg-gray-700 ">
  <div class="container-fluid">
    <div class="row flex-nowrap">
        <div id="nav" class="col-auto col-md-3 col-xl-2 px-sm-0 px-0  my-3 exemple " onmouseover="show()" onmouseout="hide()">
            @can('cdo')
            <a class="
            flex
            top
            items-center
            text-gray-400
            hover:text-white
            focus:text-gray-500
        
            ml-7
            lg:mt-0
            mr-1
          " href="#">
        <img src="{{asset('/storage/images/NG.png')}}" class="w-16" alt=""
          loading="lazy" />
        </a>
      @endcan
            <div class="d-flex flex-column align-items-center align-items-sm-start   pt-2 text-white min-vh-100  ">
                <div class="flex">
                    <p class=" ml-7  d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline ">{{auth()->user()->name}}</span>
                    </p>
                    @can('admin')
                    <a class="
                        flex
                        items-center
                        text-gray-400
                        hover:text-white
                        focus:text-gray-500
                        mt-2
                        ml-7
                        lg:mt-0
                        mr-1
                    " href="#">
                    <img src="{{asset('/storage/images/NG.png')}}" class="w-16" alt=""
                    loading="lazy" />
                </a>
                    @endcan
                    @can('cdo')
                    @if(App\Models\CDO::where('user_id',auth()->user()->id)->where('cdo_premium',1)->exists())
                    <i class='bx bxs-crown ml-20 ' style="color: gold" ></i>
                    @elseif(App\Models\CDO::where('user_id',auth()->user()->id)->where('cdo_premium',0)->where('cdo_isvalide',1)->exists())
                    <i class='bx bxs-crown ml-20 ' ></i>
                    @else
                    <i></i>
                    @endif
                    @endcan
                </div>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    
                    <li class="hover:bg-white  active:bg-white w-full  mb-2 ml-7 pr-14 rounded-l-3xl hover:text-black">
                        <a href="/accueil"  class="   nav-link  my-1 align-middle  text-gray-100   hover:text-black  ">
                            <i class='bx bx-home'></i> <span class="ms-1 d-none d-sm-inline pli  ">Accueil</span> </a>
                    </li >

                    <li class="hover:bg-white  active:bg-white w-full  mb-2 ml-7 pr-14 rounded-l-3xl hover:text-black">
                        <a href="/dashboard"  class="   nav-link  my-1 align-middle  text-gray-100   hover:text-black  ">
                          <i class='bx bx-tachometer' ></i> <span class="ms-1 d-none d-sm-inline pli  ">Dashboard</span> </a>
                    </li >
                    

                    <li id = "list" class="  w-full hover:bg-white active active:bg-white  mb-2 ml-7 pr-14 rounded-l-3xl hover:text-black">
                        <a onclick="activer()" href="/liste_projet" class="  nav-link my-1 align-middle text-gray-100  hover:text-black  ">
                          <i class='bx bxs-component'></i> <span class="ms-1 d-none d-sm-inline pli">Projets</span></a>
                    </li>
                    <li class=" w-full hover:bg-white  mb-2 ml-7 pr-14 rounded-l-3xl hover:text-black">
                        <a href="/participant"  class="nav-link my-1 align-middle text-gray-100 hover:text-black  ">
                          <i class='bx bxs-group'></i> <span class="ms-1 d-none d-sm-inline pli">Participants</span> </a>
                    </li>
                    <li class=" w-full hover:bg-white  mb-2 ml-7 pr-14 rounded-l-3xl hover:text-black">
                        <a href="/liste_depot" class="nav-link my-1 align-middle text-gray-100  hover:text-black">
                          <i class='bx bx-package'></i> <span class="ms-1 d-none d-sm-inline pli">Dépots</span> </a>
                    </li>
                    @can('admin')
                    <li class=" w-full hover:bg-white   active:bg-white mb-2 ml-7 pr-14 rounded-l-3xl hover:text-black">
                        <a href="/liste_categorie"  class="nav-link my-1 align-middle text-gray-100 hover:text-black   ">
                          <i class='bx bx-category-alt'></i> <span class="ms-1 d-none d-sm-inline pli">Categories</span></a>
                    </li>
                    <li class=" w-full hover:bg-white   active:bg-white mb-2 ml-7 pr-14 rounded-l-3xl hover:text-black">
                        <a href="/liste_competence"  class="nav-link my-1 align-middle text-gray-100 hover:text-black   ">
                          <i class='bx bx-category-alt'></i> <span class="ms-1 d-none d-sm-inline pli">Compétences</span></a>
                    </li>
                    @endcan
                    <li class=" w-full hover:bg-white  mb-2 ml-7 pr-14 rounded-l-3xl hover:text-black">
                      <a href="/archive" class="nav-link my-1 align-middle  hover:text-black text-gray-100 ">
                        <i class='bx bx-archive'></i> <span class="ms-1 d-none d-sm-inline pli">Archives</span> </a>
                    </li>
                   @can('cdo') 
                    <li class=" w-full hover:bg-white  mb-2 ml-7 pr-10 rounded-l-3xl hover:text-black">
                        <a href="/liste_developpeur" class="nav-link my-1 align-middle hover:text-black text-gray-100 ">
                            <i class='bx bx-group'></i> <span class="ms-1 d-none d-sm-inline pli">Developpeurs</span> </a>
                    </li>
                    @endcan
                    @can('admin')
                    <li class="dropdown  ">
                        @php
                            $nbre_demande_dev = App\Models\DateAbonnement::join('developpeurs','date_abonnements.user_id','developpeurs.user_id')
                            ->join('users','users.id','=','developpeurs.user_id')
                            ->join('abonnements','abonnements.abonnement_id','date_abonnements.abonnement_id')
                            ->where('developpeurs_isvalide',0)->count();
                        @endphp
                        <a href = "#" class="nav-link my-1 align-middle  hover:text-black  text-gray-100 inline-flex items-center w-full hover:bg-white  mb-2 ml-7 pr-10 rounded-l-3xl hover:text-black">
                            <i class='bx bx-group'></i>
                            <span class=" ms-2 d-none d-sm-inline pli">Développeurs
                                <span id ='nombre_notif' class="text-white bg-red-700 absolute rounded-full text-xs  py-0 px-1.5"> 
                                    {{$nbre_demande_dev}}
                                    @php
                                        //$nombre_notif = auth()->user()->unreadNotifications->count();
                                    @endphp
                                   {{-- @if($nombre_notif != 0 )
                                    {{$nombre_notif}}
                                    @endif--}}
                                </span>
                            </span> 
                        </a> 

                        <ul class="dropdown-menu relative hidden border-none pt-1 bg-gray-700 text-gray-100">
                          <li class="w-full hover:bg-white   mb-2 ml-4 pr-7 rounded-l-3xl hover:text-black">
                            <a class="rounded-t  py-2 px-4 block whitespace-no-wrap" href="/demande_developpeur">
                                Demandes       
                                <span id ='nombre_notif' class="text-white bg-red-700 absolute rounded-full text-xs py-0 px-1.5"> 
                                    {{$nbre_demande_dev}}
                                   {{-- @if($nombre_notif != 0 )
                                    {{$nombre_notif}}
                                    @endif--}}</span>
                            </a>
                          </li>
                          <li class="w-full hover:bg-white  mb-2 ml-4 pr-7 rounded-l-3xl hover:text-black">
                            <a class="  py-2 px-4 block whitespace-no-wrap" href="/liste_developpeur">Liste</a>
                            </li>
                        </ul>

                    </li>
                    <li class="dropdown  ">
                        @php
                            $nbre_demande_cdo_basic = App\Models\DateAbonnement::join('c_d_o_s','date_abonnements.user_id','c_d_o_s.user_id')
                            ->where('cdo_isvalide',0)->distinct('c_d_o_s.user_id')->count();
                            $nbre_demande_cdo_premium = App\Models\DateAbonnement::join('c_d_o_s','date_abonnements.user_id','c_d_o_s.user_id')
                            ->where('cdo_isvalide',1)
                            ->where('cdo_premium',0)->distinct('c_d_o_s.user_id')->count();
                        @endphp
                            <a href = "#" class="nav-link my-1 align-middle  hover:text-black  text-gray-100 inline-flex items-center w-full hover:bg-white  mb-2 ml-7 pr-14 rounded-l-3xl hover:text-black">
                                <i class='bx bx-group'></i>
                                <span class=" ms-2 d-none d-sm-inline pli">Client
                                    <span id ='nombre_notif' class="text-white bg-red-700 absolute rounded-full text-xs  py-0 px-1.5"> 
                                        {{$nbre_demande_cdo_basic + $nbre_demande_cdo_premium}}
                                        @php
                                            //$nombre_notif = auth()->user()->unreadNotifications->count();
                                        @endphp
                                       {{-- @if($nombre_notif != 0 )
                                        {{$nombre_notif}}
                                        @endif--}}
                                    </span>
                                </span> 
                            </a> 

                            <ul class="dropdown-menu relative hidden border-none pt-1 bg-gray-700 text-gray-100">
                              <li class="w-full hover:bg-white   mb-2 ml-7 pr-14 rounded-l-3xl hover:text-black">
                                <a class="rounded-t  py-2 px-4 block whitespace-no-wrap" href="/liste_demande" >
                                    Demandes       
                                    <span id ='nombre_notif' class="text-white bg-red-700 absolute rounded-full text-xs py-0 px-1.5"> 
                                        {{$nbre_demande_cdo_basic + $nbre_demande_cdo_premium}}
                                        {{-- @if($nombre_notif != 0 )
                                        {{$nombre_notif}}
                                        @endif--}}</span>
                                </a>
                              </li>
                              <li class="w-full hover:bg-white  mb-2 ml-7 pr-14 rounded-l-3xl hover:text-black">
                                <a class="  py-2 px-4 block whitespace-no-wrap" href="/liste_partenaire">Liste</a>
                                </li>
                            </ul>

                    </li>
                    <li class=" w-full hover:bg-white  mb-2 ml-7  rounded-l-3xl hover:text-black">
                        <a href="/parametre" class="nav-link my-1 align-middle  hover:text-black  text-gray-100">
                            <i class='bx bx-cog'></i>
                               <span class="ms-1 d-none d-sm-inline pli">Paramètre</span> 
                        </a>
                    </li>
                    @endcan
                    @can('cdo')
                    <li class="hover:bg-white  active:bg-white w-full  mb-2 ml-7 pr-14 rounded-l-3xl hover:text-black">
                        <a href="/accueil_cdo"  class="   nav-link  my-1 align-middle  text-gray-100   hover:text-black  ">
                            <i class='bx bx-wallet'></i> <span class="ms-1 d-none d-sm-inline pli ">Paiement</span> </a>
                    </li>
                    @endcan

                    <li class=" w-full hover:bg-white  mb-2 ml-7 pr-14 rounded-l-3xl hover:text-black hover:text-black">
                            <a class=" nav-link my-1 align-middle  hover:text-black text-gray-100" href="{{ route('logout') }}"
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
            @can('cdo')
                @php
                    $not = auth()->user()->unreadNotifications;
                @endphp
                @foreach($not as $notif)
                <div class="relative ">
                    
                    <div id="toast-success{{$notif->id}}" class="flex absolute top-0 right-0 items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
                        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                            @php echo $notif->data['illustration'] @endphp
                            <span class="sr-only">archive icon</span>
                        </div>
                        <div class="ml-3 text-sm font-normal">{{$notif->data['message']}}</div>
                        <a href = "#"  onclick="loadDoc('{{$notif->id}}')"class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success{{$notif->id}}" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </a>
                    </div>
                </div>
                @endforeach
            @endcan
                @yield('content')
    </div>
    </div>
  </div>
    <script>
        function activer()
        {
            document.getElementById('list').classList.add("test");
        }
        function loadDoc(id) {

            const xhttp = new XMLHttpRequest();
            xhttp.open("GET", "/markasreadcdo/"+id, true);
            xhttp.send();
            

}
    </script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://unpkg.com/flowbite@1.5.4/dist/flowbite.js"></script>

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