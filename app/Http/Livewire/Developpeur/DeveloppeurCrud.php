<?php

namespace App\Http\Livewire\Developpeur;

use App\Models\Developpeur;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Projet;
use App\Notifications\DeleteUserNotif;
use App\Notifications\ValidationNotif;

class DeveloppeurCrud extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['supprimer'];
    private $participants ;
    public $groupe_nom = [];
    public $projets = [];
    public $search;
    

     

    public function render()
    {
        if(is_null($this->search))
        $this->participants = Developpeur::join('users','users.id','=','developpeurs.user_id')
                                        ->orderBy('users.created_at','desc')->paginate(6);
        else
        $this->updatedSearch($this->search);

        return view('livewire.developpeur.developpeur-crud',['participants'=>$this->participants]);
    }


    public function updatedSearch($search)
    {
        if(!is_null($search) && $search!='' ){
        $this->participants=Developpeur::join('users','users.id','=','developpeurs.user_id')
                                    ->selectRaw('users.id as id, developpeurs.developpeur_a_propos as developpeur_a_propos,users.name as name, users.avatar as avatar')
                                    ->join('developpeur_competences','developpeur_competences.user_id','=','developpeurs.user_id')
                                    ->join('competences','competences.competence_id','=','developpeur_competences.competence_id')
                                     ->where('users.name','like','%'.$search.'%')
                                     ->orWhere('developpeurs.firstname','like','%'.$search.'%')
                                     ->orWhere('developpeurs.lastname','like','%'.$search.'%')
                                    ->orWhere('competences.competence_label','like','%'.$search.'%')
                                    ->orWhere('developpeurs.developpeur_a_propos','like','%'.$search.'%')
                                     ->orderBy('users.created_at','desc')
                                     ->groupBy('users.id','users.name','developpeurs.developpeur_a_propos','users.avatar')
                                     ->paginate(6);
       
        }        
        else
        $this->participants = Developpeur::join('users','users.id','=','developpeurs.user_id')
        ->join('developpeur_competences','developpeur_competences.user_id','=','developpeurs.user_id')
        ->join('competences','competences.competence_id','=','developpeur_competences.competence_id')
        ->orderBy('users.created_at','desc')->paginate(6);
    }

    public function valider($id)
    {
        Developpeur::where('user_id',$id)->update([
            'developpeurs_isvalide' => 1
        ]);
        //notification du developpeur
        $user_destination = User::find($id);
        $message = 'participer aux projets basiques';
        $notif = "Demande pour être dévéloppeur basique accepté";

        $this->dispatchBrowserEvent('notification');
        $user_destination->notify(new ValidationNotif($message,$notif));
    }

    public function premiumer($id)
    {
        Developpeur::where('user_id',$id)->update([
            'developpeurs_isvalide' => 1,
            'premium' =>1
        ]); 
        $user_destination = User::find($id);
        $message = 'participer aux projets premium';
        $notif = "Demande pour être dévéloppeur premium accepté";

        $this->dispatchBrowserEvent('notification');
        $user_destination->notify(new ValidationNotif($message,$notif));
    }
     
    public function supprimer($user_id,$motif)
    {
        $user = User::find($user_id);
        $user->notify(new DeleteUserNotif($motif));

        if($user_id)
        {
            User::where('id',$user_id)->delete();
        }

        $this->dispatchBrowserEvent('notifsup');
    }

}
