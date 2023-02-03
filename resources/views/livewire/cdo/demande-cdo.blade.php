<div class="my-20">
    <h1 class="mb-5 text-center text-lg text-green-800">Demande d'abonnement des clients</h1>
    <div class="  relative">
        <table class="table mx-auto text-sm text-center w-5/6 text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">            <tr>
                <th scope="col" class="">
                    Nom 
                </th>
           
                <th scope="col" class="">
                    Date de paiement
                </th>
                <th>
                    Mode
                </th>
                <th>
                    Référence
                </th>
                <th>
                    Type d'abonnement
                </th>
                <th>
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($demande as $row)
            <tr class="bg-white dark:bg-gray-800">
                
                <td class="py-4 px-6 capitalize">
                    {{$row->name}}
                </td>
                <td class="py-4 px-6">
                    {{$row->created_at}}
                </td>
                <td class="py-4 px-6">
                    {{$row->mode_paiement}}
                </td>
                <td class="py-4 px-6">
                    {{$row->paiement_reference}} 
                </td>
                <td class="py-4 px-6">
                    @if($row->abonnement_type == "cdo_premium")
                    Premium
                    @else
                    Basique
                    @endif
                </td>
                <td class="py-4 px-6"> 
                    @if($row->abonnement_type == "cdo_premium")
                        @if($row->cdo_premium == 0)
                            <button  wire:click = "validerDemande({{$row->id}},'{{$row->abonnement_type}}')" type="button" class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800" >
                                Valider
                            </button>
                            <button onclick="confirm_supprimer_partenaire({{ $row->id }},'{{ $row->name }}')" type="button" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900" >
                                Supprimer
                            </button>
                        @else
                           <p class="text-green-700 text-center">Validé </p> 
                        @endif
                    @else
                        @if($row->cdo_isvalide == 0)
                            <button  wire:click = "validerDemande({{$row->id}},'{{$row->abonnement_type}}')" type="button" class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800" >
                                Valider
                            </button>
                            <button onclick="confirm_supprimer_partenaire({{ $row->id }},'{{ $row->name }}')" type="button" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900" >
                                Supprimer
                            </button>
                        @else
                            <p class="text-green-700 text-center">Validé</p>
                        @endif
                    @endif
                    
                </td>
            </tr>
            @endforeach
            
        </tbody>
        
    </table>
    <div class="d-flex pt-0 pt-2 border-primary justify-content-center">
        {{$demande->links()}}
    </div>
    </div>
<script>
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
    function confirm_supprimer_partenaire(user_id,user_name)
            {
                Swal.fire({
                    title: 'Vous êtes sûr  de supprimer le demande de "'+user_name+'" ?',
                    text: "Vous ne pourrez pas revenir en arrière!",
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
                            Livewire.emit('supprimerDemande',user_id,text);
                            Swal.fire(
                            'Supprimé!',
                            'Le demande est supprimé avec succès.',
                            'success'
                            )
                        }
                    }
                    });
            }
</script>
</div>
