<div>

    @if($projet_id != null)

    <div class="flex float-right">
    @can('admin')
        <button type="button" wire:click.prevent = "archiver" class="  text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            Archiver
        </button>
    @endcan
    </div>
    @endif

    <div class=" flex mb-3 ">
        <div class=" form-group   col-md-3">
            <label for="projet">Titre du Projet</label>
            <select  class="form-control" id = "projet_id" wire:model = "projet_id">
                <option value="">Choisir un projet</option>
                @foreach($projets as $projet)
                    <option value= {{$projet->projet_id}} >{{$projet->projet_titre}}</option>
                @endforeach
            </select>
        </div>

        
    </div>

    <h4 class="text-center mb-5 text-green-800 text-lg">Liste des développeurs qui ont déjà déposé leur lien git 
        @if (!is_null($projet_id) && $projet_id!="")
        @php
            $projet = App\Models\Projet::where('projet_id',$projet_id)->first();
        @endphp
        sur le projet "{{$projet->projet_titre}}"
        @endif
        
    </h4>
    <div class="row mb-3 mx-5">
        <div class="col-8"></div>
        <div class="col-4">
            <input wire:model="search" class="form-control" type="text" placeholder="Rechercher des développeurs ...">
        </div>
    </div>
    <div class="row mx-5">
        <table class="table  text-sm text-center text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100 ">

            <tr>
                <th style="width: 15%" >Developpeur</th>
                <th style="width: 25%">Lien git du projet</th>
                <th style="width: 15%" >Date et heure de dépot</th>
                <th style="width: 15%" >Note</th>
                <th style="width: 15%" >Remarque</th>
                <th style="width: 15%" >Action</th>
            </tr>
            </thead>
            @foreach($groupes as $row)
            <tr>
                <td style="width: 15%;">{{$row->groupe_nom}}</td>
                <th class="1/3" style="width: 25%;"><a href="{{$row->depot_lien_git}}" target="blank">{{$row->depot_lien_git}}</a></th>
                <td style="width: 15%;">{{$row->depot_date}}</td>
                <td style="width: 15%;">
                    @php
                       // $depots = App\Models\Depot::where('user_id',$row->id)->where('projet_id',$projet_id)->first();
                        //$this->rating = $depots->depot_note;
                    @endphp
                    @if($row->depot_note != 0)
                        @php
                            $rating =$row->depot_note ; 
                        @endphp
                    @endif
                    <div class="block max-w-3xl px-1 py-2 mx-auto">
                        <div class="flex space-x-1 rating">
                            <label for="star1">
                                <input hidden wire:model="rating" type="radio" id="star1" name="rating" value="1" />
                                <svg class="cursor-pointer block w-5 h-5 @if($rating >= 1 ) text-yellow-400 @else text-gray-300 @endif " fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                            </label>
                            <label for="star2">
                                <input hidden wire:model="rating" type="radio" id="star2" name="rating" value="2" />
                                <svg class="cursor-pointer block w-5 h-5 @if($rating >= 2 ) text-yellow-400 @else text-gray-300 @endif " fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                            </label>
                            <label for="star3">
                                <input hidden wire:model="rating" type="radio" id="star3" name="rating" value="3" />
                                <svg class="cursor-pointer block w-5 h-5 @if($rating >= 3 ) text-yellow-400 @else text-gray-300 @endif " fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                            </label>
                            <label for="star4">
                                <input hidden wire:model="rating" type="radio" id="star4" name="rating" value="4" />
                                <svg class="cursor-pointer block w-5 h-5 @if($rating >= 4 ) text-yellow-400 @else text-gray-300 @endif " fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                            </label>
                            <label for="star5">
                                <input hidden wire:model="rating" type="radio" id="star5" name="rating" value="5" />
                                <svg class="cursor-pointer block w-5 h-5 @if($rating >= 5 ) text-yellow-400 @else text-gray-300 @endif " fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                            </label>
                        </div>
                        @can('admin')
                        <div class="flex mt-2">
                        <button type="button" wire:click = "resetRate({{$row->id}})" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-2.5 mr-2 mb-2  dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Reset
                        </button>

                        <button type="button" wire:click = "rate({{$row->id}})" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg  text-sm px-2 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900">
                            Rate
                        </button>
                        </div>
                        @endcan
                    </div>
                </td>
                <td style="width: 15%;">
                    @if($update_remarque == false || $id_mod != $row->id)
                        @if($row->depot_remarque != "")
                                {{$row->depot_remarque}}
                            @endif

                        @can('admin')
                        <br>
                        <button type="button" wire:click = "editremarque({{$row->id}})" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-2 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            Modifier
                        </button>
                        @endcan
                    @else
                    @can('admin')
                        <textarea name="" id="{{$row->id}}" rows="5" class="text-black" wire:model = "depot_remarque">
                        </textarea>
                        <button type="button" wire:click = "resetRemarque({{$row->id}})" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-2.5 mr-2 mb-2  dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Reset
                        </button>

                        <button type="button" wire:click = "envoyerRemarque({{$row->id}})" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-2 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            Envoyer
                        </button>
                    @endcan
                    @endif
                    @error('depot_remarque')
                        <span class="text-sm text-red-500">{{$message}}</span>
                    @enderror
                </td>
                <td style="width:15%;">
                    @if($row->depot_isaccepted == 0)
                    <button type="button" wire:click = "gagnant({{$row->id}})" class="focus:outline-none text-white bg-green-700 mt-3 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-2 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Prendre 
                    </button>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
        <div class="d-flex pt-0 pt-2 border-primary justify-content-center">
          {{$groupes->links()}}
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
          title: "enregistré"
          });
      });
    </script>
</div>