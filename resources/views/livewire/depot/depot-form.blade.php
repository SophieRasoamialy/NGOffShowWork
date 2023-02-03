<div >
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/timecircles/1.5.3/TimeCircles.min.js" integrity="sha512-FofOhk0jW4BYQ6CFM9iJutqL2qLk6hjZ9YrS2/OnkqkD5V4HFnhTNIFSAhzP3x//AD5OzVMO8dayImv06fq0jA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @if($selected_projet == false )
    <h4 class="text-center mt-10 mb-5 text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-600">Selectionner le projet que vous voulez deposer ! </h4>
    @if(sizeof($projets) == 0)
        <p class="text-center italic text-red-600	">Veuiller d'abord participer à un projet pour pouvoir deposer.</p>
    @endif

    <div class=" bg-gray-700 mx-auto p-4 w-3/4  rounded-lg border shadow-md sm:p-8  border-gray-700" >
        <div class="flex justify-between items-center ">
            <h5 class="text-xl font-bold leading-none text-gray-400 dark:text-white">Titre</h5>
            <p  class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                Temps restants
            </p>
        </div>
        <div  class="flow-root ">
                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($projets as $row)
                    <li class="py-3 sm:py-4 mb-3">
                        <div class="flex items-center space-x-4 mb-3">
                            
                            <div class="flex-1 min-w-0">
                                <p class="text-xl font-medium  truncate dark:text-white " style="color:antiquewhite">
                                    {{$row->projet_titre}}
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-400 dark:text-white" >
                                @php
                                            $date_fin = $row->projet_date_fin;
                                            $date_reste = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date_fin)->diffForHumans([
                                                'parts' => 4,
                                                'join' => ',',
                                                'short' => true,
                                            ]);
                                            /*date_default_timezone_set('Turkey');
                                            $projet_id = $row->projet_id;
                                            $date_fin = $row->projet_date_fin;
                                            //datefin
                                            $date_time = datetime::createfromformat('Y-m-d H:i:s',$date_fin);
                                            $heures   = $date_time->format('H') - date("H");  // les heures < 24
                                            $minutes  = $date_time->format('i') - date("i")  + 1 ;   // les minutes  < 60
                                            $secondes = $date_time->format('s') - date("s");  // les secondes  < 60

                                            $annee = $date_time->format('Y');  
                                            $mois  = $date_time->format('m');  
                                            $jour  = $date_time->format('d');  

                                            $secondes = mktime(date("H") + $heures,
                                            date("i") + $minutes,
                                            date("s") + $secondes,
                                            $mois,
                                            $jour,
                                            $annee
                                            ) - time();*/

                                @endphp
                                    <script>
                                        /*var timer = setInterval(() => {
                                            document.getElementById('date_reste').innerHTML ={{$date_reste}};
                                        }, 1000);*/
                                        
                                    
                                    /*
                                    var idtemp = "minutes"+{{$projet_id}};
                                    var timer =setInterval('CompteaRebour'+{{$projet_id}}+'("'+idtemp+'")',1000);
                                    function CompteaRebour{{$projet_id}}(id){

                                    temps-- ;
                                    j = parseInt(temps/86400) ;
                                    h = parseInt((temps%86400)/3600)  ;
                                    m = parseInt((temps%3600)/60) ;
                                    s = parseInt((temps%3600)%60) ;
                                    document.getElementById(id).innerHTML=  (j<10 ? "0"+j : j) + '  j :  ' +
                                                                            (h<10 ? "0"+h : h) + '  h :  ' +
                                                                            (m<10 ? "0"+m : m) + ' mn : ' +
                                                                            (s<10 ? "0"+s : s) + ' s ';
                                    if ((s == 0 && m ==0 && h ==0)) {
                                    clearInterval(timer);
                                    window.location.reload();
                                    }
                                    }*/

                                </script> 
                                <div   class="  font-mono px-3 py-3 text-sm font-bold leading-6 rounded-lg flex items-center justify-center  shadow-lg">
                                <p id="date_reste"  class="text-white">
                                    {{$date_reste}}
                                </p>
                                </div>
                            </div>
                        </div>
                        <figcaption class="flex justify-center items-center space-x-3">
                            <div class="space-y-0.5 mt-2 font-medium dark:text-white text-left">
                                <button type="button" wire:click.prevent = "selectProjet({{$row->projet_id}})" id="btn_ok" class="relative text-gray-400 inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium  rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-800" >
                                    <span class="relative px-5  py-2.5 transition-all ease-in duration-75  bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                        Selectioner
                                    </span>
                                </button>
                            </div>
                        </figcaption> 
                    </li>
                    @endforeach
                    
                    
                </ul>
        </div>
    </div>
    @else
    <div class="bg-gray-700 mx-auto w-1/2 border border-white rounded-lg my-5 p-3">
    <h4 class="text-center mt-10 mb-5 text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-600" >Déposer ici le lien git de votre projet  </h4>
    <p class="text-center italic text-gray-400" >N'oubliez pas de mettre un manuel d'utilisation de ton projet</p>

    <div class="flex justify-center">
        <div class="mb-3 xl:w-96">
          <label for="exampleURL0" class="form-label inline-block mb-2 text-gray-400"
            >Lien git</label
          >
          <input
            type="url"
            class="
              form-control
              block
              w-full
              px-3
              py-1.5
              text-base
              font-normal
              text-gray-700
              bg-white bg-clip-padding
              border border-solid border-gray-300
              rounded
              transition
              ease-in-out
              m-0
              focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
            "
            id="depot_lien_git" name = "depot_lien_git"
            wire:model="depot_lien_git"
          />
          @error('depot_lien_git') <span class="text-danger">{{$message}}</span>@enderror
        </div>
      </div>

    <figcaption class="flex justify-center items-center space-x-3">
        <div class="space-y-0.5 mt-2 font-medium dark:text-white text-left">
            <button  wire:click.prevent = "annuler_select_groupe" class="text-white   focus:outline-none focus:ring-4  font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 bg-gray-900 hover:bg-gray-700 focus:ring-gray-600 border border-gray-500"><i class='bx bx-arrow-back'></i>Retour</button>
            <button type="button" wire:click.prevent = "deposer" class="relative text-gray-400 inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium  rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-800" >
                <span class="relative px-5  py-2.5 transition-all ease-in duration-75  bg-gray-900 rounded-md group-hover:bg-opacity-0">
                    <i class='bx bx-down-arrow-alt'></i>Ajouter
                </span>
            </button>

        </div>
    </figcaption>
    </div>
    @endif 

    
    <script >
    window.addEventListener('show_alert', event => {
                alert('Votre projet est déjà enregistré. Merci.');
            });

        function reboursF(deadline)
        {
            let jour = document.getElementById("jour"),
                jour_label = document.getElementById("jour_label"),
                heure = document.getElementById("heure"),
                heure_label = document.getElementById("heure_label"),
                minute = document.getElementById("minute"),
                minute_label = document.getElementById("minute_label"),
                seconde = document.getElementById("seconde"),
                seconde_label = document.getElementById("seconde_label"),
                maintenant = new Date(),
                finannee = deadline;
            
                let total_secondes = (finannee - maintenant) / 1000;
             
            if (total_secondes > 0)
            {
                let nb_jours = Math.floor(total_secondes / (60 * 60 * 24));
                let nb_heures = Math.floor((total_secondes - (nb_jours * 60 * 60 * 24)) / (60 * 60));
                let nb_minutes = Math.floor((total_secondes - ((nb_jours * 60 * 60 * 24 + nb_heures * 60 * 60))) / 60);
                //let nb_secondes = Math.floor(total_secondes - ((nb_jours * 60 * 60 * 24 + nb_heures * 60 * 60 + nb_minutes * 60)));
 
                jour.textContent = caractere(nb_jours);
                heure.textContent = caractere(nb_heures);
                minute.textContent = caractere(nb_minutes);
                seconde.textContent = caractere(nb_secondes);
 
                jour_label.textContent = genre(nb_jours, 'jour');
                heure_label.textContent = genre(nb_heures, 'heure');
                minute_label.textContent = genre(nb_minutes, 'minute');
                seconde_label.textContent = genre(nb_secondes, 'seconde');        
            }
 
            let minuteur = setTimeout("reboursF(deadline);", 1000);
        }
 
        function genre(nb, libelle)
        {
            return (nb > 1) ? libelle+'s' : libelle;
        }
 
        function caractere(nb)
        {
            return (nb < 10) ? '0'+nb : nb;
        }
 

    </script>

</div>