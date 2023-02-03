<div>
    <h1 class="mb-5 text-center text-lg text-green-800">Tous les clients</h1>
    <div class="  relative">
        <table class="table mx-auto text-sm text-justify w-3/4 text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">            <tr>
            <tr>
                <th scope="col" >
                    Nom 
                </th>
                <th>
                    Valide
                </th>
                <th>
                    Premium
                </th>
                
                <th scope="col" >
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($partenaire as $row)
            <tr class="bg-white dark:bg-gray-800">
                
                <td class="py-4 px-6">
                    {{$row->name}}
                </td>
                <td class="py-4 px-6">
                    @if ($row->cdo_isvalide == 1)
                        Oui
                    @else
                        Non
                    @endif
                </td>
                <td class="py-4 px-6">
                    @if ($row->cdo_premium == 1)
                        Oui
                    @else
                        Non
                    @endif
                </td>
                <td class="py-4 px-6">
                    @if ($row->cdo_isvalide == 0)
                    <button  wire:click = "validerBasic({{$row->id}})" type="button" class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-2.5 py-2.5 text-center mr-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800" >Valider</button>
                    @endif
                    @if ($row->cdo_premium == 0)
                    <button  wire:click = "validerPremium({{$row->id}})" type="button" class="text-yellow-500 hover:text-white border border-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-2.5 py-2.5 text-center mr-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800" >Premium</button>
                    @endif
                    <button  onclick="confirm_supprimer_partenaire({{ $row->id }},'{{ $row->name }}')" type="button" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-2.5 py-2.5 text-center mr-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900" onclick="confirm('Vous confirmez la suppression ?') || event.stopImmediatePropagation()">Supprimer</button>
                </td>
            </tr>
            @endforeach
            

        </tbody>
        
    </table>
    <div class="d-flex pt-0 pt-2 border-primary justify-content-center">
        {{$partenaire->links()}}
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
      
        function confirm_supprimer_partenaire(user_id,user_name)
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
