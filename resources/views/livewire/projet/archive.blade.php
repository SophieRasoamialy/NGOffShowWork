<div>
    
    <div class=" flex mb-3 row ">
        <div class=" form-group   col-md-3">
            <label for="projet">Titre du Projet</label>
            <select  class="form-control" id = "projet_id" wire:model = "projet_id">
                <option value="">Choisir un projet</option>
                @foreach($projets as $projet)
                    <option value= {{$projet->projet_id}} >{{$projet->projet_titre}}</option>
                @endforeach
            </select>
        </div>
        <div>
        <h4 class="text-center text-lg text-green-800">Archives</h4>
        </div>

    </div>
    <div >
        <div class="row mb-3">
            <div class="col-8"></div>
            <div class="col-4">
                <input wire:model = "search"  class="form-control" type="text" placeholder="Rechercher  ...">
            </div>
        </div>
        <div class="row mt-2 mx-5">
            <table class="table  mx-auto text-sm text-justify  text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                <tr >
                    <th>Developpeur</th>
                    <th>Lien git du projet</th>
                    <th>Note</th>
                    <th>Remarque</th>

                </tr>
                </thead> 
                
                @foreach($archive as $row)
            <tr>
                <td>
                        <div class="flow-root">
                            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                                <div class="py-3 sm:py-4">
                                    <div class="flex items-center space-x-4">
                                        @if($row->depot_isaccepted == 1)
                                            <img src="{{asset('/storage/images/trophy.png')}}" alt="" class="w-12">
                                        @endif
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
                        </div>
                </td>
                <td><a href="{{$row->depot_lien_git}}" target="blank">{{$row->depot_lien_git}}</a></td>
                <td>
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
                    </div>
                </td>
                <td>
                        @if($row->depot_remarque != "")
                                {{$row->depot_remarque}}
                        @endif
                </td>
            </tr>
            @endforeach
                
            </table>
            <div class="d-flex pt-0 pt-2 border-primary justify-content-center">
                {{$archive->links()}}
              </div>
            
    
        </div>
   
    
    </div>
    
    </div>
    