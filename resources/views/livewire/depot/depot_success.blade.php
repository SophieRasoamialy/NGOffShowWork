@extends('layouts.developpeur_layout')
@section('content')
<section>
    <div class="grid  place-items-center mt-5 mb-3">
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
          <lottie-player src="https://assets5.lottiefiles.com/packages/lf20_atippmse.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"    autoplay></lottie-player>
    </div>
    <h4 class="success text-white text-center mb-3">Votre projet est bien réçu! Nous vous informerons le résultat.<br> Merci de participer!</h4>
    <div class="grid  place-items-center">
        <a  href="/projets"  class=" inline-flex items-center justify-center p-0.5 mb-2 block  mx-auto overflow-hidden text-sm font-medium  rounded-lg group bg-gradient-to-br from-green-400 to-blue-600 group-hover:from-green-400 group-hover:to-blue-600 hover:text-white text-white focus:ring-4 focus:outline-none focus:ring-green-800" >
            <span class=" px-5 py-2.5 transition-all ease-in duration-75  bg-gray-900 rounded-md group-hover:bg-opacity-0">
            Aller à l'accueil 
            </span>
        </a>
    </div>
</section>
@endsection