{{--MODAL  EXPERIENCE--}}
  
  <!-- Main modal -->
  <div id="experience" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" wire:ignore.self class="fixed  z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
    <div class="relative w-full h-full max-w-2xl md:h-auto">
        <!-- Modal content -->
        <div class="relative  rounded-lg shadow bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-white">
                    Experience
                </h3>
                <button type="button"  wire:click = "AnnulerExperience" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="experience">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                </button>
            </div>
            <!-- Modal body -->
          <form>

            <div class="p-6 space-y-6">
                  <div class=" gap-6 mb-6 ">
                    <div class="mb-5">
                        <div class="flex">
                            <div class=" flex-1 mr-3">
                                <label for="titre" class="font-bold mb-1  text-gray-400 block">Titre</label>
                                <input type="text" wire:model = "experience.titre" id="titre"
                                class=" border  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Entrer votre titre">
                                @error('titre') <span class="text-red-500">{{$message}}</span>@enderror

                            </div>

                            <div class=" flex-1">
                                <label for="entreprise" class="font-bold mb-1 text-gray-400 block">Entreprise</label>
                                <input type="text" wire:model = "experience.entreprise_nom" id="entreprise_nom"
                                class=" border  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Entrer le nom de l'entreprise">
                                @error('entreprise_nom') <span class="text-red-500">{{$message}}</span>@enderror

                            </div>

                        </div>
                    </div>

                    <div class="mb-5 ">
                        <div class="flex ">
                            <div class="mr-3">
                                <label for="experience_debut" class="font-bold mb-1 text-gray-400 block">Debut</label>
                                <div class="flex">
                                    <div class="">
                                    <label
                                        class=" justify-start items-center text-truncate rounded-lg  pl-2 pr-2 py-2  mr-1">
                                        <select id="experience_debut_mois" wire:model = "experience.experience_debut_mois"
                                        class=" border  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-gray-400 focus:ring-blue-500 focus:border-blue-500">
                                            <option selected>  Mois</option>
                                            <option value="Janvier">Janvier</option>
                                            <option value="Février">Février</option>
                                            <option value="Mars">Mars</option>
                                            <option value="Avril">Avril</option>
                                            <option value="Mai">Mai</option>
                                            <option value="Juin">Juin</option>
                                            <option value="Juillet">Juillet</option>
                                            <option value="Août">Août</option>
                                            <option value="Septembre">Septembre</option>
                                            <option value="Octobre">Octobre</option>
                                            <option value="Novembre">Novembre</option>
                                            <option value="Décembre">Décembre</option>
                                        </select>

                                    </label>
                                    @error('experience_debut_mois') <span class="text-red-500">{{$message}}</span>@enderror
                                    </div>
                                    <div class="">
                                    <label
                                        class=" justify-start items-center text-truncate rounded-lg  pl-2 pr-2 py-2 ">
                                        <select id="experience_debut_annee" wire:model = "experience.experience_debut_annee" 
                                        class=" border  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-gray-400 focus:ring-blue-500 focus:border-blue-500">
                                            <option selected> Annee</option>
                                            @php
                                                $date = date('Y');
                                            @endphp
                                            @for($annee = $date; $annee > 1960; $annee--)
                                            <option value="{{$annee}}">{{$annee}}</option>
                                            @endfor
                                        </select>

                                    </label>
                                    @error('experience_debut_annee') <span class="text-red-500">{{$message}}</span>@enderror
                                    </div>
                                </div>
                            </div>

                            @if($experience_until_now == false)
                            <div class="mx-3">
                                <label for="experience_debut" class="font-bold mb-1 text-gray-400 block">Fin</label>
                                <div class="flex">
                                    <div class="">
                                    <label
                                        class=" justify-start items-center text-truncate rounded-lg  pl-2 pr-2 py-2  mr-1">
                                        <select id="experience_fin_mois" wire:model = "experience.experience_fin_mois" 
                                        class=" border  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-gray-400 focus:ring-blue-500 focus:border-blue-500">
                                            <option selected> Mois</option>
                                            <option value="Janvier">Janvier</option>
                                            <option value="Février">Février</option>
                                            <option value="Mars">Mars</option>
                                            <option value="Avril">Avril</option>
                                            <option value="Mai">Mai</option>
                                            <option value="Juin">Juin</option>
                                            <option value="Juillet">Juillet</option>
                                            <option value="Août">Août</option>
                                            <option value="Septembre">Septembre</option>
                                            <option value="Octobre">Octobre</option>
                                            <option value="Novembre">Novembre</option>
                                            <option value="Décembre">Décembre</option>
                                        </select>

                                    </label>
                                    @error('experience_fin_mois') <span class="text-red-500">{{$message}}</span>@enderror
                                    </div>
                                    <div class="">
                                    <label
                                        class=" justify-start items-center text-truncate rounded-lg  pl-2 pr-2 py-2 ">
                                        <select id="experience_fin_annee" wire:model = "experience.experience_fin_annee" 
                                        class=" border  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-gray-400 focus:ring-blue-500 focus:border-blue-500">
                                            <option selected> Annee</option>
                                            @php
                                                $date = date('Y');
                                            @endphp
                                            @for($annee = $date; $annee > 1960; $annee--)
                                            <option value="{{$annee}}">{{$annee}}</option>
                                            @endfor
                                        </select>

                                    </label>
                                    @error('experience_fin_annee') <span class="text-red-500">{{$message}}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="flex  mt-2">
                            <input id="link-checkbox" type="checkbox" wire:model = "experience_until_now" 
                            class="w-4 h-4  rounded border-gray-300 focus:ring-blue-600 ring-offset-gray-300 bg-gray-700 " >                       
                            <label for="link-checkbox" class="ml-2 text-sm font-medium text-gray-400">Jusqu'à maintenant </label>
                        </div>

                    </div>

                    <div class="">
                        <label for="experience" class="font-bold mb-1 text-gray-400 block">Sommaire</label>
                        <textarea wire:model = "experience.description" id="description" 
                        class=" border  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-100 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                         placeholder="Decrire votre expérience de travail"
                        ></textarea>
                        @error('description') <span class="text-red-500">{{$message}}</span>@enderror
                    </div>

                  </div>
            </div>
          
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                @if($updateExperience)
                <button wire:click = "enregistrerExperience"  type="button" class="text-white  focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">
                    Mettre à jour
                    </button>
                @else
                <button wire:click = "ajouterExperience" data-modal-toggle="experience"  type="button" class="text-white  focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">
                  Ajouter
                  </button>
                  @endif
                <button data-modal-toggle="experience"  type="reset"  wire:click = "AnnulerExperience" class="  focus:ring-4 focus:outline-none  rounded-lg border  text-sm font-medium px-5 py-2.5  focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600 focus:ring-gray-600">
                  Annuler
              </button>
            </div>
          </form>
        </div>
    </div>
</div>