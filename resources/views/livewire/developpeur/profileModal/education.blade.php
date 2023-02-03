
{{--MODAL EDUCATION--}}
<!-- Main modal -->
<div id="education" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" wire:ignore.self class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
    <div class="relative w-full h-full max-w-2xl md:h-auto">
        <!-- Modal content -->
        <div class="relative  rounded-lg shadow bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-white">
                    Education
                </h3>
                <button type="button"  wire:click = "AnnulerEducation" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="education">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                </button>
            </div>
            <!-- Modal body -->
          <form>

            <div class="p-6 space-y-6">

                  <div class=" gap-6 mb-6 ">
                    <div class=" mb-5 flex">
                        <div class="flex-1">
                            <label for="" class="font-bold mb-1 text-gray-400 block">Province</label>
                            <label
                                class="flex justify-start items-center text-truncate rounded-lg  pl-2 pr-2 py-2 shadow-sm mr-4">
                            
                                <select id="province" wire:model = "education.province" 
                                class=" border  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-gray-400 focus:ring-blue-500 focus:border-blue-500">
                                    <option selected> Sélectionnez un province</option>
                                    <option value="Antananarivo">Antananarivo</option>
                                    <option value="Toamasina">Toamasina</option>
                                    <option value="Mahajanga">Mahajanga</option>
                                    <option value="Antsinanana">Antsinanana</option>
                                    <option value="Fianarantsoa">Fianarantsoa</option>
                                    <option value="Toliara">Toliara</option>
                                    
                                </select>

                            </label>
                            @error('province') <span class="text-red-500">{{$message}}</span>@enderror

                        </div>

                        <div class="flex-1">
                            <label for="" class="font-bold mb-1 text-gray-400 block">Université</label>
                            
                                <input type="text" wire:model = "education.universite" id="universite"
                                class=" border  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                                placeholder="ex. Université de Fianarantsoa">
                                @error('universite') <span class="text-red-500">{{$message}}</span>@enderror

                        </div>
                    </div>

                    <div class="mb-5">
                        <label for="diplome" class="font-bold mb-1 text-gray-400 block">Diplôme</label>
                        <input type="text" wire:model = 'education.diplome' id="diplome"
                        class=" border  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Saisissez votre diplôme ">
                        @error('diplome') <span class="text-red-500">{{$message}}</span>@enderror
                    </div>

                    <div class="mb-2 flex">
                        <div class="mr-3" >
                            <label for="education_debut_annee" class="font-bold mb-1 text-gray-400 block">Année de debut</label>
                            <label
                            class="flex justify-start items-center text-truncate rounded-lg  pl-2 pr-2 py-2 shadow-sm">
                                <select id="education_debut_annee" wire:model = "education.education_debut_annee"
                                class=" border  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-gray-400 focus:ring-blue-500 focus:border-blue-500">
                                    <option selected> Sélectionnez une annee</option>
                                    @php
                                        $date = date('Y');
                                    @endphp
                                    @for($annee = $date; $annee > 1960; $annee--)
                                    <option value="{{$annee}}">{{$annee}}</option>
                                    @endfor
                                </select>
                            </label>
                            @error('education_debut_annee') <span class="text-red-500">{{$message}}</span>@enderror
                        </div>
                        @if($education_until_now == false )
                        <div>
                            <label  class="font-bold mb-1 text-gray-400 block">Fin d'année</label>
                            <label
                            class="flex justify-start items-center text-truncate rounded-lg  pl-2 pr-2 py-2 shadow-sm">
                            
                                <select  id="education_fin_annee" wire:model = "education.education_fin_annee" 
                                class=" border  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-gray-400 focus:ring-blue-500 focus:border-blue-500">
                                    <option selected> Sélectionnez une annee</option>
                                    @php
                                        $date = date('Y');
                                    @endphp
                                    @for($annee = $date; $annee > 1960; $annee--)
                                    <option value="{{$annee}}">{{$annee}}</option>
                                    @endfor
                                </select>
                            </label>
                            @error('education_fin_annee') <span class="text-red-500">{{$message}}</span>@enderror

                        </div>
                        @endif
                    </div>

                    <div class="flex items-center">
                        <input id="link-checkbox" type="checkbox" wire:model = "education_until_now" 
                        class="w-4 h-4  rounded border-gray-300 focus:ring-blue-600 ring-offset-gray-800 bg-gray-700 border-gray-100" >                    
                        <label for="link-checkbox" class="ml-2 mt-2 text-sm font-medium text-gray-400">Jusqu'à maintenant </label>
                    </div>
                  </div>
            </div>
          
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                @if($updateEducation)
                    <button data-modal-toggle="education" wire:click = "enregistrerEducation"  type="button" class="text-white  focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">
                  Mettre à jour
                    </button>
                @else
                    <button data-modal-toggle="education" wire:click = "ajouterEducation"  type="button" class="text-white  focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">
                        Ajouter
                    </button>
                @endif
                    <button data-modal-toggle="education"  type="reset"  wire:click = "AnnulerEducation" class="  focus:ring-4 focus:outline-none  rounded-lg border  text-sm font-medium px-5 py-2.5  focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600 focus:ring-gray-600">
                    Annuler
                    </button>
            </div>
          </form>
        </div>
    </div>
</div>