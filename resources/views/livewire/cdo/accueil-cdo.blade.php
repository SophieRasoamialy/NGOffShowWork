<div>
@if($ispaye)
<div>
    <h4 class="text-center my-5 text-lg text-green-800 ">Demande d'être client {{$type}} en attente</h4>
</div>
@else
<div>
    <h4 class="text-center my-5 text-lg text-green-800 ">Vous devez au moins être un client basic pour pouvoir participer</h4>
<div class="flex justify-center items-center">
    
    @if($cdo_isvalide == 0 )
    <!--developpeur Basic-->
    <div class=" transform  transition duration-500 hover:scale-110 w-full max-w-sm p-4 border rounded-lg shadow-md sm:p-8 bg-gray-200 border-gray-400">
        <h5 class="mb-4 text-xl font-medium text-gray-800">Client Basic</h5>
        <div class="flex items-baseline text-black">
            <span class="text-3xl font-semibold">Ar</span>
            <span class="text-5xl font-extrabold tracking-tight">{{$montantCDOBasique}}</span>
            <span class="ml-1 text-xl font-normal ext-gray-400">/mois</span>
        </div>
        <div class="text-base font-normal leading-tight text-gray-800 p-5">
            En mode basic, vous pouvez uploder des projets basiques mais seulement les developpeurs basiques aussi qui auront accès à votre projet.
        </div>
        <button wire:click ="redirection(0)" class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
            Je veux être Client Basic
        </button>

     </div>
     @endif


    <!--Developeur premium-->
    <div class=" transform  transition duration-500 hover:scale-110 mx-3 w-full max-w-sm p-4 border rounded-lg shadow-md sm:p-8 bg-gray-200 border-gray-400">
        <h5 class="mb-4 text-xl font-medium text-gray-800">Client Premium</h5>
        <div class="flex items-baseline text-black">
            <span class="text-3xl font-semibold">Ar</span>
            <span class="text-5xl font-extrabold tracking-tight"> {{$montantCDOPremium}} </span>
            <span class="ml-1 text-xl font-normal ext-gray-400">/mois</span>
        </div>
        <div class="text-base font-normal leading-tight text-gray-800 px-4 py-5">
            En mode premium, vous pouvez uploder des projets  premiums  et ce sont developpeurs plus compétents et plus expérimentés qui réaliseront vos projets.
        </div>
        <button wire:click ="redirection(1)" class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
            Je veux devenir Premium
        </button>

    </div>
    
</div>
</div>
@endif
</div>