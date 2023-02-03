<div >
    <style>
@keyframes bounce {
  0%, 100% {
    transform: translateY(-25%);
    animation-timing-function: cubic-bezier(0.8,0,1,1);
  }
  50% {
    transform: none;
    animation-timing-function: cubic-bezier(0,0,0.2,1);
  }
}
.hover\:animate-bounce:hover {
  animation: bounce 0.5s infinite;
}

@keyframes fadeIn {
  0% {
    opacity: 0;
  }

  100% {
    opacity: 1;
  }
}

.animate-fadeIn {
  animation: fadeIn 1s ease-in forwards;
}


</style>
    <div class="mt-5 w-full" id="">
        
        <section class=" ">
                <div class="flex ">
                    <aside class="  h-screen overflow-y-auto fixed rounded-lg bg-gray-700" aria-label="Sidebar">
                        <div class=" py-4 px-3  ">
                                <h4 class="text-gray-200">Filtres</h4>

                                <h5 style="color:#f472b6">Type de projet</h5>
                                <ul class="space-y-1 max-w-md list-none">
                                    <li class="text-gray-200">
                                        <div class="flex items-center mr-4">
                                            <input  id="purple-checkbox" wire:model = "type_projet" name ="type_projet" type="checkbox" value="1" class="w-4 h-4 text-purple-600 rounded  focus:ring-purple-600 ring-offset-gray-800 focus:ring-2 bg-gray-700 border-2 border-gray-300">
                                            <label for="purple-checkbox" class="ml-2 text-sm font-medium text-gray-300">
                                                Premium
                                            </label>
                                        </div>
                                        
                                    </li>
                                    <li class="text-gray-200">
                                        <div class="flex items-center mr-4">
                                            <input  id="purple-checkbox" wire:model = "type_projet" name ="type_projet" type="checkbox" value="0" class="w-4 h-4 text-purple-600 rounded  focus:ring-purple-600 ring-offset-gray-800 focus:ring-2 bg-gray-700 border-2 border-gray-300">
                                            <label for="purple-checkbox" class="ml-2 text-sm font-medium text-gray-300">
                                                Basic
                                            </label>
                                        </div>
                                        
                                    </li>
                                    
                                </ul>

                                <h5 style="color:#f472b6">Categorie du projet</h5>
                                <ul class="space-y-1 max-w-md list-none">
                                    @foreach($categorie as $row)
                                    <li class="text-gray-200">
                                        <div class="flex items-center mr-4">
                                            <input  id="purple-checkbox" type="checkbox" name = "categorie_filtre" wire:model = "categorie_filtre" value="{{$row->categorie_id}}" class="w-4 h-4 text-purple-600 rounded  focus:ring-purple-600 ring-offset-gray-800 focus:ring-2 bg-gray-700 border-2 border-gray-300">
                                            <label for="purple-checkbox" class="ml-2 text-sm font-medium text-gray-300">
                                                {{$row->categorie_label}}</label>
                                        </div>
                                        
                                    </li>
                                    
                                    @endforeach
                                </ul>
                                <h5 style="color:#f472b6">Budget </h5>
                                <label class="text-gray-200">min</label>
                                <div class="flex flex-wrap items-stretch w-full mb-4 relative">
                                    <input type="text" wire:model = "budget_min" class="flex-shrink flex-grow flex-auto leading-normal w-px flex-1 border h-10 border-grey-light rounded rounded-r-none px-3 relative" placeholder="0">
                                    <div class="flex -mr-px">
                                        <span class="flex items-center leading-normal bg-grey-lighter rounded rounded-l-none border border-l-0 border-grey-light px-3 whitespace-no-wrap text-gray-200 text-sm">Ariary</span>
                                    </div>	
                                </div>	

                                <label class="text-gray-200">max</label>
                                <div class="flex flex-wrap items-stretch w-full mb-4 relative">
                                    <input type="text" wire:model = "budget_max" class="flex-shrink flex-grow flex-auto leading-normal w-px flex-1 border h-10 border-grey-light rounded rounded-r-none px-3 relative" placeholder="2 000 000+ ">
                                    <div class="flex -mr-px">
                                        <span class="flex items-center leading-normal bg-grey-lighter rounded rounded-l-none border border-l-0 border-grey-light px-3 whitespace-no-wrap text-gray-200 text-sm">Ariary</span>
                                    </div>	
                                </div>
                        
                                    
                                <h5 style="color:#f472b6">Compétence</h5>
                                <ul class="space-y-1 max-w-md list-none">
                                    @foreach($competence as $row)
                                    <li class="text-gray-200">
                                        <div class="flex items-center mr-4">
                                            <input  id="purple-checkbox" wire:model = "competence_filtre" name ="competence_filtre" type="checkbox" value="{{$row->competence_id}}" class="w-4 h-4 text-purple-600 rounded  focus:ring-purple-600 ring-offset-gray-800 focus:ring-2 bg-gray-700 border-2 border-gray-300">
                                            <label for="purple-checkbox" class="ml-2 text-sm font-medium text-gray-300">
                                                {{$row->competence_label}}</label>
                                        </div>
                                        
                                    </li>
                                    
                                    @endforeach
                                </ul>
                        </div>
                    </aside>
                    <div class="  flex-1 shadow-lg bg-gray-700 rounded-lg ml-60	p-5  ">
                        <div class="row  	">
                            @if(sizeof($projets) == 0)
                            <p class="text-center  text-gray-300	">Il n'y a pas encore de projets qui conviennent à votre compétence. <br>Mais Vous pouvez ajouter des competences dans votre profile.</p>
                            <div class="flex items-center justify-center">
                                <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                                <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_hl5n0bwb.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop  autoplay></lottie-player>
                            </div>
                            @endif
                    
                            <!--debut parcours-->
                        <div class="divide-y divide-gray-300 ">
                           <h3 class="text-center text-gray-200 mb-2 text-base">Projets pour vous</h3>
                           <div class="mt-3">
                            @foreach($projets as $projet)
                            <div class="col-md-12 mb-5 ">
                                <div class=" mt-3 ftco-animate d-flex fadeInUp ftco-animated">
                                    <img class="img img-2 shadow-lg shadow-red-500/50" src="{{asset('/storage/categorieImage/'.$projet->categorie_illustration)}}" alt="illustration de categorie" style="width:150px;height:150px;border-radius:50%">
                                    <div class="text text-2 pl-md-4 ">
                                        
                                        <h3 class="mb-2 text-transparent flex bg-clip-text bg-gradient-to-r from-purple-400 to-pink-600 " >
                                            <span>{{$projet->projet_titre}}</span>
                                            @if($projet->projet_premium == 1)
                                            <span class="mx-2">
                                                <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                                                <lottie-player src="https://assets8.lottiefiles.com/packages/lf20_qzexyedo.json"  background="transparent"  speed="1"  style="width: 45px; height: 45px;"  loop  autoplay></lottie-player>
                                            </span>
                                            @endif
                                        </h3>
                                        <a href="/detail_projet?projet_id={{$projet->projet_id}}"  >Voir les details</a>
                                        <p class="mb-2 d-none  text-gray-300" id = "description{{$projet->projet_id}}" >{{$projet->projet_description}}</p>
                                        <p class="mb-2 text-gray-300"><b>Budget :</b>
                                        @if(App\Models\CDO::where('user_id', $projet->created_by)->exists())
                                            @if($projet->projet_premium == 1)
                                                @php
                                                    $commission = App\Models\Commission::where('commission_type','premium')->first();
                                                @endphp
                                            @else
                                                @php
                                                    $commission = App\Models\Commission::where('commission_type','basique')->first();
                                                @endphp
                                            @endif
                                            @if(!is_null($commission))
                                             {{$projet->projet_budget - ($projet->projet_budget * ($commission->commission_tarif/100))}} 
                                             @else
                                             {{$projet->projet_budget}}
                                            @endif
                                        @else
                                            {{$projet->projet_budget}}
                                        @endif
                                             Ariary</p>
                                        <p class="mb-2 text-gray-300"><b>Deadline :</b> {{$projet->projet_date_fin}}</p>
                                        @php
                                            $cdo = App\Models\User::where('id',$projet->created_by)->first();
                                        @endphp
                                        <p class="mb-2 text-gray-400">Déposé par {{$cdo->name}} </p>
                                        @php 
                                        
                                        $datetime = Carbon\Carbon::now()->setTimezone('Turkey');
                                                $date1 = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $projet->projet_date_fin);
                                                $date2 = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $datetime->toDateTimeString());
                                        
                                                $result = $date1->lt($date2);
                                                
                                        @endphp
                                         @if($result )
                                            <p class="text-red-600">Terminé</p>
                                        @else

                                            @if(App\Models\Participation::where('user_id',Illuminate\Support\Facades\Auth::user()->id)->where('projet_id',$projet->projet_id)->exists())
                                                <p class="text-green-600">Déjà participant </p>
                                            @else

                                                <button  class=" text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 rounded-full hover:animate-bounce " 
                                                wire:click = "participer({{$projet->projet_id}},{{$projet->projet_premium}})">Participer</button>
                                            @endif 
                                        @endif

                                    </div>
                                    
                                </div>
                            </div>
                            @endforeach
                        <!--fin parcours-->
                        
                        <div class="d-flex pt-0 pt-2 border-primary justify-content-center">
                            {{$projets->links()}}
                          </div>
                        </div>
                    </div>
                    </div>
                    <a href="/decouvrir" class="float-right">Découvrir >></a>

                </div>
                
            </div>
            
        </section>
    </div>
    <script>

        window.addEventListener('nonpremium', event => {
            Swal.fire({
            title: '<strong>Ce projet est reservé aux developpeurs premiums</strong>',
            icon: 'info',
            html:
                'abonnez-vous en tant que developpeur premium pour accéder à ce projet',
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText:
            '<a href = "/validation"> Devenir premium</a>'            
            });
        });

        const callback = function (entries) {
        entries.forEach((entry) => {
        console.log(entry);

        if (entry.isIntersecting) {
            entry.target.classList.add("animate-fadeIn");
            
        } else {
            entry.target.classList.remove("animate-fadeIn");
        }
        });
        };

        const observer = new IntersectionObserver(callback);

        const targets = document.querySelectorAll(".js-show-on-scroll");
        targets.forEach(function (target) {
        target.classList.add("opacity-0");
        observer.observe(target);
        });


        function afficher_description(projet_id)
        {
            document.getElementById('description'+projet_id).classList.toggle('d-none');
            return false;
        }
    </script>
</div>
