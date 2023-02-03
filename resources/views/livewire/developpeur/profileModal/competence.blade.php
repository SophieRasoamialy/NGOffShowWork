
{{--MODAL EDUCATION--}}
<!-- Main modal -->
<div id="competence" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" wire:ignore.self class="fixed  z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
    <div class="relative w-full h-full max-w-2xl md:h-auto">
        <!-- Modal content -->
        <div class="relative  rounded-lg shadow bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-white">
                    Competence
                </h3>
                <button type="button"   class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="competence">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                </button>
            </div>
            <!-- Modal body -->

            <div class="p-6 space-y-6">

                  <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div class="flex mt-3">
                        <div>
                            <div class="  mx-2 overflow-y-auto  h-60 w-56  shadow-md sm:rounded-lg">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="py-3 px-6">
                                                Categorie
                                            </th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody >
                                        @foreach($categorie as $categorie)
                                            <tr id="{{$categorie->categorie_id}}" class=" border-b   hover:text-black ">
                    
                                                    <th  scope="row" class="   py-4 px-6 font-medium text-gray-900 whitespace-nowrap hover:text-black">
                                                        <a href="#" wire:click="showCompetence({{$categorie->categorie_id}})"   style="color: black">
                                                            <span class="flex">
                                                                <span class="flex-auto text-gray-400 hover:text-black" >{{$categorie->categorie_label}}</span> <br>
                                                            <span class=" float-right">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                                                </svg>
                                                            </span>
                                                            </span>
                                                        </a>
                                                        <input type="hidden" wire:model="categorie_id" value={{$categorie->categorie_id}}>
                                                    </th>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div>
                            <div class="  mx-2 overflow-y-auto 	 h-60 w-56  shadow-md sm:rounded-lg">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="" class="py-3 px-6">
                                                @if($show_competence)
                                                {{$categorie_label}}
                                                @else
                                                Pas de categorie selectionée
                                                @endif
                                            </th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($show_competence)
                                            @foreach($competenceCategorie as $row)
                        
                                                <tr  class=" border-b   hover:text-black ">
                        
                                                        <th  scope="row" class="  py-4 px-6 font-medium  whitespace-nowrap hover:text-black">
                                                            <a href="#" wire:click.prevent = "selectCompetence({{$row->competence_id}})"  style="color: black">
                                                                
                                                                <span class="flex">
                                                                    <span class="flex-auto text-gray-400 hover:text-black" >{{$row->competence_label}} <br></span>
                                                                    <span class="float-right text-gray-400">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                                                        </svg>
                                                                    </span>
                                                                </span>
                                                                  
                                                            </a>
                                                        </th>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                
                    </div>

                    
                  </div>
            </div>
          
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                
                    <button data-modal-toggle="competence"  type="button"   class="  focus:ring-4 focus:outline-none  rounded-lg border  text-sm font-medium px-5 py-2.5  focus:z-10 bg-gray-700 text-gray-300 border-blue-500 hover:text-white hover:bg-blue-600 focus:ring-blue-600">
                    Ok
                    </button>
            </div>
        </div>
    </div>
</div>