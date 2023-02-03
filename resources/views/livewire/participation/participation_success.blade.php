@extends('layouts.developpeur_layout')
@section('content')
<div  class="container  mt-5 mb-5 d-flex justify-content-center">
        {{--succès de participation--}}

    <section>
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
        <lottie-player src="https://assets5.lottiefiles.com/packages/lf20_atippmse.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"    autoplay></lottie-player>
        <h4 class="success text-center mt-5" style="color: antiquewhite">Merci de participer</h4>
        <a href="/projets" class="relative inline-flex items-center justify-center p-0.5 mt-3 mb-2 mr-2 overflow-hidden text-sm font-medium  rounded-lg group bg-gradient-to-br from-green-400 to-blue-600 group-hover:from-green-400 group-hover:to-blue-600 hover:text-white text-white focus:ring-4 focus:outline-none focus:ring-green-800">
            <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-gray-900 rounded-md group-hover:bg-opacity-0">
                Retour à la page d'accueil
            </span>
        </a>
          
    </section>
</div>
@endsection