<div>
    <!-- component -->
<style>

</style>
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>



<div class="">
 <div class="w-full  ">
 
    <div class="container mx-auto my-5 p-5 ">
        <div class="md:flex no-wrap md:-mx-2 ">
            <!-- Left Side -->
            <div class="w-full md:w-3/12 md:mx-2">
                <!-- Profile Card -->
                <div class="bg-gray-700 p-3 border-t-4 border-purple-400">
                    <div class="image overflow-hidden">
                        <img class="h-auto w-full mx-auto"
                            src="{{asset('/storage/profile/'.$developpeur->avatar)}}"
                            alt="">
                    </div>
                    <h1 class="text-gray-200  text-center text-xl leading-8 my-1 caiptalize">{{$developpeur->name}}</h1>
                    <h1 class="text-gray-200 font-bold text-center text-xl leading-8 my-1 capitalize">{{$developpeur->developpeur_a_propos}}</h1>
                    
                </div>
                <!-- End of profile card -->
                <div class="my-4"></div>
                <!-- Friends card -->
                <div class="bg-gray-700 p-3 hover:shadow">
                    <div class="flex items-center space-x-3 font-semibold text-gray-900 text-xl leading-8">
                        <span class="text-green-500">
                            <svg class="h-5 fill-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </span>
                    </div>
                    @php
                        setlocale(LC_TIME, 'fr_FR');

                        $timestamp = strtotime($developpeur->created_at);
                        $mois = strftime('%B', $timestamp);
                        $annee = date('Y', $timestamp);

                    @endphp 
                    
                    <p class="text-gray-400">Membre depuis {{$mois}} {{$annee}}</p>
                </div>
                <!-- End of friends card -->
            </div>
            <!-- Right Side -->
            <div class="w-full md:w-9/12 mx-2 h-64">
                <!-- Profile tab -->
                <!-- About Section -->
                @php
                    $admin = App\Models\Admin::first();
                @endphp
                @if(auth()->user()->id == $developpeur->user_id || auth()->user()->id == $admin->user_id)
                    <!-- Modal toggle -->
                    @if(auth()->user()->id == $developpeur->user_id )
                    <button type="button" wire:click.prevent = "editAbout({{$developpeur->user_id}})" class=" flex mt-3 mr-4 float-right text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2" 
                    data-modal-toggle="staticModal">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                          </svg>                          
                        <span>Modifier</span> 
                    </button>
                    @endif
                <div class="bg-gray-700 p-5 shadow-md rounded-sm">
                    <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                        <span clas="text-white">
                            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span>
                        <span class="tracking-wide text-white">About</span>
                        
                    </div>
                    <div class="text-gray-300">
                        <div class="grid md:grid-cols-2 text-sm">
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold ">First Name</div>
                                <div class="px-4 py-2 uppercase">{{$developpeur->firstname}}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold ">Last Name</div>
                                <div class="px-4 py-2 capitalize">{{$developpeur->lastname}}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Email.</div>
                                <div class="px-4 py-2">
                                    <a class="text-blue-400" href="mailto:jane@example.com">{{$developpeur->email}}</a>
                                </div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Contact No.</div>
                                <div class="px-4 py-2">{{$developpeur->developpeur_contact}}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Basique</div>
                                <div class="px-4 py-2">
                                    @if ($developpeur->developpeurs_isvalide == 0)
                                        Non
                                    @else
                                        Oui
                                    @endif
                                </div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Premium</div>
                                <div class="px-4 py-2">
                                    @if ($developpeur->premium == 0)
                                        Non
                                    @else
                                        Oui
                                    @endif
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                @endif
                <!-- End of about section -->

                <div class="my-4"></div>

                {{--Competence--}}
                <div class="grid grid-cols-1 bg-gray-700 p-3 my-2 shadow-sm rounded-sm">
                    <div class="px-2">
                        @if(auth()->user()->id == $developpeur->user_id)
                            <!-- Modal toggle -->
                            <button type="button" class="  float-right text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2"
                            data-modal-toggle="competence">
                                <span>Ajouter</span> 
                            </button>
                        @endif
                        <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8 mb-3">
                            <span clas="text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                                </svg>                                  
                            </span>
                            <span class="tracking-wide text-white">Compétence</span>
                        </div>
                        <ul class="list-inside space-y-2">
                            @php
                                $competence = App\Models\Competence::join('developpeur_competences','developpeur_competences.competence_id','=','competences.competence_id')
                                                                    ->where('developpeur_competences.user_id',$developpeur->user_id)
                                                                    ->get();
                            @endphp                 
                            @foreach($competence as $row)
                            
                            <li class="px-2">
                                <span id="badge-dismiss-default" class="inline-flex items-center py-1 px-2 mr-2 text-sm font-medium text-blue-800 bg-blue-100 rounded dark:bg-blue-200 dark:text-blue-800">
                                    {{$row->competence_label}}

                                    @if(auth()->user()->id == $developpeur->user_id) 
                                    <button type="button" wire:click = "supprimerCompetence({{$row->competence_id}})" class="inline-flex items-center p-0.5 ml-2 text-sm text-blue-400 bg-transparent rounded-sm hover:bg-blue-200 hover:text-blue-900 dark:hover:bg-blue-300 dark:hover:text-blue-900" data-dismiss-target="#badge-dismiss-default" aria-label="Remove">
                                        <svg aria-hidden="true" class="w-3.5 h-3.5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        <span class="sr-only">Remove badge</span>
                                    </button>
                                    @endif
                                  </span>
                                  
                            </li>
                            @endforeach
                            {{--@endforeach--}}
                            
                        </ul>
                    </div>
                </div>

                <div class="">

                    {{--EXPERIENCE--}}
                    <div class="grid grid-cols-1 bg-gray-700 p-3 my-2 shadow-sm rounded-sm">
                        <div class="px-2">
                            @if(auth()->user()->id == $developpeur->user_id)
                                <!-- Modal toggle -->
                                <button type="button" class="  float-right text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2"
                                data-modal-toggle="experience">
                                                            
                                    <span>Ajouter</span> 
                                </button>
                            @endif
                            <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8 mb-3">
                                <span clas="text-gray-500">
                                    <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </span>
                                <span class="tracking-wide text-white">Experience</span>
                            </div>
                            <ul class="list-inside space-y-2">
           
                                @php
                                $value = json_decode($developpeur->developpeur_experience,true); 
                                //$value = json_decode($valtemp,true); 
                                $count = sizeof($value);
                                @endphp
                                @if($value != json_encode([])  && $value != array(1 => "{}"))
                                @for ($i = 0; $i < $count; $i++)
                                
                                @php
                                $val = json_decode($value[$i],true);
                                //dd(json_decode($value[1],true))
                                @endphp
                                
                                @if ($val == [])
                                    @break
                                @endif
                                @if(auth()->user()->id == $developpeur->user_id)
                                    <button id="dropdownMenuIconHorizontalButton" data-dropdown-toggle="dropdownDotsHorizontal" class="inline-flex items-center  text-sm float-right font-medium text-center   rounded-lg  focus:ring-4 focus:outline-none text-white bg-gray-700 hover:bg-gray-800 focus:ring-gray-600" type="button"> 
                                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path></svg>
                                    
                                </button>
                                
                                  <!-- Dropdown menu -->
                                  <div id="dropdownDotsHorizontal" class="hidden z-10 w-44 bg-gray-700 border border-gray-800 rounded divide-y  shadow divide-gray-600" >
                                      <ul class="py-1 text-sm text-gray-200" aria-labelledby="dropdownMenuIconHorizontalButton">
                                        <li>
                                          <a href="#" wire:click.prevent = "editExperience({{$value[$i]}},{{$i}})" data-modal-toggle="experience" class="block py-2 px-4 hover:bg-gray-600 hover:text-white">Modifier</a>
                                        </li>
                                        <li>
                                          <a href="#" wire:click.prevent = "supprimerExperience({{$i}})" class="block py-2 px-4 hover:bg-gray-600 hover:text-white">Supprimer</a>
                                        </li>
                                        
                                      </ul>
                                  </div>
                                  @endif
                                <li class="px-2">
                                    
                                    <div class=" font-bold capitalize" style="color:#f472b6"> {{$val["titre"]}}</div>
                                    <div class="text-gray-300 font-bold">{{$val["entreprise_nom"]}}</div>
                                    <div class="text-gray-300 text-xs">
                                        De {{$val["experience_debut_mois"]}} {{$val["experience_debut_annee"]}} Jusqu'à
                                        @if ($val["experience_fin_mois"] == 0 && $val["experience_fin_annee"] == 0)
                                            Maintenant
                                        @else
                                            {{$val["experience_fin_mois"]}} {{$val["experience_fin_annee"]}} 
                                        @endif
                                    </div>
                                    <div class="text-gray-300">{{$val["description"]}}</div>
                                </li>
                                <hr class="dropdown-divider bg-gray-400 ">
                                @endfor

                                @else
                                <div class="text-gray-300">Pas d'expérience ajouté</div> 
                                @endif
                                {{--@endforeach--}}
                                
                            </ul>
                        </div>
                    </div>



                    {{--EDUCATION--}}
                    <div class="grid grid-cols-1 bg-gray-700 p-3 my-2 shadow-sm rounded-sm">  
                                      
                        <div class="px-2">
                            @if(auth()->user()->id == $developpeur->user_id)
                                <!-- Modal toggle -->
                                <button type="button" class="  float-right text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2"
                                data-modal-toggle="education">
                                    <span>Ajouter</span> 
                                </button>
                            @endif
                            <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8 mb-3">
                                <span clas="text-green-500">
                                    <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path fill="#fff" d="M12 14l9-5-9-5-9 5 9 5z" />
                                        <path fill="#fff"
                                            d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                                    </svg>
                                </span>
                                <span class="tracking-wide text-white">Education</span>
                            </div>
                            <ul class="list-inside space-y-2">
                                @php
                                $education = json_decode($developpeur->developpeur_education,true);
                                $count_education = sizeof($education)
                                @endphp
                                @if($education != json_encode([])  && $education != array(1 => "{}"))

                                @for($i = 0; $i<$count_education; $i++)
                                @php
                                    $val_education = json_decode($education[$i],true);
                                @endphp
                                @if($val_education == [])
                                    @break
                                @endif
                                @if(auth()->user()->id == $developpeur->user_id)
                                    <button id="dropdownMenuIconHorizontalButtonE" data-dropdown-toggle="dropdownDotsHorizontalEdc" class="inline-flex items-center  text-sm float-right font-medium text-center   rounded-lg  focus:ring-4 focus:outline-none text-white bg-gray-700 hover:bg-gray-800 focus:ring-gray-600" type="button"> 
                                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path></svg>
                                    </button>
                                  
                                    <!-- Dropdown menu -->
                                    <div id="dropdownDotsHorizontalEdc" class="hidden z-10 w-44 bg-gray-700 border border-gray-800 rounded divide-y  shadow divide-gray-600">
                                        <ul class="py-1 text-sm text-gray-200" aria-labelledby="dropdownMenuIconHorizontalButtonE">
                                            <li>
                                            <a href="#" wire:click.prevent = "editEducation({{$education[$i]}},{{$i}})" data-modal-toggle="education" class="block py-2 px-4 hover:bg-gray-600 hover:text-white">
                                                Modifier
                                            </a>
                                            </li>
                                            <li>
                                            <a href="#" wire:click.prevent = "supprimerEducation({{$i}})" class="block py-2 px-4 hover:bg-gray-600 hover:text-white">Supprimer</a>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                @endif
                                <li >
                                    <div class=" font-bold"  style="color:#f472b6">{{$val_education['diplome']}}</div>
                                    <div class="text-gray-300 font-bold">{{$val_education['universite']}}</div>
                                    <div class="text-gray-300 text-xs"> De {{$val_education['education_debut_annee']}} Jusqu'à
                                    @if ($val_education['education_fin_annee'] == 0)
                                       Maintenant
                                    @else
                                         {{$val_education['education_fin_annee']}}
                                    @endif
                                </div>
                                </li>
                                <hr class="dropdown-divider bg-gray-400 ">

                                @endfor
                                @else
                                <div class="text-gray-300">Pas d'education ajoutée</div> 
                                @endif
                            </ul>
                        </div>
                    </div>

                    {{--QUALIFICATION--}}
                    <div class="grid grid-cols-1 bg-gray-700 p-3 my-2 shadow-sm rounded-sm"> 
                        <div class="px-2">

                            @if(auth()->user()->id == $developpeur->user_id)
                                <!-- Modal toggle -->
                                <button type="button" class="  float-right text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2"
                                data-modal-toggle="qualification">
                                                            
                                    <span>Ajouter</span> 
                                </button>
                            @endif

                            <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8 mb-3">
                                <span clas="text-green-500">
                                    <img src="{{asset('/storage/images/certificate.png')}}" alt="">
                                </span>
                                <span class="tracking-wide text-white">Qualification</span>
                            </div>
                            <ul class="list-inside space-y-2"> 
                                @php
                                $qualification = json_decode($developpeur->developpeur_qualification,true);
                                $count_qualification = sizeof($qualification);
                                @endphp
                                
                                @if($qualification != json_encode([]) && $qualification != array(1 => "{}"))

                                @for($i=0;$i<$count_qualification;$i++)

                                @php
                                    $val_qualification  = json_decode($qualification[$i],true);
                                @endphp

                                @if ($val_qualification == [] )
                                    @break
                                @endif

                                @if(auth()->user()->id == $developpeur->user_id)
                                    <button id="dropdownMenuIconHorizontalButtonQ" data-dropdown-toggle="dropdownDotsHorizontalQ" class="inline-flex items-center p-2 text-sm float-right font-medium text-center   rounded-lg  focus:ring-4 focus:outline-none text-white bg-gray-700 hover:bg-gray-800 focus:ring-gray-600" type="button"> 
                                        <svg class="w-6 h-6" aria-O0hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path></svg>
                                    </button>
                                    
                                    <!-- Dropdown menu -->
                                    <div id="dropdownDotsHorizontalQ" class="hidden z-10 w-44 bg-gray-700 border border-gray-800 rounded divide-y  shadow divide-gray-600">
                                        <ul class="py-1 text-sm text-gray-200" aria-labelledby="dropdownMenuIconHorizontalButtonQ">
                                            <li>
                                            <a href="#" wire:click.prevent = "editQualification({{$qualification[$i]}},{{$i}})" data-modal-toggle="qualification" class="block py-2 px-4 hover:bg-gray-600 hover:text-white">
                                                Modifier
                                            </a>
                                            </li>
                                            <li>
                                            <a href="#" wire:click = "supprimerQualification({{$i}})" class="block py-2 px-4 hover:bg-gray-600 hover:text-white">Supprimer</a>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                @endif

                                <li>
                                    <div class="" style="color:#f472b6">{{$val_qualification['certificat']}}</div>
                                    <div class="text-gray-300 font-bold">{{$val_qualification['organisation']}}</div>
                                    <div class="text-gray-300 text-xs">{{$val_qualification['qualification_annee']}}</div>
                                    <div class="text-gray-300">{{$val_qualification['description']}}</div>
                                </li>
                                <hr class="dropdown-divider bg-gray-400 ">

                                @endfor
                                @else
                                <div class="text-gray-300">Pas de qualifictaion ajoutée</div>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@include('livewire.developpeur.profileModal.about')
@include('livewire.developpeur.profileModal.education')
@include('livewire.developpeur.profileModal.experience')
@include('livewire.developpeur.profileModal.qualification')
@include('livewire.developpeur.profileModal.competence')

<script>
    window.addEventListener('hide_modal_about', event => {

    });
    
</script>
</div>