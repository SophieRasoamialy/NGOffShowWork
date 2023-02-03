<div class="mx-5">
    <div class="row mb-5">
            <div class=" form-group  justify-content-center col-md-4">
                <label for="projet">Titre du Projet en cours</label>
                <select  class="form-control" id = "projet_id" wire:model = "projetId">
                    <option value="">Selectioner un projet</option>

                    @foreach($projet as $projet)
                    <!-- projets courants-->
                        <option value= {{$projet->projet_id}} >{{$projet->projet_titre}}</option>
                    @endforeach
                </select>
            </div>
    </div>
    <h3 class="text-center font-bold my-3 text-green-800">LISTE DES PARTICIPANTS 
        @if (!is_null($projetId) || $projetId!="")
            AU PROJET "{{$projet_titre}}"
        @endif
    </h3>
    <div class="row">
        <table class="table text-sm  text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 text-center uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">

            <tr>
                <th>developpeur ({{$nombre_participant}})</th>
                @can('admin')
                <th>Action</th>
                @endcan
            </tr>
            </thead>
            @foreach($participant as $participants)
            <tr>
                <td>
                    <div class="flow-root">
                        <div class="divide-y divide-gray-200 dark:divide-gray-700">
                            <div class="py-3 sm:py-4">
                                <div class="flex space-x-4">
                                    <div class="flex-shrink-0">
                                        <img class="image rounded-circle " src="{{asset('/storage/profile/'.$participants->avatar)}}" alt="profile_image" style="width: 50px;height: 50px;  ">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            {{$participants->name}}
                                        </p>
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            {{$participants->developpeur_a_propos}}
                                        </p>
                                    </div>
                                    
                                </div>
                        
                            </div>

                        </div>
                        <div >
                            @php
                                $competence = App\Models\Competence::join('developpeur_competences','developpeur_competences.competence_id','=','competences.competence_id')->where('developpeur_competences.user_id',$participants->id)->get();
                            @endphp
                            @foreach($competence as $ligne)
                            <span class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5  dark:bg-blue-200 dark:text-blue-800">{{$ligne->competence_label}}</span>
                            @endforeach
                        </div>
                    </div>
                </td>
                @can('admin')

                <td>
                    <button type="button"  onclick="confirm_enlever_groupe({{ $participants->id }},'{{ $participants->name }}')" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-2.5 text-center mr-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                        Enlever du projet
                    </button>

                </td>
                @endcan
            </tr>
            @endforeach
        </table>
        <div class="d-flex pt-0 pt-2 border-primary justify-content-center">
            @if(count($participant)>0)
            {{$participant->links()}}
            @endif
          </div>
    </div>

            <!-- The Modal -->
    <div class="modal" id="myModal" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
            <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Equipes du groupe {{$groupe_nom}} </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
        
                <!-- Modal body -->
                <div>
                    <ul>
                        @foreach($equipe as $row)
                        <li>
                            {{$row->name}}
                        </li>
                        @endforeach
                    </ul>
                </div>

        <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<script>
    function confirm_enlever_groupe(groupe_id,groupe_nom)
    {
        Swal.fire({
        input: 'textarea',
        inputLabel: 'Motif',
        inputPlaceholder: 'Entrer le motif ici...',
        inputAttributes: {
            'aria-label': 'Entrer le motif ici'
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
                    'Enlevé!',
                    'Le développeur est enlevé avec succès.',
                    'success'
                    )
                    Livewire.emit('deleteParticipation',groupe_id,text)

        }
        });

        /*Swal.fire({
            title: 'Vous êtes sûr de d\'enlever le développeur"'+groupe_nom+'" dans ce projet  ?',
            text: "Vous ne pourrez pas revenir en arrière!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: 'rgb(156 163 175)',
            confirmButtonText: 'Oui, supprimer!'
            }).then((result) => {
            if (result.isConfirmed) {
                const { value: text } =  await Swal.fire({
                    input: 'text',
                    inputLabel: 'Message',
                    inputPlaceholder: 'Type your message here...',
                    inputAttributes: {
                        'aria-label': 'Type your message here'
                    },
                    showCancelButton: true
                    });

                if (text) {
                    alert(text);
                    Livewire.emit('deleteParticipation',groupe_id,text);
                    Swal.fire(
                    'Enlevé!',
                    'Le développeur est enlevé avec succès.',
                    'success'
                    )
                }
            }
            });*/
    }

    
</script>
</div>
