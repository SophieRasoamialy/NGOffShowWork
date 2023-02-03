@extends('layouts.app')

@section('content')
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
                            <div class="d-flex align-items-center mb-3 pb-1 w-32 mx-auto">
                                <img src="{{asset('/storage/images/logoL.png')}}" alt="NGOFFSHOW">
                            </div>

                            <div class="card-body">
                                {{ __('Please confirm your password before continuing.') }}

                                <form method="POST" action="{{ route('password.confirm') }}">
                                    @csrf

                                    <div class="row ">

                                        <div class="">
                                            <input id="password" type="password" class=" @error('password') is-invalid @enderror
                                            form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
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
                                            <button class="mt-3 text-lg font-semibold 
                                                bg-gray-800 w-full text-white rounded-lg
                                                px-6 py-3 block shadow-xl hover:text-white hover:bg-black form-control" type="submit">
                                                {{ __('Confirm Password') }}
                                            </button>

                                            @if (Route::has('password.request'))
                                                <a class="btn btn-link" href="{{ route('password.request') }}">
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
