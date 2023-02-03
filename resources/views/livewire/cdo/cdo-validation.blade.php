<div>
<div class="flex m-3">
    
<div class="mx-5 shadow-lg p-5">


    <p class="text-center text-base font-normal mb-3 text-gray-500">Pour pouvoir uploader vos projets basic ou premium dans ce plateforme,vous devez vous abonner.</p>
    <h5 class="text-center text-base mb-3 text-gray-600 font-bold">Choissez votre mode de paiement  </h5>
    <div class="flex items-center justify-center mt-3">
        <div class="flex  ">
            {{--<div class="bg-white border w-28 h-28">
               <a href="#" wire:click = "payer()" class=""><!--avec comme parametre mode de paiemement et iscdopremium, et dans la fonction il faut si ispreium exite et envooer un boite de dialogue de choix entre basic et premium-->
                <img src="{{asset('/storage/images/visa.png')}}" alt="">
               </a> 
            </div >--}}
            <input type="hidden" wire:model = "ispremium">

            <div class="bg-white border w-28 h-28">
                <a href="#" wire:click = "choisir('Mvola','mvola')" class="">
                <img src="{{asset('/storage/images/telma.jpeg')}}" alt="">
                </a>
            </div>
            <div class="bg-white border w-28 h-28">
                <a href="#" wire:click = "choisir('Orange Money','orange')" class="">
                <img src="{{asset('/storage/images/orange.png')}}" alt="" class=" mt-3">
                </a>
            </div>
            <div class="bg-white border w-28 h-28">
               <a href="#" wire:click = "choisir('Airtel Money','airtel')" class="">
                <img src="{{asset('/storage/images/airtel.png')}}" alt="">
               </a>
            </div>
        </div>
    </div>
</div>

</div>
@if(!is_null($mode_paiement))
<div class=" w-1/2 bg-white my-5 mx-auto shadow-lg">
    <p class="text-base text-gray-600 text-center m-2 font-bold"> Vous devez payer {{$montant}} Ar @if($ispremium)pour devenir client premium @else pour être un client basique @endif</p>
    <div class=" p-4 flex  rounded-lg md:p-8 " >
        <div class=" bg-white border w-28 h-28">
             <img src="{{asset('/storage/images/'.$image_name)}}" class="m-auto" alt="">
         </div >
         <div class="mx-5" >
            @if($numero!="aucun pour le moment")
            <p class="text-gray-800">Voici le numéro pour l'envoyer: <span>{{$numero}}</span></p>
            <p class="text-gray-900">Veuiller envoyer ici la référence du transfert.</p>
            <form wire:submit.prevent = "payer()">   
                <div class="relative my-2">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    </div>
                    <input type="hidden" wire:model = "ispremium">
                    <input type="text" id="reference" wire:model.defer= "reference" class="block w-full p-4 pl-10 text-sm  border  rounded-lg    bg-gray-100 border-gray-600 text-gray-800 focus:ring-blue-500 focus:border-blue-500"  required>
                    @error('reference') <span class="text-red-500">{{$message}}</span>@enderror
                    <button type="submit" class="text-white absolute right-2.5 bottom-2.5   focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm px-4 py-2 bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Envoyer</button>
                </div>
            </form>
            @else
            <p class="text-gray-800">{{$numero}}</p>
            @endif

        </div>
    </div>
</div>
@endif
</div>