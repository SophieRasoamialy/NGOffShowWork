
<div>
    <div class="my-5">
        <button type="button" data-bs-toggle="modal" data-bs-target="#myModal" class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">
            Nouveau categorie
        </button>
    </div>

    <div class=" row ">
        <div class=" col-6 mx-2 overflow-y-auto h-2/3	  relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6">
                            Action
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Categorie
                        </th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($categorie as $categorie)

                        <tr id="{{$categorie->categorie_id}}" class=" border-b  hover:bg-gray-100 ">
                            
                            <td class="py-4 px-6">
                                <button style="color: green" wire:click="edit({{ $categorie->categorie_id }})" data-bs-toggle="modal" data-bs-target="#myModal"class="btn  btn-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                      </svg>
                                      
                                </button>
                                <button style="color:red"  onclick="confirm_delete_categorie({{ $categorie->categorie_id }},' {{$categorie->categorie_label}}')" class="btn  btn-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                      </svg>
                                      
                                </button>
                                
                            </td>

                                <th  scope="row" class="py-4 px-6  font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    
                                    <div class="divide-y divide-gray-200 dark:divide-gray-700">
                                        <div class="py-3 sm:py-4">
                                            <div class="flex items-center space-x-4">
                                                <div class="flex-shrink-0">
                                                    <img class="w-20" src="{{asset('/storage/categorieImage/'.$categorie->categorie_illustration)}}" alt="illustration de la catégorie" >
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    
                                                    <a href="#" wire:click.prevent = "showCompetence({{$categorie->categorie_id}})"  style="color: black">
                                                        <span class="uppercase">{{$categorie->categorie_label}}</span> <br>
                                                        <i class='bx bx-chevron-right text-lg float-right'></i>
                                                        <label>Bugdet minimal:</label>{{$categorie->budget_min}} Ar<br>
                                                        <label>Duree minimal:</label> {{$categorie->duree_min}} jours<br>
                                                    </a>
                                                    <input type="hidden" wire:model="categorie_id" value={{$categorie->categorie_id}}>
                                                </div>
                                                
                                            </div>
                                    
                                        </div>
        
                                    </div>

                                    
                                </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class=" col-5 overflow-x-auto relative mx-2 shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class=" mx-auto py-3 px-6">
                            Compétences necessaires
                        </th>
                        
                    </tr>
                </thead>
                <tbody>
                    @if(!$showCompetence)
                        <tr > <td  ><p class="text-center mt-5 ">Aucune categorie selectionée </p></td></tr>
                    @else


                            <tr id= "competence" class="bg-white hover:bg-gray-50 ">
                                
                                <td class="py-4 px-6">
                                    <ul >
                                        @foreach($competence as $row)
                                        <div>
                                            <span id="badge-dismiss-dark" class="inline-flex items-center py-1 px-2 mr-2 mb-2 text-sm font-medium text-gray-800 bg-gray-100 rounded dark:bg-gray-200 dark:text-gray-800">
                                                {{$row->competence_label}}
                                                <button type="button" wire:click = "enleverCompetence({{$row->competence_id}},{{$row->categorie_id}})" class="inline-flex items-center p-0.5 ml-2 text-sm text-gray-400 bg-transparent rounded-sm hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-300 dark:hover:text-gray-900" data-dismiss-target="#badge-dismiss-dark" aria-label="Remove">
                                                    <svg aria-hidden="true" class="w-3.5 h-3.5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                    <span class="sr-only">Remove badge</span>
                                                </button>
                                              </span>
                                              
                                        </div>
                                            
                                        @endforeach
                                    </ul>
                                    <div class="flex flex-col items-center">
                                        <button style="color:dodgerblue" type="button" class="btn  btn-sm  " wire:click = "listeCompetence({{$categorie_id}})"   >
                                            <span class=" ">
                                                <i class="bx bx-plus nav_icon text-2xl" ></i><br>
                                            Ajouter competence
                                            </span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @if($showListeCompetence)
                            <tr class="bg-white overflow-y-auto h-2/3">
                                    <td>
                                        @foreach($toutCompetence  as $row)
                                        <div>
                                            <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700">
                                                <li class="pb-3 sm:pb-4">
                                                <div class="flex items-center space-x-4">
                                                    
                                                    <div class="flex-1 min-w-0">
                                                        
                                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                           {{$row->competence_label}}
                                                        </p>
                                                    </div>
                                                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                        <button type="button" class="btn  text-blue-500"  wire:click = "selectCompetence({{$row->competence_id}})">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                                              </svg>

                                                        </button>
                                                          
                                                    </div>
                                                </div>
                                                </li>
                                            </ul>
                                        </div>
                                        @endforeach
                                    </td>
                            </tr>
                            @endif
                    @endif
                </tbody>
            </table>
        </div>

        
    </div>
                <!-- The Modal -->
        <div wire:ignore.self class="modal" id="myModal" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
            <div class="modal-dialog">
            <div class="modal-content">
        
                <!-- Modal Header -->
                <div class="modal-header">
                <h4 class="modal-title">Sous categorie pour la categorie </h4>
                <button type="button" class="close" wire:click = "close" data-bs-dismiss="modal"  aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                
                <!-- Modal body -->
                <div class="row ">
                    <div class="">
                        <div class=" mt-3 rounded-xl ">
                            <form id="form_categorie">
                                <div >
                                    <div   class=" items-stretch  mb-4 mx-3 relative">
            
                                            <label for="username-success" class="block mb-2 text-sm font-medium ">Nom de la categorie</label>
                                            <input type="text" id = "categorie_label" wire:model.defer = "categorie_label"  class=" flex-auto   leading-normal bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mb-2 ">
                                            <input type="hidden" wire:model = "user_id" >
                                            @error('categorie_label')
                                                <p class="text-red">{{$message}}</p>
                                            @enderror
                                            
            
                                            <div class=""> 
                                                <div>
                                                    <label  class="block mb-2 text-sm font-medium ">Budget minimale (Ar)</label>
                                                    <input type="number" id = "budget_min" wire:model.defer = "budget_min"  class=" flex-auto   leading-normal bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mb-2 ">
                                                    @error('budget_min')
                                                        <p class="text-red">{{$message}}</p>
                                                    @enderror
                                                </div>
                                                <div>
                                                    <label  class="block mb-2 text-sm font-medium ">Duree minimale</label>
                                                    <input type="number" id = "duree_min" wire:model.defer = "duree_min"  class=" flex-auto   leading-normal bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mb-2 ">
                                                    @error('duree_min')
                                                        <p class="text-red">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            
                                            </div>
            
                                            
                                    </div>
                                    <div class="mx-3">
                                        <div class="form-group " 	>
                                            <label for="categorie_illustration" class="block mb-2 text-sm font-medium ">Selectionner un image pour illustrer cette categorie</label>
                                            <div class="row justify-content-center">
                                                <div class="col-md-8">
                                                    <input type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                                                    wire:model="categorie_illustration" style="padding: 3px 5px;" />
                                                </div>
                                            </div>
                        
                                            @error('categorie_illustration')
                                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                            @enderror
                        
                        
                                            <div wire:loading wire:target="categorie_illustration" wire:key="categorie_illustration"><i class="fa fa-spinner fa-spin mt-2 ml-2"></i> Uploading</div>
                        
                                            {{-- ImagePreview --}}
                                            @if ($categorie_illustration && $change)
                                                <img src="{{ $categorie_illustration->temporaryUrl() }}" width="130" alt="" class="my-2 mx-auto"  >
                                            @else
                                                <img src="{{ asset('/storage/categorieImage/'.$categorie_illustration) }}" width="130" alt="" class="my-2 mx-auto"  >
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        
                <!-- Modal footer -->
                <div class="modal-footer">
                    <div class=" ">
                        <button type="reset" wire:click.prevent="close" data-bs-dismiss="modal" class=" text-gray-900 hover:text-white border-2 border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2  ">
                            Annuler</button>
                        @if($updateMode)
                            <button type="submit" wire:click.prevent="update" class=" text-blue-700 hover:text-white border-2 border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Mettre à jour</button>
                        @else
                        <button type="submit" wire:click.prevent="store" class="  text-blue-700 hover:text-white border-2 border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 ">
                            Enregistrer</button>
                        @endif
                        @error('categorie_label') <span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>
                </form>
            </div>
            </div>
        </div>
</div>

<script>

        window.addEventListener('changeColor', event => {
            
            document.getElementById(event.detail.categorie_id).style.backgroundColor="#D3D3D3";
            document.getElementById('sous_categorie').style.backgroundColor="#D3D3D3";

        });

    
        window.addEventListener('notification', event => {
            $('#myModal').modal('hide')

            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })

            Toast.fire({
            icon: 'success',
            title: event.detail.title
            });


        });
        
     
    
    
    function confirm_delete_categorie(categorie_id, categorie_label)
    {
        Swal.fire({
            title: 'Vous êtes sûr de supprimer la categorie "'+categorie_label+'" ?',
            text: "Cela entrainera la suppression des projets dans cette categorie",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: 'rgb(156 163 175)',
            confirmButtonText: 'Oui, supprimer!'
            }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emit('delete', categorie_id)
                Swal.fire(
                    'Supprimé!',
                    'La categorie est supprimé avec succès.',
                    'success'
                )
            }
            
            });
    }

    
</script>