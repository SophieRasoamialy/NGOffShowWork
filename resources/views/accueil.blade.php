
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"rel="stylesheet" />
    
</head>
<body>
    <div id = "app" class = ""  style="background-image: url('{{asset('/storage/images/jumbotron.jpg')}}'); background-size:100% " >
        <nav class="navbar navbar-expand-md ">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    NGOffShowWork
                    {{-- config('app.name', 'Laravel') --}}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">

                                    <a href="{{ route('login') }}" class=" nav-link text-gray-900 hover:text-white border-2 border-gray-900 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 ">
                                        {{ __('Login') }}
                                    </a>

                                </li>
                                
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a href="{{ route('register') }}" class=" nav-link text-blue-700 hover:text-white border-2 border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5  text-center mr-2 mb-2 ">
                                        {{ __('Register') }}
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img class="image rounded-circle" src="{{asset('/storage/profile/'.Auth::user()->avatar)}}" alt="profile_image" style="width: 30px;height: 30px;  "> 
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                  @can('admin')

                                      <a href="/liste_projet" class="dropdown-item">
                                          Mon compte
                                      </a>

                                    @endcan
                                    @can('cdo')

                                      <a href="/dashboard" class="dropdown-item">
                                          Mon compte
                                      </a>

                                    @endcan
                                    @can('developpeur')

                                      <a href="/dashboard" class="dropdown-item">
                                          Mon compte
                                      </a>

                                @endcan
                                    <a class="dropdown-item" href="{{ route('logout') }}"
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

        <div class = "flex">
            <div class=" my-5 justify  mx-auto w-1/2">
                <h1 class="text-2xl font-bold py-3  ">
                    Des milliers de dévéloppeur sont prêts à faire vos projets.
                </h1>
                <p class="text-lg">Qualifié dans votre domaine ? Nous vous trouvons
                    des missions sur-mesure qui respectent vos
                    critères
                </p>
                @guest
                <div class="my-5">
                    <button type="button" onclick="redirection_developper()" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 ">
                    Je suis Développeur
                    </button>
                    
                    <button type = "button" onclick="redirection_cdo()" class="text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 shadow-lg shadow-teal-500/50 dark:shadow-lg dark:shadow-teal-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                    Je suis Client
                    </button>
                </div>
                @endguest
            </div>
            <div class="mx-auto">
                <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_su8vw1n6.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop  autoplay></lottie-player>
            </div>
        </div>
        
    </div>
    <h3 class="text-center font-bold text-lg my-3 ">+20 categories de projet</h3>
        <div class="flex items-center justify-center">
            <div class="mr-10" >
                <label class="flex items-center justify-center">Site web</label>
                <lottie-player src="https://assets1.lottiefiles.com/packages/lf20_hcfsowh6.json"  background="transparent"  speed="1"  style="width: 200px; height: 200px;"  loop  autoplay></lottie-player>
            </div>
            <div class="mr-10">
                <label class="flex items-center justify-center">Application web</label>
                <lottie-player src="https://assets1.lottiefiles.com/packages/lf20_mcvtkrvc.json"  background="transparent"  speed="1"  style="width: 200px; height: 200px;"  loop  autoplay></lottie-player>
            </div>
            <div class="mr-10">
                <label class="flex items-center justify-center">Application mobile</label>
                <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_zvcyhdqv.json"  background="transparent"  speed="1"  style="width: 200px; height: 200px;"  loop  autoplay></lottie-player>
            </div>
            <div>
                <label class="flex items-center justify-center">Design</label>
                <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_2nbubmkc.json"  background="transparent"  speed="1"  style="width: 200px; height: 200px;"  loop  autoplay></lottie-player>
            </div>
        </div>
        <div>
            <!-- Container for demo purpose -->
