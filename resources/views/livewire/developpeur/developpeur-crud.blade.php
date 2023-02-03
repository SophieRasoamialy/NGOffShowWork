<div>
    
    <div >
        <h4 class="text-center text-lg text-green-800">Liste des développeurs </h4>
        <div class="row mb-3">
            <div class="col-8"></div>
            <div class="col-4">
                <input wire:model="search" class="form-control" type="text" placeholder="Rechercher des groupes ...">
            </div>
        </div>
        <div class="row mt-5 mx-5">
            <table class="table text-sm text-justify  text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                <tr >
                    <th>Developpeurs</th>
                    <th>Premium </th>
                    <th>Valide</th>
                    @can('admin')
                    <th>Action</th>
                    @endcan
                </tr>
                </thead> 
                @foreach($participants as $row)
                <tr >   
                         
                    <td >
                        <div class="flow-root">
                            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                                <div class="py-3 sm:py-4">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <a href="/profile?user_id={{$row->id}}"><img class="image rounded-circle " src="{{asset('/storage/profile/'.$row->avatar)}}" alt="profile_image" style="width: 50px;height: 50px;  "></a>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            
                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                {{$row->name}}
                                            </p>
                                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                {{$row->developpeur_a_propos}}
                                            </p>
                                        </div>
                                        
                                    </div>
                            
                                </div>

                            </div>
                            <div >
                                @php
                                    $competence = App\Models\Competence::join('developpeur_competences','developpeur_competences.competence_id','=','competences.competence_id')->where('developpeur_competences.user_id',$row->id)->get();
                                @endphp
                                @foreach($competence as $ligne)
                                <span class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5  dark:bg-blue-200 dark:text-blue-800">{{$ligne->competence_label}}</span>
                                @endforeach
                            </div>
                        </div>
                        
                    </td> 
                    <td >
                        @if ($row->premium == 1)
                            Oui
                        @else
                            Non
                        @endif
                    </td> 
                    <td>
                        @if ($row->developpeurs_isvalide == 1)
                            Oui
                        @else
                            Non
                        @endif
                    </td>
                    @can('admin')
                    <td >
                        <button style="color: red"   class="btn btn-sm " onclick="confirm_supprimer_user({{ $row->id }},'{{ $row->name }}')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                              </svg>
                        </button>
                       @if ($row->developpeurs_isvalide == 0)
                       
                       <button  wire:click = "valider({{$row->id}})" style="color:green"   class="btn btn-sm " >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                          </svg>                          
                    </button>
                       @endif
                       
                       @if ($row->premium == 0)
                       <button  wire:click = "premiumer({{$row->id}})" style="color:#f59e0b"   class="btn btn-sm " >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                          </svg>                          
                    </button>
                       @endif 
                    </td>
                    @endcan
                </tr>
                @endforeach
            </table>
            <div class="d-flex pt-0 pt-2 border-primary justify-content-center">
                {{$participants->links()}}
              </div>
            
    
        </div>
    
        <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
      
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Projets avec le groupe </h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
      
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-sm-4"> <h5> Ses groupes:</h5></div>
                    <div class="col-sm-8">
                        <ul>
                        @foreach($groupe_nom as $row)
                            <li>{{$row->groupe_nom}}</li>
                        @endforeach
                        </ul>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4"> <h5> Ses projets:</h5></div>
                    <div class="col-sm-8">
                        <ul>
                        @foreach($projets as $row)
                            <li>{{$row->projet_titre}}</li>
                        @endforeach
                        </ul>
                    </div>
                </div>
            </div>
      
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
      
          </div>
        </div>
      </div>
    <script>
        window.addEventListener('show_modal', event => {
            $('#myModal').modal('show'); 
            });

            window.addEventListener('notification', event => {
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            });
            Toast.fire({
            icon: 'success',
            title: "validé"
            });
        });

        window.addEventListener('notifsup', event => {
                const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
                });
            Toast.fire({
            icon: 'success',
            title: "supprimé"
            });
        });
    
            function confirm_supprimer_user(user_id,user_name)
                {

                    Swal.fire({
                    input: 'textarea',
                    inputLabel: 'Motif',
                    inputPlaceholder: 'Entrer le motif de suppression ici...',
                    inputAttributes: {
                        'aria-label': 'Entrer le motif de suppression ici'
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
                                'Supprimé!',
                                'Le demande est supprimé avec succès.',
                                'success'
                                )
                                Livewire.emit('supprimer',user_id,text)

                    }
                    });

                    
                }
    </script>
    </div>
    
    </div>
    