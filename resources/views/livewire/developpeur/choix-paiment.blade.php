<div class="grid  place-items-center">
    <h2 class="text-center text-white my-3">Paiement de {{$montant}} Ariary / mois</h2>

  {{--  <div class="mt-3 grid place-items-center ">
        <div class="bg-white border w-28 h-28 ">
            <a href="#" wire:click = "payer()" class="">
             <img src="{{asset('/storage/images/visa.png')}}" alt="">
            </a> 
         </div >
         <div>
        <a  wire:click = 'abonnement' class="relative inline-flex items-center justify-center p-0.5 m-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white text-white focus:ring-4 focus:outline-none focus:ring-blue-800">
            <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-gray-900 rounded-md group-hover:bg-opacity-0">
                Paiement par carte
            </span>
        </a>
         </div>
          
    </div>
    <label class="text-gray-200" for="">Ou par mobile money</label>--}}

<div class="w-1/2  border rounded-lg shadow-md bg-gray-700 border-gray-600">
    <div class="sm:hidden">
        <label for="tabs" class="sr-only">Select tab</label>
        <select id="tabs" class=" border-0 border-b  text-sm rounded-t-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
            <option>Mvola</option>
            <option>Orange Money</option>
            <option>Airtel Money</option>
        </select>
    </div>
    <ul class="hidden text-sm font-medium text-center  divide-x  rounded-lg sm:flex divide-gray-600 text-gray-400" id="fullWidthTab" data-tabs-toggle="#fullWidthTabContent" role="tablist">
        <li class="w-full">
            <button id="stats-tab" data-tabs-target="#stats" type="button" role="tab" aria-controls="stats" aria-selected="true" class="inline-block w-full p-4 text-green-500 rounded-tl-lg  focus:outline-none bg-gray-700 hover:bg-gray-500" style="color: #22c55e">Mvola</button>
        </li>
        <li class="w-full">
            <button id="about-tab" data-tabs-target="#about" type="button" role="tab" aria-controls="about" aria-selected="false" class="inline-block w-full p-4 text-orange-400 focus:outline-none bg-gray-700 hover:bg-gray-500" style="color: #fb923c">Orange</button>
        </li>
        <li class="w-full">
            <button id="faq-tab" data-tabs-target="#faq" type="button" role="tab" aria-controls="faq" aria-selected="false" class="inline-block w-full p-4 text-red-500 rounded-tr-lg focus:outline-none bg-gray-700 hover:bg-gray-500" style="color: #ef4444">Airtel</button>
        </li>
    </ul>
    <div id="fullWidthTabContent" class="  border-t border-gray-600">
        <!--TELMA-->
        <div class="hidden p-4 flex rounded-lg md:p-8 bg-gray-800" id="stats" role="tabpanel" aria-labelledby="stats-tab">
            <div class="bg-white border w-28 h-28">
                 <img src="{{asset('/storage/images/telma.jpeg')}}" alt="">
                 
             </div > 
             <div class="mx-5" >
                @if($mvola == "aucun pour le momment")
                    <p class="text-gray-300">{{$mvola}}</p>
                @else
                <p class="text-gray-300">Voici le numéro pour l'envoyer: <span>{{$mvola}}</span></p>
                <p class="text-gray-300">Veuiller envoyer ici la référence du transfert.</p>
                @php
                    $mode = "Mvola";
                @endphp
                <form wire:submit.prevent = "payer('{{$mode}}')">   
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        </div>
                        <input type="hidden" wire:model = "ispremium_val">
                        <input type="text" id="reference" wire:model.defer = "reference" class="block w-full p-4 pl-10 text-sm  border  rounded-lg bg-gray-50   bg-gray-700 border-gray-600 text-white focus:ring-blue-500 focus:border-blue-500"  required>
                        @error('reference') <span class="text-red-500">{{$message}}</span>@enderror    
                        <button type="submit" class="text-white absolute right-2.5 bottom-2.5   focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm px-4 py-2 bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Envoyer</button>
                    </div>
                </form>
                @endif
            </div>
        </div>
        <!--ORANGE-->
        <div class="hidden p-4 flex rounded-lg md:p-8 bg-gray-800" id="about" role="tabpanel" aria-labelledby="about-tab">
            <div class="  bg-white border w-28 h-28">
                 <img src="{{asset('/storage/images/orange.png')}}" alt="" class="mt-3">
                
             </div >
             <div class="mx-5" >
                @if($orange == "aucun pour le momment")
                   <p class="text-gray-300">{{$orange}}</p> 
                @else
                <p class="text-gray-300">Voici le numéro pour l'envoyer: <span>{{$orange}}</span></p>
                <p class="text-gray-300">Veuiller envoyer ici la référence du transfert.</p>
                <form wire:submit.prevent = "payer('Orange Money')">   
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        </div>
                        <input type="hidden" wire:model = "ispremium_val">
                        <input type="text" id="reference" wire:model.defer = "reference" class="block w-full p-4 pl-10 text-sm  border  rounded-lg bg-gray-50   bg-gray-700 border-gray-600 text-white focus:ring-blue-500 focus:border-blue-500"  required>
                        @error('reference') <span class="text-red-500">{{$message}}</span>@enderror
                        <button type="submit" class="text-white absolute right-2.5 bottom-2.5   focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm px-4 py-2 bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Envoyer</button>
                    </div>
                </form>
                @endif
            </div>
        </div>
        <!--AIRTEL-->
        <div class="hidden p-4 flex  rounded-lg md:p-8 bg-gray-800" id="faq" role="tabpanel" aria-labelledby="faq-tab">
            <div class=" bg-white border w-28 h-28">
                 <img src="{{asset('/storage/images/airtel.png')}}" alt="">
             </div >
             <div class="mx-5" >
                @if($airtel!="aucun pour le momment")
                <p class="text-gray-300">Voici le numéro pour l'envoyer: <span>{{$airtel}}</span></p>
                <p class="text-gray-300">Veuiller envoyer ici la référence du transfert.</p>
                <form wire:submit.prevent = "payer('Airtel Money')">   
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        </div>
                        <input type="hidden" wire:model = "ispremium_val">
                        <input type="text" id="reference" wire:model.defer= "reference" class="block w-full p-4 pl-10 text-sm  border  rounded-lg bg-gray-50   bg-gray-700 border-gray-600 text-white focus:ring-blue-500 focus:border-blue-500"  required>
                        @error('reference') <span class="text-red-500">{{$message}}</span>@enderror
                        <button type="submit" class="text-white absolute right-2.5 bottom-2.5   focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm px-4 py-2 bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Envoyer</button>
                    </div>
                </form>
                @else
                <p class="text-gray-300">{{$airtel}}</p>
                @endif
    
            </div>
        </div>
    </div>
</div>

</div>
