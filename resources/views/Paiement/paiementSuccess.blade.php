@extends('layouts.developpeur_layout')
@section('content')
<!-- component -->
<div class="bg-gray-800 h-screen mt-10">
    <div class="bg-gray-800 p-6 w-2/4  mx-auto">
      <div class="grid  place-items-center">
      <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
        <lottie-player src="https://assets5.lottiefiles.com/packages/lf20_atippmse.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"    autoplay></lottie-player>
      </div>
      <div class="text-center mt-3">
          <h3 class="md:text-2xl text-base text-white font-semibold text-center">Paiement effectué!</h3>
          <p class="text-gray-400 my-2">Merci d'avoir effectué votre paiement en ligne sécurisé.</p>
            <p class="text-gray-400">Nous vous enverrons par mail la réponse de votre demande</p>
          <p class="text-gray-400"> Passe une bonne journée!
          </p>
          <div class="py-2 text-center">
            <a  href="/home"  class=" inline-flex items-center justify-center p-0.5 mb-2 block  mx-auto overflow-hidden text-sm font-medium  rounded-lg group bg-gradient-to-br from-green-400 to-blue-600 group-hover:from-green-400 group-hover:to-blue-600 hover:text-white text-white focus:ring-4 focus:outline-none focus:ring-green-800" >
              <span class=" px-5 py-2.5 transition-all ease-in duration-75  bg-gray-900 rounded-md group-hover:bg-opacity-0">
                Aller à l'accueil 
              </span>
            </a>
          </div>
      </div>
  </div>
</div>
@endsection