<div class="mt-3">
    <span class="float-right"><lottie-player src="https://assets6.lottiefiles.com/packages/lf20_asket2d3.json"  background="transparent"  speed="1"  style="width: 100px; height: 100px;"  loop  autoplay></lottie-player></span>

    <div class="flex justify-center items-center">
    <h1 class="  text-transparent  bg-clip-text bg-gradient-to-r from-purple-400 to-pink-600  ">LEADERBOARD</h1>
    </div>

<div class="flex ">

        <div class=" rounded-md h-screen  shadow-sm bg-gray-700 w-1/3 ml-2 py-2 ">
            
            <div class="  pb-4" >
                <div class="sidebar ftco-animate  fadeInUp ftco-animated "  > 
                        <div class="sidebar-box ftco-animate fadeInUp ftco-animated" >
                            <h3 class=" sidebar-heading text-blue-400 " >Categories</h3>

                                <ul class="categories" >
                                    
                                    <li><a href="#" class=" nav-link font-base  " wire:click.prevent = "show_tout_categorie"  style="color: #e5e7eb">Toutes catégories <span>({{$nbre_categorie}})</span></a></li>
                                    @foreach($categorie as $categ)
                                    <li wire:ignore>
                                        <button type="button" wire:click="resultParCategorie({{$categ->categorie_id}})" style="color: #e5e7eb" class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group  dark:text-white hover:bg-gray-700"
                                             aria-controls="dropdown-example{{$categ->categorie_id}}" data-collapse-toggle="dropdown-example{{$categ->categorie_id}}">
                                            <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>{{$categ->categorie_label}} <span>({{$categ->nbre_projet}})</span>
                                        </button>
                                        <ul id="dropdown-example{{$categ->categorie_id}}" class="hidden py-2 space-y-2">
                                            @php
                                            $projets = App\Models\Projet::where('categorie_id',$categ->categorie_id)
                                                                        ->orderBy('projet_titre', 'ASC')
                                                                        ->get()
                                            @endphp
                                            @foreach($projets as $row)
                                            <li>
                                                <a href="#" wire:click.prevent="resultParProjet({{$row->projet_id}})" style="color: #c084fc"
                                                    class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group  hover:bg-gray-700 pl-11">
                                                    {{$row->projet_titre}}
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </li>

                                    {{--
                                    <li class="nav-item has-submenu" >
                                        <a href="" class="  nav-link " wire:click="resultParCategorie({{$categ->categorie_id}})" style="color: #e5e7eb">{{$categ->categorie_label}} <span>({{$categ->nbre_projet}})</span></a>
                                        <ul class="submenu collapse"  >
                                            @php
                                                $projets = App\Models\Projet::where('categorie_id',$categ->categorie_id)
                                                                            ->orderBy('projet_titre', 'ASC')
                                                                            ->get()
                                            @endphp
                                            @foreach($projets as $row)
                                            <li >
                                                <a wire:click.prevent="resultParProjet({{$row->projet_id}})" class="nav-link " style="color: #c084fc" href="#">
                                                {{$row->projet_titre}}
                                                
                                                </a>
                                            </li>
                                            @endforeach
                                            
                                        </ul>
                                    </li>
                                        --}}

                                    @endforeach
                                </ul>
                        </div>
                </div>
            </div>
  
    </div>
    <div class="overflow-x-auto w-full mx-5 ">
        <div>
            <h3 class=" my-2 text-center text-base font-bold text-lg text-blue-400">
                @if (!is_null($categorie_label))
                    Catégorie {{$categorie_label}}<br>
                @endif

                @if(!is_null($projet_titre))
                    Projet {{$projet_titre}}
                @endif

                @if(is_null($categorie_label) && is_null($projet_titre))
                Toutes les catégories
                @endif
        </h3>
        </div>
        <table class="w-full text-sm text-left text-gray-200">
            <thead class="text-xs  uppercase bg-gray-600 text-gray-200">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        Rang
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Developpeurs
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Nombre de Projets
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Team
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Note
                    </th>
                    
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach($resultat as $row)
                <tr class=" border-b bg-gray-700 border-gray-500">
                    <td class="py-4 px-6">
                        {{$i++}}<sup>e</sup>
                    </td>
                    <td scope="row" class="py-2 px-6 font-medium text-gray-100 whitespace-nowrap ">
                        <div class="flow-root">
                            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                                <div class="">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <a href="/user_profile?user_id={{$row->id}}"><img class="image rounded-circle " src="{{asset('/storage/profile/'.$row->avatar)}}" alt="profile_image" style="width: 50px;height: 50px;  "></a>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            
                                            <p class="text-sm text-gray-200 truncate dark:text-gray-400">
                                                {{$row->name}}
                                            </p>
                                            <p class="text-sm font-medium capitalize text-gray-100 truncate dark:text-white">
                                                {{$row->developpeur_a_propos}}
                                            </p>
                                        </div>
                                        
                                    </div>
                            
                                </div>

                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-6">
                        <div class="flex">
                            <span class="mr-1">
                                {{$row->nbre_projet}}
                            </span>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                                  </svg>                                  
                            </span>
                        </div>
                    </td>
                    <td class="py-4 px-6">
                        {{$row->developpeur_etablissement}}
                    </td>
                    <td class="py-4 px-6">
                        <div class="flex">
                            <span class="mr-1">
                                {{$row->nbre_etoile}}
                            </span>
                            <span>
                                <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>First star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            </span>
                        </div>

                    </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
    
    

</div>
</div>
