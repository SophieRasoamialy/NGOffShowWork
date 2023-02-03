<?php

namespace App\Http\Livewire\Projet;

use App\Models\Categorie;
use App\Models\Competence;
use App\Models\CompetenceRequise;
use App\Models\Developpeur;
use App\Models\DeveloppeurCompetence;
use App\Models\Participation;
use Livewire\Component;
use App\Models\Projet;
use App\Models\SousCategorie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class ProjetParticipant extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    private $projets = [];
    public $projet_id;
    public $categorie = [];
    public $sous_categorie = [];
    public $categorie_id ;
    public $categorie_filtre = [], $budget_min = 0,$budget_max = 100000000,$competence_filtre = [];
    public $user_id;
    public $bool = false;
    public $message = null;
    public $projet_participants = array();
    public $categorie_id1,$categorie_id2;
    public $competence;
    public $developpeur_ispremium, $developpeur_isvalide;
    public $type_projet = [];
    private $tout_projets;

    public function mount()
    {
        $this->user_id = Auth::user()->id;
        $developpeur = Developpeur::where('user_id',$this->user_id)->first();
        $this->developpeur_ispremium = $developpeur->premium;
        $this->developpeur_isvalide = $developpeur->developpeurs_isvalide;

        
        $this->listeProjet();
    }
    
    public function render()
    {
        $this->listeCategorie();
        $this->listeCompetenceUser();
        $this->listeProjet();
        

        return view('livewire.projet.projet-participant',['projets'=>$this->projets, 'toutprojets'=>$this->tout_projets]);
    }

    public function listeProjet(){
        $categorie_length = count($this->categorie_filtre);

        $competence_length = count($this->competence_filtre);
        
        $type_projet_length = count($this->type_projet);

        if(is_null($this->budget_max)||$this->budget_max=='')
        {
            $this->budget_max = 100000000;
        }

        //$this->tout_projet = Projet::join('categories','categories.categorie_id','=','projets.categorie_id')
          //                              ->where('projets.projet_proclame',0);
                                        

        $projet = Projet::join('categories','categories.categorie_id','=','projets.categorie_id')
        //DB::table('projets')
       // ->selectRaw(' DISTINCT projets.projet_id as projet_id, projets.projet_titre as projet_titre, projets.projet_description as projet_description, projets.projet_date_fin as projet_date_fin, categories.categorie_illustration, projets.projet_budget as projet_budget, projets.projet_duree as projet_duree, projets.projet_premium as projet_premium, projets.created_by as created_by')
        //->
                                //->join('competence_requises','competence_requises.categorie_id','=','categories.categorie_id')
                               // ->join('developpeur_competences','developpeur_competences.competence_id','=','competence_requises.competence_id')
                                ->where('projets.projet_proclame',0)
                                ->where('projet_isvalide',1)
                                ->whereIn('projets.categorie_id',CompetenceRequise::whereIn('competence_id',DeveloppeurCompetence::where('user_id',$this->user_id)->pluck('competence_id')->toArray())->pluck('categorie_id')->toArray());
                                //->where('developpeur_competences.user_id',$this->user_id);
        $tout_projet = Projet::join('categories','categories.categorie_id','=','projets.categorie_id');
        if($categorie_length>0)
        {
            $projet = $projet->whereIn('categories.categorie_id',$this->categorie_filtre);
            //$this->tout_projet = $this->tout_projet->whereIn('categories.categorie_id',$this->categorie_filtre);;
            $tout_projet = $tout_projet->whereIn('categories.categorie_id',$this->categorie_filtre);
        }
        if($competence_length>0)
        {
            $projet = $projet->whereIn('projets.categorie_id',CompetenceRequise::whereIn('competence_id',$this->competence_filtre)->pluck('categorie_id')->toArray());
            //$projet = $projet->whereIn('developpeur_competences.competence_id',$this->competence_filtre);
        }
        if($type_projet_length>0)
        {
            $projet = $projet->whereIn('projets.projet_premium',$this->type_projet);
           // $this->tout_projet = $this->tout_projet->whereIn('projets.projet_premium',$this->type_projet);
           $tout_projet = $tout_projet->whereIn('projets.projet_premium',$this->type_projet);
        }
        /*if($this->developpeur_ispremium == 0)
        {
            $projet = $projet->where('projets.projet_premium',0);
        }*/
                                
        $projet = $projet->where('projets.projet_budget','>=',$this->budget_min)
                        ->where('projets.projet_budget','<=',$this->budget_max)
                        ->orderBy('projets.projet_date_fin','desc')
                        ->paginate(6);
        $tout_projet = $tout_projet->where('projets.projet_budget','>=',$this->budget_min)
                                ->where('projets.projet_budget','<=',$this->budget_max)
                                ->orderBy('projets.projet_date_fin','desc')
                                ->paginate(3);
        $this->projets = $projet;
        $this->tout_projets = $tout_projet;
    }

   public function listeCategorie()
    {
        $this->categorie = Categorie::all();
    }

    public function listeCompetenceUser()
    {
        $this->competence = Competence::join('developpeur_competences','developpeur_competences.competence_id','=','competences.competence_id')
        ->where('developpeur_competences.user_id',$this->user_id)
        ->get();
    }

    public function detailer($projet_id)
    {

    }
   
    public function participer($projet_id,$projet_ispremium)
    {
        if($this->developpeur_isvalide == 0)
        {
            return redirect('/validation');
        }
        else
        {
            if($projet_ispremium == 1)
            {
                if($this->developpeur_ispremium == 0)
                {
                    $this->dispatchBrowserEvent('nonpremium');
                    return;
                }
            }
            
            $this->projet_id = $projet_id;
            Participation::create([
                'user_id' => $this->user_id,
                'projet_id' => $projet_id

            ]);
            redirect()->to('/participation_success');
        }

    }
    
    public function recup_projet_participants()
    {
        $projet_participants = Projet::join('participations','participations.projet_id','=','projets.projet_id')->join('groupe_participants','groupe_participants.groupe_id','=','participations.groupe_id')->where('groupe_participants.user_id',$this->user_id)->get('projets.projet_id');

        foreach($projet_participants as $row)
        {
            array_push($this->projet_participants,$row->projet_id);
        }
    }

    
    
}
