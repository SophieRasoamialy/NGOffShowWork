
<body>
    @if($commencer_click == true)
        @if(App\Models\Developpeur::where('user_id', Auth::user()->id)->exists())
            @php
                redirect()->to('/projets'); 
            @endphp
        @else
            @php
                redirect()->to('/liste_projet');
            @endphp
        @endif
    @endif
    <div class="h-screen" style="background-image: url('{{asset('/storage/images/welcome.jpg')}}'); background-size:100%">
        <div class="grid place-items-center">
            <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
            <lottie-player src="https://assets3.lottiefiles.com/packages/lf20_PDb8hq.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"    autoplay></lottie-player>
        </div>
        <div class="grid place-items-center ">
            <h1 class="mb-6 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Merci de joindre à nous</h1>
            <p class="mb-6 text-lg text-center font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">Ici vous pouvez déposer votre projet et des centaines de developpeurs vont les réaliser. </p>
            <button type="button" wire:click = "redirection" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                Commencer
                <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
        </div>
 
    </div>

</body>
