<div>
    <div class="w-full bg-gray-700">
        <h1 class="text-transparent text-center p-3 bg-clip-text bg-gradient-to-r from-purple-400 to-pink-600 "> {{$projet->projet_titre}}</h1>
    </div>
<div class="flex w-full  " >
    <div class="flex-1 w-3/4 bg-gray-700 rounded-lg m-5 p-4">
        <style>
            #description table, #description table th, #description table td{
                border: white 1px solid;
                padding: 10px;
            }
           
        </style>
        <div class="divide-y divide-gray-900 mb-3">
            <h3 class="text-gray-400 "> Description du projet</h3>
            <div class="text-gray-300" id="description">
                <p class="">
                @php
                    echo $projet->projet_description
                @endphp
                </p>
            </div>
        </div>
        
    </div >
    <div class="w-1/4 bg-gray-700 rounded-lg divide-y divide-gray-900 p-3 mt-5">
        <div>
            <h4 class="text-gray-400 ">Autres information</h4>
        </div>
        <div>
            <label for="budget"> <span style="color:#f472b6">Budget:</span> 
                 <span class="text-gray-300">
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
                                Ariary
                </span>
            </label>
            @php
                $date_fin = $projet->projet_date_fin;
                $date_reste = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date_fin)->diffForHumans([
                    'parts' => 2,
                    'join' => ',',
                ]);
            @endphp
            <label for="deadline"> <span style="color:#f472b6">Temps restant:</span> <span class="text-gray-300">{{$date_reste}}</span></label>
            <label style="color:#f472b6">Compétences réquises:</label>
            @php
                $competence = App\Models\Competence::join('competence_requises','competence_requises.competence_id','=','competences.competence_id')->where('competence_requises.categorie_id',$projet->categorie_id)->get();
            @endphp
            @foreach ($competence as $row)
            <span class=" text-sm font-medium mr-2 mb-2 px-2.5 py-0.5 rounded bg-pink-200 text-pink-900" style="background-color: #fbcfe8; color:#831843">
                {{$row->competence_label}}
            </span>
            @endforeach

            @php
            $cdo = App\Models\User::where('id',$projet->created_by)->first();
            @endphp
            <p class="mb-2 text-gray-300 ">Déposé par {{$cdo->name}} </p>

        </div>
    </div>
</div>

<div class="flex items-center justify-center">
    <button onclick="retourner()" class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-500 to-pink-500 group-hover:from-purple-500 group-hover:to-pink-500 hover:text-white text-white focus:ring-4 focus:outline-none focus:ring-purple-800">
        <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-gray-900 rounded-md group-hover:bg-opacity-0">
            Retour
        </span>
      </button>
      
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
          <p class="text-green-600">Vous êtes déjà participant </p>
      @else
        
      @endif 
  @endif
      
</div>
<script>
    function retourner()
    {
        window.history.back();
    }
</script>
</div>

    

    

