<div>
    <style>
        #tableau table, #tableau table th, #tableau table td {
            border: solid 1px;
        }
        #tableau table th, #tableau table td {
            padding: 10px;
            text-align: justify;
            font-size: 18px !important;
            font-family: sans-serif !important;

        }
        #description{
            font-size: 15px !important;
            font-family: 'Nunito', sans-serif !important;
        }
    </style>
    <div>
        <div class="row">
            <div class=" col-md-4   my-2 float-left ">
                <button type="button"  class=" flex text-green-700 hover:text-white border-2 border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 "
                wire:click = "redirectFormulaire" >Créer un nouveau projet </button>
            </div>
        </div>
        <div class="row mt-4 mb-4">
                <div class="col-6">
                    <label for="categorieValue">Catégorie</label>
                    <select wire:model = "categorieValue" class="inline-flex items-center text-gray-500 bg-white border border-gray-300 w-1/3 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                        <option value="0">Tout categorie</option>
                        @foreach($categorie as $categorie)
                        <option value="{{$categorie->categorie_id}}">{{$categorie->categorie_label}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-2">

                </div>
                <div class="col-4">
                    <div class="float-right ">
                        <input wire:model="search" class="block p-2 pl-10 w-80 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" placeholder="Rechercher des projets ...">
                    </div>
                </div>
        </div>
        
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                <li class="mr-2" role="presentation">
                    <button  class="inline-block p-4 rounded-t-lg border-b-2" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Tous les projets ({{$nbre_total_projet}})</button>
                </li>
                <li class="mr-2" role="presentation">
                    <button  class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Projets En Cours ({{$nbre_projet_encours}})</button>
                </li>
                <li class="mr-2" role="presentation">
                    <button  class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Projet Terminé ({{$nbre_projet_termine}})</button>
                </li>
                @if($cdo_premium != 0) 
                <li class="mr-2" role="presentation">
                    <button  class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="premium-tab" data-tabs-target="#premium" type="button" role="tab" aria-controls="premium" aria-selected="false">Projets Premium ({{$nbre_projet_premium}})</button>
                </li>
                <li class="mr-2" role="presentation">
                    <button  class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="basic-tab" data-tabs-target="#basic" type="button" role="tab" aria-controls="basic" aria-selected="false">Projet Basic ({{$nbre_projet_basic}})</button>
                </li>
                @endif
                
            </ul>
        </div>
        <div id="myTabContent" >
           <!--Tous les projets-->
            <div class="hidden p-4 " id="profile" role="tabpanel" aria-labelledby="profile-tab" wire:ignore.self>
                <div class="  shadow-lg sm:rounded-lg">
                   
                    <table class=" text-sm   ">
                        <thead class="text-xs text-base text-center text-gray-700 uppercase bg-gray-300 ">
                            <tr> 
                                <th  class="py-3 px-6">Cahier de charge</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($projets as $projet1)
                            <tr class="bg-white border-b text-justify "  id="tableau">
                                <td class=" ">
                                    <dl class="py-4 px-3" >
                                        <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                            <dt class="text-sm font-medium text-gray-500">Titre</dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ $projet1->projet_titre }}</dd>
                                        </div>
                                        <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                            <dt class="text-sm font-medium text-gray-500">Catégorie</dt>
                                            @php
                                                $categorie = App\Models\Categorie::where('categorie_id',$projet1->categorie_id)->first();
                                            @endphp
                                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{$categorie->categorie_label}} </dd>
                                        </div>
                                        <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                            <dt class="text-sm font-medium text-gray-500">Budget</dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{$projet1->projet_budget}} Ariary</dd>
                                        </div>
                                        <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                            <dt class="text-sm font-medium text-gray-500">Deadline</dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{$projet1->projet_date_fin}} </dd>
                                        </div>
                                        <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                            <dt class="text-sm font-medium text-gray-500">Validé</dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                                @if( $projet1->projet_isvalide ==1)
                                                    Oui
                                                @else
                                                    Non
                                                @endif
                                             </dd>
                                        </div>
                                        <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                            <dt class="text-sm font-medium text-gray-500">Etat</dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                                @if( $projet1->projet_date_fin < now()->setTimezone('Turkey'))
                                                    Terminé
                                                @else
                                                    En cours
                                                @endif
                                             </dd>
                                        </div>
                                        @if ($cdo_premium != 0)
                                        <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                            <dt class="text-sm font-medium text-gray-500">Premium</dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">

                                                @if ($projet1->projet_premium == 0)
                                                    Non
                                                @else
                                                    Oui
                                                @endif
                                      
                                             </dd>
                                        </div>
                                        @endif
                                        <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                            <dt class="text-sm font-medium text-gray-500">Description</dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0" id="description">
                                                <p>
                                                @php
                                                    echo $projet1->projet_description
                                                @endphp
                                                </p>
                                            </dd>
                                        </div>
                                        @can('admin')
                                        <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                            <dt class="text-sm font-medium text-gray-500">Propriétaire</dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                                @php
                                                    $user = App\Models\User::where('id',$projet1->created_by)->first();
                                                @endphp
                                                {{$user->name}}
                                            </dd>
                                        </div>
                                        @endcan
                                        <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                            <dt class="text-sm font-medium text-gray-500">Action</dt>
                                            <dd class=" flex mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                                <button type="button" wire:click="edit({{ $projet1->projet_id }})" class=" flex text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2" >
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                                    </svg>
                                                    
                                                    <span class="ml-1">Modifier</span>
                                                </button>
                                                <button type="button" onclick="confirm_delete({{$projet1->projet_id}})" class=" flex text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                    </svg>
                                                    <span class="ml-1">Supprimer</span>
                                                </button>
                                                @if($projet1->projet_isvalide !=1)
                                                    @can('admin')
                                                    <button type="button" wire:click.prevent = 'valider({{$projet1->projet_id}})' class=" flex text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                                          </svg>                                                          
                                                        <span class="ml-1">Valider</span>
                                                    </button>
                                                    @endcan
                                                @else
                                                @can('admin')
                                                    <button type="button" onclick="invalider({{$projet1->projet_id }})"  class=" flex text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                          </svg>                                                                                                                   
                                                        <span class="ml-1">Annuler validation</span>
                                                    </button>
                                                    @endcan
                                                @endif
                                            </dd>
                                        </div>
                                    </dl> 
                                </td>
                                
                            </tr>

                            @endforeach
                        </tbody>
                    </table> 
                </div>

                <div class="d-flex pt-0 pt-2 border-primary justify-content-center" >
                    {{$projets->links()}}
                </div>

            </div>
            <!--Tous les projets en cours-->
            <div class="hidden p-4 bg-gray-50 rounded-lg dark:bg-gray-800" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab" wire:ignore.self>
               
                <div class="  shadow-lg sm:rounded-lg">
                    
                    <table class=" text-sm text-justify ">
                        <thead class="text-xs text-base text-center text-gray-700 uppercase bg-gray-300 ">
                            <tr> 
                                <th  class="py-3 px-6 ">Cahier de charge</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($projets_encours as $projet)
                            <tr class="bg-white border-b " id="tableau">
                                <td class=" ">
                                    <dl class="py-4 px-3" >
                                        <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                            <dt class="text-sm font-medium text-gray-500">Titre</dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ $projet->projet_titre }}</dd>
                                        </div>
                                        <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                            <dt class="text-sm font-medium text-gray-500">Catégorie</dt>
                                            @php
                                                $categorie = App\Models\Categorie::where('categorie_id',$projet->categorie_id)->first();
                                            @endphp
                                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{$categorie->categorie_label}} </dd>
                                        </div>
                                        <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                            <dt class="text-sm font-medium text-gray-500">Budget</dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{$projet->projet_budget}} Ariary</dd>
                                        </div>
                                        <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                            <dt class="text-sm font-medium text-gray-500">Deadline</dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{$projet->projet_date_fin}} </dd>
                                        </div>
                                        <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                            <dt class="text-sm font-medium text-gray-500">Etat</dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                                @if( $projet->projet_date_fin < now())
                                                    Terminé
                                                @else
                                                    En cours
                                                @endif
                                             </dd>
                                        </div>
                                        @if ($cdo_premium != 0)
                                        <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                            <dt class="text-sm font-medium text-gray-500">Premium</dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">

                                                @if ($projet->projet_premium == 0)
                                                    Non
                                                @else
                                                    Oui
                                                @endif
                                      
                                             </dd>
                                        </div>
                                        @endif
                                        <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                            <dt class="text-sm font-medium text-gray-500">Description</dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                                @php
                                                    echo $projet->projet_description
                                                @endphp
                                                 <br>
                                                @can('admin')
                                                @php
                                                    $user = App\Models\User::where('id',$projet->created_by)->first();
                                                @endphp
                                                <span class="text-green-600">Projet créé par {{$user->name}}</span>
                                            @endcan
                                            </dd>
                                        </div>
                                        @can('admin')
                                        <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                            <dt class="text-sm font-medium text-gray-500">Propriétaire</dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                                @php
                                                    $user = App\Models\User::where('id',$projet->created_by)->first();
                                                @endphp
                                                {{$user->name}}
                                            </dd>
                                        </div>
                                        @endcan
                                        <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                            <dt class="text-sm font-medium text-gray-500">Action</dt>
                                            <dd class=" flex mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                                <button type="button" wire:click.prevent="edit({{ $projet->projet_id }})" class=" flex text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2" >
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                                    </svg>
                                                    
                                                    <span class="ml-1">Modifier</span>
                                                </button>
                                                <button type="button" onclick="confirm_delete({{$projet->projet_id}}) " class=" flex text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                    </svg>
                                                    <span class="ml-1">Supprimer</span>
                                                </button>
                                                @if( $projet->projet_isvalide !=1)
                                                    @can('admin')
                                                    <button type="button" wire:click.prevent = 'valider({{$projet->projet_id}})' class=" flex text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                                          </svg>                                                          
                                                        <span class="ml-1">Valider</span>
                                                    </button>
                                                    @endcan
                                                @else
                                                @can('admin')
                                                    <button type="button" onclick="invalider({{ $projet->projet_id }})"  class=" flex text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                          </svg>                                                                                                                   
                                                        <span class="ml-1">Annuler validation</span>
                                                    </button>
                                                    @endcan
                                                @endif
                                            </dd>
                                        </div>
                                    </dl> 
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table> 
                </div>



                <div class="d-flex pt-0 pt-2 border-primary justify-content-center">
                    {{$projets_encours->links()}}
                </div>

            </div>

                       <!--Tous les projets terminés-->
            <div class="hidden p-4 bg-gray-50 rounded-lg dark:bg-gray-800" id="settings" role="tabpanel" aria-labelledby="settings-tab" wire:ignore.self>
                <div class="  shadow-lg sm:rounded-lg">
                    
                    <table class=" text-sm text-justify  dark:text-gray-400">
                        <thead class="text-xs text-base text-center text-gray-700 uppercase bg-gray-300 ">
                            <tr> 
                                <th  class="py-3 px-6  ">Cahier de charge</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($projets_termine as $projet)
                            <tr class="bg-white border-b " id="tableau">
                                <td class=" ">
                                    <dl class="py-4 px-3" >
                                        <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                            <dt class="text-sm font-medium text-gray-500">Titre</dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ $projet->projet_titre }}</dd>
                                        </div>
                                        <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                            <dt class="text-sm font-medium text-gray-500">Catégorie</dt>
                                            @php
                                                $categorie = App\Models\Categorie::where('categorie_id',$projet->categorie_id)->first();
                                            @endphp
                                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{$categorie->categorie_label}} </dd>
                                        </div>
                                        <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                            <dt class="text-sm font-medium text-gray-500">Budget</dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{$projet->projet_budget}} Ariary</dd>
                                        </div>
                                        <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                            <dt class="text-sm font-medium text-gray-500">Deadline</dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{$projet->projet_date_fin}} </dd>
                                        </div>
                                        <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                            <dt class="text-sm font-medium text-gray-500">Etat</dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                                @if( $projet->projet_date_fin < now())
                                                    Terminé
                                                @else
                                                    En cours
                                                @endif
                                             </dd>
                                        </div>
                                        @if ($cdo_premium != 0)
                                        <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                            <dt class="text-sm font-medium text-gray-500">Premium</dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">

                                                @if ($projet->projet_premium == 0)
                                                    Non
                                                @else
                                                    Oui
                                                @endif
                                      
                                             </dd>
                                        </div>
                                        @endif
                                        <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                            <dt class="text-sm font-medium text-gray-500">Description</dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                                @php
                                                    echo $projet->projet_description
                                                @endphp
                                                 <br>
                                                @can('admin')
                                                @php
                                                    $user = App\Models\User::where('id',$projet->created_by)->first();
                                                @endphp
                                                <span class="text-green-600">Projet créé par {{$user->name}}</span>
                                            @endcan
                                            </dd>
                                        </div>
                                        @can('admin')
                                        <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                            <dt class="text-sm font-medium text-gray-500">Propriétaire</dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                                @php
                                                    $user = App\Models\User::where('id',$projet->created_by)->first();
                                                @endphp
                                                {{$user->name}}
                                            </dd>
                                        </div>
                                        @endcan
                                        <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                            <dt class="text-sm font-medium text-gray-500">Action</dt>
                                            <dd class=" flex mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                                <button type="button" wire:click.prevent="edit({{ $projet->projet_id }})" class=" flex text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2" >
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                                    </svg>
                                                    
                                                    <span class="ml-1">Modifier</span>
                                                </button>
                                                <button type="button" onclick="confirm_delete({{$projet->projet_id}}) " class=" flex text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                    </svg>
                                                    <span class="ml-1">Supprimer</span>
                                                </button>
                                                
                                            </dd>
                                        </div>
                                    </dl> 
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table> 
                </div>



                <div class="d-flex pt-0 pt-2 border-primary justify-content-center">
                    {{$projets_termine->links()}}
                </div>

            </div>

          @if($cdo_premium != 0) 
            <!--Tous les projets premium-->
            <div class="hidden p-4 bg-gray-50 rounded-lg dark:bg-gray-800" id="premium" role="tabpanel" aria-labelledby="premium-tab" wire:ignore.self>
            <div class="  shadow-lg sm:rounded-lg">
                <table class=" text-sm text-justify  dark:text-gray-400">
                    <thead class="text-xs text-base text-center text-gray-700 uppercase bg-gray-300 ">
                        <tr> 
                            <th  class="py-3 px-6">Cahier de charge</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projets_premium as $projet)
                        <tr class="bg-white border-b " id="tableau">
                            <td class=" ">
                                <dl class="py-4 px-3" >
                                    <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Titre</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ $projet->projet_titre }}</dd>
                                    </div>
                                    <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Catégorie</dt>
                                        @php
                                            $categorie = App\Models\Categorie::where('categorie_id',$projet->categorie_id)->first();
                                        @endphp
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{$categorie->categorie_label}} </dd>
                                    </div>
                                    <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Budget</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{$projet->projet_budget}} Ariary</dd>
                                    </div>
                                    <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Deadline</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{$projet->projet_date_fin}} </dd>
                                    </div>
                                    <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Etat</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                            @if( $projet->projet_date_fin < now())
                                                Terminé
                                            @else
                                                En cours
                                            @endif
                                         </dd>
                                    </div>
                                    @if ($cdo_premium != 0)
                                    <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Premium</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">

                                            @if ($projet->projet_premium == 0)
                                                Non
                                            @else
                                                Oui
                                            @endif
                                  
                                         </dd>
                                    </div>
                                    @endif
                                    <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Description</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                            @php
                                                echo $projet->projet_description
                                            @endphp
                                             <br>
                                            @can('admin')
                                            @php
                                                $user = App\Models\User::where('id',$projet->created_by)->first();
                                            @endphp
                                            <span class="text-green-600">Projet créé par {{$user->name}}</span>
                                        @endcan
                                        </dd>
                                    </div>
                                    @can('admin')
                                    <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Propriétaire</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                            @php
                                                $user = App\Models\User::where('id',$projet->created_by)->first();
                                            @endphp
                                            {{$user->name}}
                                        </dd>
                                    </div>
                                    @endcan
                                    <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Action</dt>
                                        <dd class=" flex mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                            <button type="button" wire:click.prevent="edit({{ $projet->projet_id }})" class=" flex text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2" >
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                                </svg>
                                                
                                                <span class="ml-1">Modifier</span>
                                            </button>
                                            <button type="button" onclick="confirm_delete({{$projet->projet_id}}) " class=" flex text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 ">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                                <span class="ml-1">Supprimer</span>
                                            </button>
                                            @if( $projet->projet_isvalide !=1)
                                                    @can('admin')
                                                    <button type="button" wire:click.prevent = 'valider({{$projet->projet_id}})' class=" flex text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                                          </svg>                                                          
                                                        <span class="ml-1">Valider</span>
                                                    </button>
                                                    @endcan
                                                @else
                                                @can('admin')
                                                    <button type="button" onclick="invalider({{ $projet->projet_id }})"  class=" flex text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                          </svg>                                                                                                                   
                                                        <span class="ml-1">Annuler validation</span>
                                                    </button>
                                                    @endcan
                                            @endif
                                        </dd>
                                    </div>
                                </dl> 
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table> 
            </div>



            <div class="d-flex pt-0 pt-2 border-primary justify-content-center">
                {{$projets_premium->links()}}
            </div>

        </div>
        
        <!--Tous les projets basic-->
        <div class="hidden p-4 bg-gray-50 rounded-lg dark:bg-gray-800" id="basic" role="tabpanel" aria-labelledby="basic-tab" wire:ignore.self>
            <div class="  shadow-lg sm:rounded-lg">
                
                <table class=" text-sm text-justify  dark:text-gray-400">
                    <thead class="text-xs text-base text-center text-gray-700 uppercase bg-gray-300 ">
                        <tr> 
                            <th  class="py-3 px-6">Cahier de charge</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projets_basic as $projet)
                        <tr class="bg-white border-b " id="tableau">
                            <td class=" ">
                                <dl class="py-4 px-3" >
                                    <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Titre</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ $projet->projet_titre }}</dd>
                                    </div>
                                    <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Catégorie</dt>
                                        @php
                                            $categorie = App\Models\Categorie::where('categorie_id',$projet->categorie_id)->first();
                                        @endphp
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{$categorie->categorie_label}} </dd>
                                    </div>
                                    <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Budget</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{$projet->projet_budget}} Ariary</dd>
                                    </div>
                                    <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Deadline</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{$projet->projet_date_fin}} </dd>
                                    </div>
                                    <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Etat</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                            @if( $projet->projet_date_fin < now())
                                                Terminé
                                            @else
                                                En cours
                                            @endif
                                         </dd>
                                    </div>
                                    @if ($cdo_premium != 0)
                                    <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Premium</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">

                                            @if ($projet->projet_premium == 0)
                                                Non
                                            @else
                                                Oui
                                            @endif
                                  
                                         </dd>
                                    </div>
                                    @endif
                                    <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Description</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                            @php
                                                echo $projet->projet_description
                                            @endphp
                                             <br>
                                            @can('admin')
                                            @php
                                                $user = App\Models\User::where('id',$projet->created_by)->first();
                                            @endphp
                                            <span class="text-green-600">Projet créé par {{$user->name}}</span>
                                        @endcan
                                        </dd>
                                    </div>
                                    @can('admin')
                                    <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Propriétaire</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                            @php
                                                $user = App\Models\User::where('id',$projet->created_by)->first();
                                            @endphp
                                            {{$user->name}}
                                        </dd>
                                    </div>
                                    @endcan
                                    <div class="bg-gray-50 px-2 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Action</dt>
                                        <dd class=" flex mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                            <button type="button" wire:click.prevent="edit({{ $projet->projet_id }})" class=" flex text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2" >
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                                </svg>
                                                
                                                <span class="ml-1">Modifier</span>
                                            </button>
                                            <button type="button" onclick="confirm_delete({{$projet->projet_id}}) " class=" flex text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 ">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                                <span class="ml-1">Supprimer</span>
                                            </button>
                                            @if( $projet->projet_isvalide !=1)
                                                    @can('admin')
                                                    <button type="button" wire:click.prevent = 'valider({{$projet->projet_id}})' class=" flex text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                                          </svg>                                                          
                                                        <span class="ml-1">Valider</span>
                                                    </button>
                                                    @endcan
                                                @else
                                                @can('admin')
                                                    <button type="button" onclick="invalider({{ $projet->projet_id }})"  class=" flex text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                          </svg>                                                                                                                   
                                                        <span class="ml-1">Annuler validation</span>
                                                    </button>
                                                    @endcan
                                                @endif
                                        </dd>
                                    </div>
                                </dl> 
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table> 
            </div>

            <div class="d-flex pt-0 pt-2 border-primary justify-content-center">
                {{$projets_basic->links()}}
            </div>

        </div>
        @endif
     </div>
            
    </div>



    <script>
        
        function show_form(projet_id)
        {
            Livewire.emit('recup_projet_id', projet_id);
        }

        function confirm_delete(projet_id)
        {
            Swal.fire({
            title: 'Vous êtes sûr de supprimer ce projet?',
            text: "Vous ne pourrez pas revenir en arrière!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: 'rgb(156 163 175)',
            confirmButtonText: 'Oui, supprimer!'
            }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emit('delete', projet_id)
                Swal.fire(
                    'Supprimé!',
                    'Le projet est supprimé avec succès.',
                    'success'
                )
            }
            
            });

        }

        function test()
        {
            alert('text');
        }
        
        function invalider(projet_id)
            { 
                Swal.fire({
                    input: 'textarea',
                    inputLabel: 'Motif',
                    inputPlaceholder: 'Entrer le motif d\'annulation ici...',
                    inputAttributes: {
                        'aria-label': 'Entrer le motif d\'annulation ici'
                    },
                    showCancelButton: true,
                    showCloseButton: true
                    }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.close) {
                        // code à exécuter lorsque la boîte de dialogue est fermée
                    } else if (result.value) {
                        // code à exécuter lorsque l'utilisateur clique sur le bouton OK
                        var text = result.value
                                Swal.fire(
                                'Annulé!',
                                'La validation du projet est annulée avec succes avec succès.',
                                'success'
                                )
                                
                                Livewire.emit('invalider',projet_id,text);
                    }
                    });
            }
               /*Swal.fire({
                    title: 'Vous êtes sûr  d\'annuler la validation du projet intitulé '+projet_titre+' ?',
                    text: "Vous ne pourrez encore le revalider!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: 'rgb(156 163 175)',
                    confirmButtonText: 'Oui, supprimer!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        const { value: text } = await Swal.fire({
                            input: 'text',
                            inputLabel: 'Message',
                            inputPlaceholder: 'Type your message here...',
                            inputAttributes: {
                                'aria-label': 'Type your message here'
                            },
                            showCancelButton: true
                            });

                        if (text) {
                            Livewire.emit('invalider',user_id,text);
                            Swal.fire(
                            'Annulé!',
                            'La validation du projet est annulée avec succes avec succès.',
                            'success'
                            )
                        }
                    }
                    });*/
            
    </script>
</div>