<div class="container my-24 px-6 mx-auto">

    <!-- Section: Design Block -->
    <section class="mb-32 text-gray-800 text-center">
      <h2 class="text-3xl font-bold mb-20">Why is it so great?</h2>
  
      <div class="grid lg:gap-x-12 lg:grid-cols-3">
        <div class="mb-12 lg:mb-0">
          <div class="rounded-lg shadow-lg h-full block bg-white">
            <div class="flex justify-center">
              <div class="p-4 bg-blue-600 text-white rounded-full shadow-lg inline-block -mt-8">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z" />
                </svg>
                
              </div>
            </div>
            <div class="p-6">
              <h3 class="text-2xl font-bold text-blue-600 mb-4">1000</h3>
              <h5 class="text-lg font-medium mb-4">Clients satisfaits</h5>
              <p class="text-gray-500">
                Laudantium totam quas cumque pariatur at doloremque hic quos quia eius
              </p>
            </div>
          </div>
        </div>
  
        <div class="mb-12 lg:mb-0">
          <div class="rounded-lg shadow-lg h-full block bg-white">
            <div class="flex justify-center">
              <div class="p-4 bg-blue-600 rounded-full shadow-lg inline-block -mt-8">
                <svg
                  class="w-7 h-7 text-white"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 544 512"
                >
                  <path
                    fill="currentColor"
                    d="M527.79 288H290.5l158.03 158.03c6.04 6.04 15.98 6.53 22.19.68 38.7-36.46 65.32-85.61 73.13-140.86 1.34-9.46-6.51-17.85-16.06-17.85zm-15.83-64.8C503.72 103.74 408.26 8.28 288.8.04 279.68-.59 272 7.1 272 16.24V240h223.77c9.14 0 16.82-7.68 16.19-16.8zM224 288V50.71c0-9.55-8.39-17.4-17.84-16.06C86.99 51.49-4.1 155.6.14 280.37 4.5 408.51 114.83 513.59 243.03 511.98c50.4-.63 96.97-16.87 135.26-44.03 7.9-5.6 8.42-17.23 1.57-24.08L224 288z"
                  ></path>
                </svg>
              </div>
            </div>
            <div class="p-6">
              <h3 class="text-2xl font-bold text-blue-600 mb-4">70%</h3>
              <h5 class="text-lg font-medium mb-4">Growth</h5>
              <p class="text-gray-500">
                Eum nostrum fugit numquam, voluptates veniam neque quibusdam ullam
              </p>
            </div>
          </div>
        </div>
  
        <div class="">
          <div class="rounded-lg shadow-lg h-full block bg-white">
            <div class="flex justify-center">
              <div class="p-4 bg-blue-600 rounded-full shadow-lg inline-block -mt-8">
                <svg
                  class="w-7 h-7 text-white"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 640 512"
                >
                  <path
                    fill="currentColor"
                    d="M512.1 191l-8.2 14.3c-3 5.3-9.4 7.5-15.1 5.4-11.8-4.4-22.6-10.7-32.1-18.6-4.6-3.8-5.8-10.5-2.8-15.7l8.2-14.3c-6.9-8-12.3-17.3-15.9-27.4h-16.5c-6 0-11.2-4.3-12.2-10.3-2-12-2.1-24.6 0-37.1 1-6 6.2-10.4 12.2-10.4h16.5c3.6-10.1 9-19.4 15.9-27.4l-8.2-14.3c-3-5.2-1.9-11.9 2.8-15.7 9.5-7.9 20.4-14.2 32.1-18.6 5.7-2.1 12.1.1 15.1 5.4l8.2 14.3c10.5-1.9 21.2-1.9 31.7 0L552 6.3c3-5.3 9.4-7.5 15.1-5.4 11.8 4.4 22.6 10.7 32.1 18.6 4.6 3.8 5.8 10.5 2.8 15.7l-8.2 14.3c6.9 8 12.3 17.3 15.9 27.4h16.5c6 0 11.2 4.3 12.2 10.3 2 12 2.1 24.6 0 37.1-1 6-6.2 10.4-12.2 10.4h-16.5c-3.6 10.1-9 19.4-15.9 27.4l8.2 14.3c3 5.2 1.9 11.9-2.8 15.7-9.5 7.9-20.4 14.2-32.1 18.6-5.7 2.1-12.1-.1-15.1-5.4l-8.2-14.3c-10.4 1.9-21.2 1.9-31.7 0zm-10.5-58.8c38.5 29.6 82.4-14.3 52.8-52.8-38.5-29.7-82.4 14.3-52.8 52.8zM386.3 286.1l33.7 16.8c10.1 5.8 14.5 18.1 10.5 29.1-8.9 24.2-26.4 46.4-42.6 65.8-7.4 8.9-20.2 11.1-30.3 5.3l-29.1-16.8c-16 13.7-34.6 24.6-54.9 31.7v33.6c0 11.6-8.3 21.6-19.7 23.6-24.6 4.2-50.4 4.4-75.9 0-11.5-2-20-11.9-20-23.6V418c-20.3-7.2-38.9-18-54.9-31.7L74 403c-10 5.8-22.9 3.6-30.3-5.3-16.2-19.4-33.3-41.6-42.2-65.7-4-10.9.4-23.2 10.5-29.1l33.3-16.8c-3.9-20.9-3.9-42.4 0-63.4L12 205.8c-10.1-5.8-14.6-18.1-10.5-29 8.9-24.2 26-46.4 42.2-65.8 7.4-8.9 20.2-11.1 30.3-5.3l29.1 16.8c16-13.7 34.6-24.6 54.9-31.7V57.1c0-11.5 8.2-21.5 19.6-23.5 24.6-4.2 50.5-4.4 76-.1 11.5 2 20 11.9 20 23.6v33.6c20.3 7.2 38.9 18 54.9 31.7l29.1-16.8c10-5.8 22.9-3.6 30.3 5.3 16.2 19.4 33.2 41.6 42.1 65.8 4 10.9.1 23.2-10 29.1l-33.7 16.8c3.9 21 3.9 42.5 0 63.5zm-117.6 21.1c59.2-77-28.7-164.9-105.7-105.7-59.2 77 28.7 164.9 105.7 105.7zm243.4 182.7l-8.2 14.3c-3 5.3-9.4 7.5-15.1 5.4-11.8-4.4-22.6-10.7-32.1-18.6-4.6-3.8-5.8-10.5-2.8-15.7l8.2-14.3c-6.9-8-12.3-17.3-15.9-27.4h-16.5c-6 0-11.2-4.3-12.2-10.3-2-12-2.1-24.6 0-37.1 1-6 6.2-10.4 12.2-10.4h16.5c3.6-10.1 9-19.4 15.9-27.4l-8.2-14.3c-3-5.2-1.9-11.9 2.8-15.7 9.5-7.9 20.4-14.2 32.1-18.6 5.7-2.1 12.1.1 15.1 5.4l8.2 14.3c10.5-1.9 21.2-1.9 31.7 0l8.2-14.3c3-5.3 9.4-7.5 15.1-5.4 11.8 4.4 22.6 10.7 32.1 18.6 4.6 3.8 5.8 10.5 2.8 15.7l-8.2 14.3c6.9 8 12.3 17.3 15.9 27.4h16.5c6 0 11.2 4.3 12.2 10.3 2 12 2.1 24.6 0 37.1-1 6-6.2 10.4-12.2 10.4h-16.5c-3.6 10.1-9 19.4-15.9 27.4l8.2 14.3c3 5.2 1.9 11.9-2.8 15.7-9.5 7.9-20.4 14.2-32.1 18.6-5.7 2.1-12.1-.1-15.1-5.4l-8.2-14.3c-10.4 1.9-21.2 1.9-31.7 0zM501.6 431c38.5 29.6 82.4-14.3 52.8-52.8-38.5-29.6-82.4 14.3-52.8 52.8z"
                  />
                </svg>
              </div>
            </div>
            <div class="p-6">
              <h3 class="text-2xl font-bold text-blue-600 mb-4">49</h3>
              <h5 class="text-lg font-medium mb-4">Projects</h5>
              <p class="text-gray-500">
                Cupiditate enim, minus nulla dolor cumque iure eveniet facere ullam
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Section: Design Block -->
  
  </div>
  <!-- Container for demo purpose -->
        </div>
    <div class="my-5 flex p-5  bg-gray-100">
        <div class="">
            <label > <div class="flex -space-x-4">
                <img class="w-10 h-10 rounded-full border-2 border-white dark:border-gray-800" src="{{asset('/storage/profile/1671434630.jpg')}}" alt="">
                <img class="w-10 h-10 rounded-full border-2 border-white dark:border-gray-800" src="{{asset('/storage/profile/1670918882.jpg')}}" alt="">
                <img class="w-10 h-10 rounded-full border-2 border-white dark:border-gray-800" src="{{asset('/storage/profile/1670590115.jpg')}}" alt="">
                <a class="flex justify-center items-center w-10 h-10 text-xs font-medium text-white bg-gray-700 rounded-full border-2 border-white hover:bg-gray-600 dark:border-gray-800" href="#">+100</a>
               <span class=" mx-2 mt-2"> developppeurs déjà inscrits <br>qui se mettent en competition pour réaliser vos projets.</span>
            </div> </label>
        </div>
        <div class="grid grid-cols-6 gap-4  ml-5">
            <div class="col-start-2 col-span-4 ...">
                <lottie-player src="https://assets4.lottiefiles.com/packages/lf20_3ntisyac.json"  background="transparent"  speed="1"  style="width: 150px; height: 150px;"  loop  autoplay></lottie-player>
            </div>
            <div class="col-start-1 col-end-3 ...">
                <lottie-player src="https://assets4.lottiefiles.com/packages/lf20_vbhx85ve.json"  background="transparent"  speed="1"  style="width: 150px; height: 150px;"  loop  autoplay></lottie-player>
            </div>
            <div class="col-end-7 col-span-2 ...">
                <lottie-player src="https://assets4.lottiefiles.com/packages/lf20_gnb0jsok.json"  background="transparent"  speed="1"  style="width: 150px; height: 150px;"  loop  autoplay></lottie-player>
            </div>
            <div class="col-start-1 col-end-7 ..."></div>
          </div>
          
        


    </div>
</body>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

<script>
    function redirection_developper()
    {
        window.location.href = "/form_developer";
        
        
    }

    function redirection_cdo()
    {
       window.location.href = "/bienvenue";

    }
</script>
</html>

