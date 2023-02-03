@extends('layouts.login_layout')

@section('content')
<div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
            <div class="card  shadow-md border-none rounded-2xl" >
                <div class="row g-0 bg-gray-800 rounded-2xl">
                    <div class="col-md-6 col-lg-5 my-auto    d-md-block  "  >
                        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                        <lottie-player src="{{asset('/storage/images/login.json')}}"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop  autoplay></lottie-player>
                    </div>
                    <div class="col-md-6 col-lg-7 d-flex align-items-center rounded-r-lg bg-gray-100">

                        <div class="card-body p-3 p-lg-5 text-black">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="d-flex align-items-center mb-3 pb-1 w-32 mx-auto">
                                    <img src="{{asset('/storage/images/logoL.png')}}" alt="NGOFFSHOW">
                                </div>
                
                                <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Connectez-vous à votre compte</h5>
                                <div class="form-outline mb-4">
                                    <input type="email" id="email"  class = "@error('email') is-invalid @enderror
                                    form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
                                    " name="email" value="{{ old('email') }}" required autocomplete="email" autofocus  placeholder="Addresse email"
                                    />
                                    @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                                <div class="form-outline mb-4">
                                    <input id="password" type="password"  class=" @error('password') is-invalid @enderror 
                                    form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" 
                                    name="password" required autocomplete="current-password" :type="show ? 'password' : 'text'" 
                                    placeholder="Mot de passe">
                                    
                                    @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                                <div class="form-outline mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">
                                                {{ __('Se Souvenir de moi') }}
                                            </label>
                                        </div>
                                </div>
                                <div class="pt-1 mb-4">
                                    <button class="mt-3 text-lg font-semibold 
                bg-gray-800 w-full text-white rounded-lg
                px-6 py-3 block shadow-xl hover:text-white hover:bg-black form-control" type="submit">Se Connecter</button>
                                    
                                </div>
                                @if (Route::has('password.request'))
                                            <a style="color: #1d4ed8" href="{{ route('password.request') }}">
                                                {{ __('Mot de passe oublié?') }}
                                            </a>
                                @endif
                                <p class="mb-5 pb-lg-2" >Vous n'avez pas de compte ? <a href="{{ route('register') }}" style="color: #1d4ed8">Inscrivez-vous ici</a></p>
                            </form>
                        </div>
            </div>
        </div>
    </div>
</div>
@endsection
