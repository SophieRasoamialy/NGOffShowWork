<div>
    <div class="flex flex-wrap items-stretch w-2/3 mb-4  mx-auto my-5 relative">
            <input type="text" wire:model="competence_label" wire:keydown.enter =@if($updateMode) "update" @else "store" @endif id="competence_label" class="flex-shrink flex-grow flex-auto leading-normal w-px flex-1 border h-11 border-grey-light rounded rounded-r-none px-3 relative" placeholder="Enter nouveau competence">
            @error('competence_label') <span class="text-danger">{{$message}}</span>@enderror
        <div class="flex -mr-px">
            @if($updateMode)
            <button type="button" wire:click.prevent = "update" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-800">Mettre à jour</button>
            @else
            <button type="button" wire:click.prevent = "store" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-800">Enregistrer</button>
            @endif
        </div>	
        <div class="flex -mr-px">
            <button type="reset" wire:clik.prevent = "annuler" class="text-gray-700 hover:text-white border border-gray-700 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800">Annuler</button>
        </div>

    </div>	
    <div class=" col-5 overflow-x-auto relative mx-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class=" text-center py-3 px-6">
                            Compétences 
                        </th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr id= "competence" class="bg-white hover:bg-gray-50 ">
                        
                        <td class="py-4 px-4">
                            <ul >
                                @foreach($competence as $row)
                                    <li class="flex">
                                        <p class="py-2 flex-auto ">{{$row->competence_label}} </p>
                                        <button type="button" style="color: green" wire:click.prevent = "edit({{$row->competence_id}},'{{$row->competence_label}}')"  class="btn  btn-sm" >
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                              </svg>
                                        </button>
                                        <button style="color:red"  onclick="confirm_delete_categorie({{ $row->competence_id }},' {{$row->competence_label}}')"   class="btn  btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                              </svg>
                                              
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                            
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="d-flex pt-0 pt-2 border-primary justify-content-center">
                {{$competence->links()}}
            </div>

        </div>
<script>
     window.addEventListener('notification', event => {
            
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
            })


        });

        function confirm_delete_categorie(competence_id, competence_label)
    {
        Swal.fire({
            title: 'Vous êtes sûr de supprimer la competence "'+competence_label+'" ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: 'rgb(156 163 175)',
            confirmButtonText: 'Oui, supprimer!'
            }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emit('delete', competence_id)
                Swal.fire(
                    'Supprimé!',
                    'La compeence est supprimé avec succès.',
                    'success'
                )
            }
            
            });
    }
</script>
</div>
