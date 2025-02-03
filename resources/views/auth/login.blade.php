@extends('layouts.login_layout')

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

                        <div class="card-body  text-black px-5">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class=" mx-auto  w-2/3 ">
                                    <a style="font-family:Anta" class="font-bold text-lg" href="{{ url('/') }}">
                                            <span class="flex items-center justify-center text-center text-green-600 ">NGOffShowWork</span>
                                    </a>                                
                                </div>
                
                                <h2 class="mt-2 text-center text-xl font-bold leading-9 tracking-tight text-gray-900">Se connecter à votre compte</h2>
                                <div class="form-outline mb-4">
                                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Adresse email</label>
                                    <input type="email" id="email"  class = "@error('email') is-invalid @enderror
                                    form-control block w-full py-1.5  text-gray-900 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" 
                                     name="email" value="{{ old('email') }}" required autocomplete="email" autofocus 
                                    />
                                    @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                                <div class="form-outline mb-4">
                                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Mot de passe</label>
                                    <input id="password" type="password"  class=" @error('password') is-invalid @enderror 
                                    form-control block w-full py-1.5  text-gray-900 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    name="password" required autocomplete="current-password" :type="show ? 'password' : 'text'" 
                                    >
                                    
                                    @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                                <div class="form-outline mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="block text-sm font-medium leading-6 text-gray-900" for="remember">
                                                {{ __('Se Souvenir de moi') }}
                                            </label>
                                        </div>
                                </div>
                                <div class="pt-1 mb-4">
                                    <button 
                                    class=" form-control text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 "
                                    type="submit">Se Connecter</button>
                                    
                                </div>
                                @if (Route::has('password.request'))
                                            <a class="font-semibold leading-6 text-blue-600 hover:text-blue-500" href="{{ route('password.request') }}">
                                                {{ __('Mot de passe oublié?') }}
                                            </a>
                                @endif
                                <p class="mt-8 text-center text-sm text-gray-500" >Vous n'avez pas de compte ? <a href="{{ route('register') }}" class="font-semibold leading-6 text-blue-600 hover:text-blue-500">Inscrivez-vous ici</a></p>
                            </form>
                        </div>
            </div>
        </div>
    </div>
</div>
@endsection
