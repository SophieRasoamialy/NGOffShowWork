
<div>
    {{--Abonnement--}}
    {{--Pour les CDO--}}
    <div class="divide-y divide-gray-900 mb-3">
        <h3 class="text-gray-700  text-2xl"> Abonnement</h3>
        <p class="text-gray-300">
        </p>
    </div>
    <div class="flex mx-auto">
        <div class="p-4 my-2 mx-2 w-full max-w-sm bg-gray-100 rounded-lg border border-gray-200 shadow-md sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <h5 class="text-xl font-medium text-gray-900 dark:text-white"> Clients Basiques</h5>
            <div class=" ml-2">
                @if($updateMontantCDOBasic)
                    <input wire:model="montantCDOBasic"  onkeypress="verifier(event); return false;" id="montantCDOBasic"  wire:keydown.enter = "updateMontantCDOBasic" required  autofocus class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                    @error('montantCDOBasic') <span class="text-red-500">{{$message}}</span>@enderror

                @else
                    <div class="flex pt-2">
                        <div class="flex-1">
                            <label class="">Montant: </label>
                            <label class=" text-gray-600 "> {{$montantCDOBasic}} Ariary </label>
                        </div>
                        <div class="flex-1">
                            <button class=""  wire:click="editMontantCDOBasic()"><i class='bx bxs-pencil'></i></button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div  class="p-4 my-2 mr-2 w-full max-w-sm  bg-gray-100 rounded-lg border border-gray-200 shadow-md sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <h5 class="text-xl font-medium text-gray-900 dark:text-white">Clients Premium</h5>
            <div class=" ml-2">
                @if($updateMontantCDOPremium)
                    <input wire:model="montantCDOPremium"  onkeypress="verifier(event); return false;" id="montantCDOPremium"  wire:keydown.enter = "updateMontantCDOPremium" required  autofocus class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                    @error('montantCDOPremium') <span class="text-red-500">{{$message}}</span>@enderror    
                @else
                    <div class="flex pt-2">
                        <div class="flex-1">
                            <label class="">Montant: </label>
                            <label class=" text-gray-600 "> {{$montantCDOPremium}} Ariary </label>
                        </div>
                        <div class="flex-1">
                            <button class=""  wire:click="editMontantCDOPremium()"><i class='bx bxs-pencil'></i></button>
                        </div>
                    </div>
                @endif
            </div>
        </div>

    {{--Pour les developpeurs--}}
    
        <div class="p-4 my-2  w-full max-w-sm bg-gray-100 rounded-lg border border-gray-200 shadow-md sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <h5 class="text-xl font-medium text-gray-900 dark:text-white"> Développeurs Basiques</h5>
            <div class=" ml-2">
                @if($updateMontantDevBasic)
                    <input wire:model="montantDevBasic"  onkeypress="verifier(event); return false;" id="montantDevBasic"  wire:keydown.enter = "updateMontantDevBasic" required  autofocus class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                    @error('montantDevBasic') <span class="text-red-500">{{$message}}</span>@enderror    
                @else
                    <div class="flex pt-2">
                        <div class="flex-1">
                            <label class="">Montant: </label>
                            <label class=" text-gray-600 "> {{$montantDevBasic}} Ariary </label>
                        </div>
                        <div class="flex-1">
                            <button class=""  wire:click="editMontantDevBasic()"><i class='bx bxs-pencil'></i></button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div  class="p-4 m-2 w-full max-w-sm  bg-gray-100 rounded-lg border border-gray-200 shadow-md sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <h5 class="text-xl font-medium text-gray-900 dark:text-white">Développeurs Premium</h5>
            <div class=" ml-2">
                @if($updateMontantDevPremium)
                    <input wire:model="montantDevPremium"  onkeypress="verifier(event); return false;" id="montantDevPremium"  wire:keydown.enter = "updateMontantDevPremium" required  autofocus class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                    @error('montantdevPremium') <span class="text-red-500">{{$message}}</span>@enderror       
                @else
                    <div class="flex pt-2">
                        <div class="flex-1">
                            <label class="">Montant: </label>
                            <label class=" text-gray-600 "> {{$montantDevPremium}} Ariary </label>
                        </div>
                        <div class="flex-1">
                            <button class=""  wire:click="editMontantDevPremium()"><i class='bx bxs-pencil'></i></button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{--CONTACT--}}
    <div class="divide-y divide-gray-900 mb-3">
        <h3 class="text-gray-700  text-2xl"> Contact</h3>
        <p class="text-gray-300">
        </p>
    </div> 
    <div class="flex mw-auto ">
        <div class="p-4 m-2  w-full max-w-sm bg-gray-100 rounded-lg border border-gray-200 shadow-md sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <h5 class="text-xl font-medium  dark:text-white text-green-700">MVola</h5>
            <div class=" ml-2">
                @if($updateMvola)
                    <input wire:model="mvola"  onkeypress="verifier(event); return false;" id="mvola"  wire:keydown.enter = "updateMvola" required   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                    @error('mvola') <span class="text-red-500">{{$message}}</span>@enderror    
                @else
                    <div class="flex pt-2">
                        <div class="flex-1">
                            <label class=" text-gray-700 "> {{$mvola}}  </label>
                        </div>
                        <div class="flex-1">
                            <button class=""  wire:click="editMvola"><i class='bx bxs-pencil'></i></button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="p-4 m-2  w-full max-w-sm bg-gray-100 rounded-lg border border-gray-200 shadow-md sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <h5 class="text-xl font-medium text-orange-700 dark:text-white" style="color: #f97316">Orange Money</h5>
            <div class=" ml-2">
                @if($updateOrange)
                    <input wire:model="orange"  onkeypress="verifier(event); return false;" id="orange"  wire:keydown.enter = "updateOrange" required  autofocus class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                    @error('orange') <span class="text-red-500">{{$message}}</span>@enderror    
                @else
                    <div class="flex pt-2">
                        <div class="flex-1">
                            <label class=" text-gray-700 "> {{$orange}} </label>
                        </div>
                        <div class="flex-1">
                            <button class=""  wire:click="editOrange"><i class='bx bxs-pencil'></i></button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="p-4 m-2  w-full max-w-sm bg-gray-100 rounded-lg border border-gray-200 shadow-md sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <h5 class="text-xl font-medium text-red-700 dark:text-white">Aitel Money</h5>
            <div class=" ml-2">
                @if($updateAirtel)
                    <input wire:model="airtel"  onkeypress="verifier(event); return false;" id="airtel"  wire:keydown.enter = "updateAirtel" required  autofocus class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                    @error('airtel') <span class="text-red-500">{{$message}}</span>@enderror    
                @else
                    <div class="flex pt-2">
                        <div class="flex-1">
                            <label class=" text-gray-700 "> {{$airtel}}  </label>
                        </div>
                        <div class="flex-1">
                            <button class=""  wire:click="editAirtel()"><i class='bx bxs-pencil'></i></button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{--Budget et durée minimal
    <div class="divide-y divide-gray-900 mb-3">
        <h3 class="text-gray-700  text-2xl"> Budget et Durée pour un projet premium</h3>
        <p class="text-gray-300">
        </p>
    </div> 
    <div class="flex mw-auto ">
        <div class="p-4 m-2  w-full max-w-sm bg-gray-100 rounded-lg border border-gray-200 shadow-md sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <h5 class="text-xl font-medium  dark:text-white text-gray-700">Budget minimal </h5>
            <div class=" ml-2">
                @if($updateBudget_min)
                    <input wire:model="budget_premium_min"  onkeypress="verifier(event); return false;" id="budget_min"  wire:keydown.enter = "updateBudgetPremiumMin" required   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                    @error('budget_premium_min') <span class="text-red-500">{{$message}}</span>@enderror    
                @else
                    <div class="flex pt-2">
                        <div class="flex-1">
                            <label class=" text-gray-700 "> {{$budget_premium_min}}  </label>
                        </div>
                        <div class="flex-1">
                            <button class=""  wire:click="editBudgetMin"><i class='bx bxs-pencil'></i></button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        
        <div class="p-4 m-2  w-full max-w-sm bg-gray-100 rounded-lg border border-gray-200 shadow-md sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <h5 class="text-xl font-medium text-gray-700 dark:text-white">Durée minimale </h5>
            <div class=" ml-2">
                @if($updateDuree_min)
                    <input wire:model="duree_premium_min"  onkeypress="verifier(event); return false;" id="duree_premium_min"  wire:keydown.enter = "updateDureePremiumMin" required  autofocus class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                    @error('duree_premium_min') <span class="text-red-500">{{$message}}</span>@enderror    
                @else
                    <div class="flex pt-2">
                        <div class="flex-1">
                            <label class=" text-gray-700 "> {{$duree_premium_min}}  </label>
                        </div>
                        <div class="flex-1">
                            <button class=""  wire:click="editDureeMin"><i class='bx bxs-pencil'></i></button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
--}}
    {{--Comission de NGA--}}
    <div class="divide-y divide-gray-900 mb-3">
        <h3 class="text-gray-700  text-2xl"> Commission de NGA</h3>
        <p class="text-gray-300">
        </p>
    </div> 
    <div class="flex mw-auto ">
        <div class="p-4 m-2  w-full max-w-sm bg-gray-100 rounded-lg border border-gray-200 shadow-md sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <h5 class="text-xl font-medium  dark:text-white text-gray-700">Pourcentage pour les projets premium </h5>
            <div class=" ml-2">
                @if($updateCommission_premium)
                    <input wire:model="commission_premium"  onkeypress="verifier(event); return false;" id="commission_premium"  wire:keydown.enter = "updateCommissionPremium" required   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                    @error('commission_premium') <span class="text-red-500">{{$message}}</span>@enderror    
                @else
                    <div class="flex pt-2">
                        <div class="flex-1">
                            <label class=" text-gray-700 "> {{$commission_premium}}  %</label>
                        </div>
                        <div class="flex-1">
                            <button class=""  wire:click="editCommissionPremium"><i class='bx bxs-pencil'></i></button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        
        <div class="p-4 m-2  w-full max-w-sm bg-gray-100 rounded-lg border border-gray-200 shadow-md sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <h5 class="text-xl font-medium text-gray-700 dark:text-white">Pourcentage pour les projets basiques </h5>
            <div class=" ml-2">
                @if($updateCommission_basique)
                    <input wire:model="commission_basique"  onkeypress="verifier(event); return false;" id="commission_basique"  wire:keydown.enter = "updateCommissionBasique" required  autofocus class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                    @error('commission_basique') <span class="text-red-500">{{$message}}</span>@enderror    
                @else
                    <div class="flex pt-2">
                        <div class="flex-1">
                            <label class=" text-gray-700 "> {{$commission_basique}} % </label>
                        </div>
                        <div class="flex-1">
                            <button class=""  wire:click="editCommissionBasique"><i class='bx bxs-pencil'></i></button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<script>
     function verifier(event) 
    {
        var keyCode = event.which ? event.which : event.keyCode;
        var touche = String.fromCharCode(keyCode);
                
                
        var caracteres = '0123456789';
                
        if(caracteres.indexOf(touche) >= 0) {
            document.getElmentById('montant').value += touche;
        }
    }
</script>
