<?php

namespace App\Http\Livewire\Cdo;

use App\Models\Abonnement;
use App\Models\Admin;
use App\Models\DateAbonnement;
use App\Models\User;
use App\Notifications\AdminNotif;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CdoValidation extends Component
{
    public $ispremium;
    public $mode_paiement = null;
    public $numero, $image_name, $montant;
    public  $reference;
    public function mount()
    {
        $this->ispremium = $_GET['ispremium'];

    }

    public function render()
    {
        return view('livewire.cdo.cdo-validation');
    }

    public function choisir($mode_paiement,$type)
    {
        $this->mode_paiement = $mode_paiement;

        $admin = Admin::where('admin_contact_type',$type)->first();
        if(!is_null($admin))
        {
            $this->numero = $admin->admin_contact;
        }
        else
        {
            $this->numero = "aucun pour le moment";
        }

         if($this->ispremium == 0)
         {
            $abonnement = Abonnement::where('abonnement_type','cdo_basic')->first();
            if(!is_null($abonnement))
            $this->montant = $abonnement->abonnement_tarif;
            else
            $this->montant = 0;
         }
         else{
            $abonnement = Abonnement::where('abonnement_type','cdo_premium')->first();
            if(!is_null($abonnement))
            $this->montant = $abonnement->abonnement_tarif;
            else
            $this->montant = 0;
         }

         if($type == "mvola")
         {
            $this->image_name = "telma.jpeg";
         }
         elseif($type == "orange")
         {
            $this->image_name = "orange.png";
         }
         else
         {
            $this->image_name = "airtel.png";
         }


    }

    public function payer()
    {
        $this->validate([
            'reference' => "required|min:3|max:50"
        ]);
    
        if($this->ispremium == 0)
        {
            $abonnement = Abonnement::where('abonnement_type','cdo_basic')->first();
            DateAbonnement::create([
                'user_id' => Auth::user()->id,
                'abonnement_id' => $abonnement->abonnement_id,
                'mode_paiement' => $this->mode_paiement,
                'paiement_reference' => $this->reference
            ]);

            
        }
        else{
            $abonnement = Abonnement::where('abonnement_type','cdo_premium')->first();
            DateAbonnement::create([
                'user_id' => Auth::user()->id,
                'abonnement_id' => $abonnement->abonnement_id,
                'mode_paiement' => $this->mode_paiement ,
                'paiement_reference' => $this->reference
            ]);
            
        }
       /* $admin = Admin::first();
        $user_destination = User::find($admin->user_id);
        $user_destination->notify(new AdminNotif());*/
        redirect('/paiement_cdo_success');

    }
}
