<div>
    
    <div class=" mt-16 overflow-x-auto relative sm:rounded-lg px-2 bg-gray-700" >
        <caption class="p-5   font-semibold   bg-white ">
            <p class="text-center  my-3 uppercase" style="color:antiquewhite">Vos projets</p>
            <!--<p class="mt-1 text-sm font-normal text-gray-400 dark:text-gray-400">Browse a list of Flowbite products designed to help you work and play, stay organized, get answers, keep in touch, grow your business, and more.</p>
            -->
        </caption>
        <table class="w-full text-sm bg-gray-700 text-left text-gray-200 ">
            
            <thead class="text-xs  uppercase bg-gray-500 text-gray-900">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        <span class="sr-only">Image</span>
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Titre 
                    </th>

                    <th scope="col" class="py-3 px-6">
                        Deadline
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Note
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Remarque
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Resultat
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $count = sizeof($projets);
                @endphp
                @if ($count == 0)
                <tr >
                    <td class="py-4 px-6 font-normal text-center " colspan="6">
                        Aucun projet.
                    </td>
                </tr>
                @endif
                @foreach($projets as $row)
                <tr class=" border-b bg-gray-800 border-gray-700 hover:text-white hover:bg-gray-900">
                    <td class="p-4 w-40">

                        <img class="img img-2" src="{{asset('/storage/categorieImage/'.$row->categorie_illustration)}}" alt="illustration de le categorie"  >
                    </td>
                    
                    <td class="py-4 px-6 font-semibold text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-600  ">
                        {{$row->projet_titre}}
                    </td>
                    <td class="py-4 px-6 font-semibold ">
                        @php 
                        $datetime = Carbon\Carbon::now()->setTimezone('Turkey');
                                $date1 = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $row->projet_date_fin);
                                $date2 = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $datetime->toDateTimeString());
                        
                                $result = $date1->lt($date2);
                                
                        @endphp
                        @if($result )
                            Terminé
                        @else
                        @php
                            $date = date('d F Y H:i', strtotime($row->projet_date_fin));
                        @endphp
                            {{$date}}
                        @endif
                    </td>
                    @if(App\Models\Depot::where('user_id',$row->user_id)->where('projet_id',$row->projet_id)->exists())
                    @php
                        $depots = App\Models\Depot::where('user_id',$row->user_id)->where('projet_id',$row->projet_id)->first();
                        $rating = $depots->depot_note;
                        $remarque = $depots->depot_remarque;
                        $isaccepted = $depots->depot_isaccepted;
                    @endphp
                        <td class="py-4 px-6  ">

                            <div class="flex items-center">
                                <svg aria-hidden="true" class="w-5 h-5 @if($rating >= 1 ) text-yellow-400 shadow-lg @else text-gray-500  @endif" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>First star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <svg aria-hidden="true" class="w-5 h-5 @if($rating >= 2 ) text-yellow-400 shadow-lg @else text-gray-500  @endif" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Second star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <svg aria-hidden="true" class="w-5 h-5 @if($rating >= 3 ) text-yellow-400 shadow-lg @else text-gray-500  @endif" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Third star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <svg aria-hidden="true" class="w-5 h-5 @if($rating >= 4 ) text-yellow-400 shadow-lg @else text-gray-500  @endif" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Fourth star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <svg aria-hidden="true" class="w-5 h-5 @if($rating >= 5 ) text-yellow-400 shadow-lg @else text-gray-500  @endif" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Fifth star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            </div>

                        </td>

                        <td class="py-4 px-6 font-normal">
                                @if($remarque == "")
                                Il n'y a pas encore de remarque
                                @else
                                {{$remarque}}
                                @endif
                        </td>
                        <td class="py-4 px-6 font-normal">
                                @if($isaccepted == 0)
                                    @if($result)
                                        Projet refusé
                                    @else
                                        En attente
                                    @endif
                                @else
                                Projet accepté
                                @endif
                        </td>
                    @else

                    <td class="py-4 px-6 font-normal" colspan="3">
                             
                            @if($result )
                            Projet terminé <br>
                            <a href="/resultat" class="font-medium text-green-600  hover:underline" >Voir le classement</a>
                            @else
                            Projet n'est pas encore déposé.<br> Vous pouver encore
                            <a href="#" class="font-medium text-red-600  hover:underline"  onclick="confirm_annuler_participation({{ $row->user_id }},{{$row->projet_id}},'{{$row->projet_titre}}')"> annuler votre participation.</a>
                            @endif 
                    </td>
                    @endif
                    

                    
                </tr>
                @endforeach
                
            </tbody>
        </table>
        <div class="d-flex pt-0 pt-2 border-primary justify-content-center ">
            {{$projets->links()}}
          </div>
    </div>
    
    <div  id="groupeModal" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <!-- Modal body -->
                <div class="modal-body">
                @foreach($nomGroupe as $row)
                        <p> Groupe: {{$row->groupe_nom}}</p>
                @endforeach
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
                $('#groupeModal').modal('show'); 
         });
    
         function confirm_annuler_participation(groupe_id,projet_id,projet_titre)
         {
            Swal.fire({
                        title: 'Vous êtes sûr de retirer votre partipation  dans le projet '+ projet_titre+' ?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: 'rgb(156 163 175)',
                        confirmButtonText: 'Oui, annuler!'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            Livewire.emit('annulerParticiption',groupe_id,projet_id);
                            Swal.fire(
                                'Annulé!',
                                'Votre participation est annulée avec succès.',
                                'success'
                            )
                        }
                        });
         }
    </script>
    </div>
    