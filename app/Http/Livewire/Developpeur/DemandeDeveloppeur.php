<?php

namespace App\Http\Livewire\Developpeur;

use App\Models\DateAbonnement;
use App\Models\Developpeur;
use App\Models\User;
use App\Notifications\ReponseDemande;
use App\Notifications\ValidationNotif;
use Livewire\Component;
use Livewire\WithPagination;

class DemandeDeveloppeur extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'supprimerDemande'
    ];


    private $demande;
    public function render()
    { 
        $this->demande = DateAbonnement::join('developpeurs','date_abonnements.user_id','developpeurs.user_id')
                            ->join('users','users.id','=','developpeurs.user_id')
                            ->join('abonnements','abonnements.abonnement_id','date_abonnements.abonnement_id')
                            ->where('developpeurs_isvalide',0)
                            ->selectRaw('users.name as name, users.id as id, users.avatar as avatar, date_abonnements.created_at as created_at, date_abonnements.paiement_reference as paiement_reference, date_abonnements.mode_paiement as mode_paiement, abonnements.abonnement_type as abonnement_type')
                            ->paginate(6); 
        return view('livewire.developpeur.demande-developpeur',['demande' => $this->demande]);
    }

    public function validerDemande($user_id,$abonnement_type)
    {
        if($abonnement_type == "cdo_basic")
        {
            Developpeur::where('user_id',$user_id)->update([
                'developpeurs_isvalide' => 1
            ]);
            
        $message = 'participer aux projets basiques';
        $notif = "Demande pour être dévéloppeur basique accepté";
        }
        else{
            Developpeur::where('user_id',$user_id)->update([
                'premium' => 1,
                'developpeurs_isvalide' => 1
            ]);

        $message = 'participer aux projets premium';
        $notif = "Demande pour être dévéloppeur premium accepté";
        }

        $this->dispatchBrowserEvent('notification');
                //notification du developpeur
        $user_destination = User::find($user_id);
        $user_destination->notify(new ValidationNotif($message,$notif));


    }


    public function supprimerDemande($user_id,$motif)
    {
        $user = User::find($user_id);
        $user->notify(new ReponseDemande($motif)); 
        DateAbonnement::where('user_id',$user_id)->delete(); 
        $this->dispatchBrowserEvent('notifsup');

    }
}
