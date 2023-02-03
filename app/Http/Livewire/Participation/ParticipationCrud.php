<?php

namespace App\Http\Livewire\Participation;

use App\Http\Livewire\Developpeur\DeveloppeurCrud;
use App\Http\Livewire\Groupe\GroupeCrud;
use App\Models\Admin;
use App\Models\Depot;
use App\Models\User;
use App\Models\Participation;
use App\Models\Projet;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\RoleUser;
use App\Models\Groupe;
use App\Models\GroupeParticipant;
use App\Notifications\DeleteParticipationNotif;
use Livewire\WithPagination;
class participationCrud extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'deleteParticipation','supprimer'
   ];

    public $projet;
    public $projetId;
    public $projet_label;
    private $participants = [];
    public $updateMode = false;
    public $equipe = [];
    public $groupe_nom;
    public $user,$role;
    public $nombre_participant;
    public $projet_titre;

    public function mount()
    {

        $this->user = Auth::user()->id;

        //if admin
        if(Admin::where('user_id', Auth::user()->id)->exists())
        {
            $this->projet = Projet::where('projet_proclame',0)->where('projet_isvalide',1)->orderBy('created_at', 'desc')->get();
        }
        else{
            $this->projet = Projet::where('projet_proclame',0)->where('projet_isvalide',1)->where('created_by',$this->user)->orderBy('created_at', 'desc')->get();
        }

        
    }

    public function updatedProjetId()
    {
        $this->requete($this->projetId);
    }

    //liste de developpeurs participants
    public function requete($projet_id)
    {
        $this->participants =User::join('participations','participations.user_id','=','users.id')
                                    ->join('developpeurs','developpeurs.user_id','=','users.id')
                                    ->where('participations.projet_id',$projet_id)
                                    ->orderBy('participations.created_at','desc')
                                    ->paginate(10);
        $this->nombre_participant = User::join('participations','participations.user_id','=','users.id')
                                    ->join('developpeurs','developpeurs.user_id','=','users.id')
                                    ->where('participations.projet_id',$projet_id)
                                    ->count();
        $projet = Projet::where('projet_id',$projet_id)->first();
        $this->projet_titre = $projet->projet_titre;
         
    }

    public function render()
    {
        if(!is_null($this->projetId) || $this->projetId != "")
        $this->requete($this->projetId);

        return view('livewire.participation.participation-crud',['participant' => $this->participants]);
    }


    public function deleteParticipation($user_id,$motif)
    {
        if(!is_null($this->projetId))
            $projet_id = $this->projetId;

        if($user_id){
            Participation::where('user_id',$user_id)
                           ->where('projet_id', $projet_id)
                           ->delete();
            Depot::where('user_id', $user_id)
                    ->where('projet_id',$projet_id)
                    ->delete();
        }

        $projet = Projet::where('projet_id',$this->projetId)->first();
        
        $projet_titre = $projet->projet_titre;
        
        $user = User::find($user_id);

        $user->notify(new DeleteParticipationNotif($projet_titre,$motif));
        //fin notificataion
        
    }

    
    
}