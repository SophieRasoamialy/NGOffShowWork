@extends('layouts.app')

@section('content')
<div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="w-2/3">
            <div class="card  shadow-md border-none rounded-2xl" >
                <div class="flex g-0 bg-gray-800 rounded-2xl">
                    <div class="m-auto w-2/5  "  >
                        <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script> 
                        <dotlottie-player src="https://lottie.host/e05da042-7554-4afb-828d-7ce2dcfc9e6a/qQZkRqMp8J.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></dotlottie-player>
                    </div>
                    <div class="w-3/5 d-flex align-items-center rounded-r-lg bg-gray-100">

                    <div class="card-body p-3 p-lg-5 text-black">
                            <div class=" mx-auto  w-2/3 ">
                                <a style="font-family:Anta" class="font-bold text-lg" href="{{ url('/') }}">
                                        <span class="flex items-center justify-center text-center text-green-600 ">NGOffShowWork</span>
                                </a>                                
                            </div>

                            <div class="card-body">
                                {{ __('Veuillez confirmer votre mot de passe avant de poursuivre.') }}

                                <form method="POST" action="{{ route('password.confirm') }}">
                                    @csrf

                                    <div class="row ">

                                        <div class="">
                                            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Mot de passe</label>
                                            <input id="password" type="password" class=" @error('password') is-invalid @enderror
                                            form-control block w-full py-1.5  text-gray-900 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                             name="password" required autocomplete="current-password" placeholder="Mot de passe">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-md-8 ">
                                            <button 
                                                class=" form-control text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 "
                                                 type="submit">
                                                {{ __('Confirmer Mot de passe') }}
                                            </button>

                                            @if (Route::has('password.request'))
                                                <a class="font-semibold leading-6 text-blue-600 hover:text-blue-500" href="{{ route('password.request') }}">
                                                    {{ __('Mot de passe oublié ?') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
