<?php

namespace App\Http\Livewire\Cdo;

use App\Http\Livewire\Demande\Developpeur;
use App\Models\CDO;
use App\Models\DateAbonnement;
use App\Models\DemandePartenariat;
use App\Models\RoleUser;
use Livewire\Component;
use App\Models\User;
use App\Notifications\clientNotif;
use App\Notifications\ReponseDemande;
use Livewire\WithPagination;


class DemandeCdo extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'supprimerDemande'
    ];

    private $demande;

    public function render()
    {
        $this->demande = CDO::join('users','users.id','=','c_d_o_s.user_id')
                            ->join('date_abonnements','date_abonnements.user_id','c_d_o_s.user_id')
                            ->join('abonnements','abonnements.abonnement_id','date_abonnements.abonnement_id')
                            ->selectRaw('users.name as name, date_abonnements.created_at as created_at, date_abonnements.mode_paiement as mode_paiement, date_abonnements.paiement_reference as paiement_reference, date_abonnements.paiement_reference as paiement_reference, c_d_o_s.cdo_premium as cdo_premium, c_d_o_s.cdo_isvalide as cdo_isvalide, users.id as id, abonnements.abonnement_type as abonnement_type')
                            ->orderBy('date_abonnements.created_at','desc')
                            ->paginate(6);

        return view('livewire.cdo.demande-cdo',['demande' => $this->demande]);
    }


    public function validerDemande($user_id,$abonnement_type)
    {
        if($user_id){
        $user = CDO::where('user_id',$user_id);
        
        if($abonnement_type == "cdo_premium")
        {
            $user->update([
                'cdo_premium' => 1
            ]);

            $message = "Vous pouvez maintenant déposer des projets premium.";
            $illustration = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
          </svg>
          ';
        }
        else
        {
            $user->update([
                'cdo_isvalide' => 1
            ]);
            $message = "Vous pouvez maintenant déposer des projets basiques.";
            $illustration = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
          </svg>
          ';
        }
        $this->dispatchBrowserEvent('notification');
        $user_destination = User::find($user_id);

        $user_destination->notify(new clientNotif($message,$illustration));
        
        }
    }
    public function supprimerDemande($user_id,$motif)
    {
        DateAbonnement::where('user_id',$user_id)->delete(); 
        $user = User::find($user_id);
                $message = "Votre abonnement est rejeté.\n Cause: ".$motif." \n Veulliez reéssayer";
                $illustration = '        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
              ';
                $user->notify(new clientNotif($message,$illustration));
           
    }
}
