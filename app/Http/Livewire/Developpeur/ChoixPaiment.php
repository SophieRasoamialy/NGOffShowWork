<?php

namespace App\Http\Livewire\Developpeur;

use App\Models\Abonnement;
use App\Models\Admin;
use App\Models\DateAbonnement;
use App\Models\Developpeur;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChoixPaiment extends Component
{
    public $montant;
    public $ispremium_val;
    public $mvola, $airtel, $orange;
    public $reference;

    public function mount()
    {
        if(isset($_GET['montant']))
        $this->montant = $_GET['montant'];
        if(isset($_GET['val']))
        {
            $ispremium = $_GET['val'];
            $this->ispremium_val = $ispremium;

        }

    }
    
    public function render()
    {
        
       $num_mvola = Admin::where('admin_contact_type','mvola')->first();
        if(!is_null($num_mvola))
        {
            $this->mvola = $num_mvola->admin_contact;
        }
        else{
            $this->mvola = 'aucun pour le momment';
        }

        $num_orange = Admin::where('admin_contact_type','orange')->first();
        if(!is_null($num_orange))
        {
            $this->orange = $num_orange->admin_contact;
        }
        else{
            $this->orange = 'aucun pour le momment';
        }

        $num_airtel = Admin::where('admin_contact_type','airtel')->first();
        if(!is_null($num_airtel))
        {
            $this->airtel = $num_airtel->admin_contact;
        }
        else{
            $this->airtel = 'aucun pour le momment';
        }

        return view('livewire.developpeur.choix-paiment');
    }

    
    public function payer($mode)
    {
        $this->validate([
            'reference' => "required|min:3|max:20"
        ]);
    
        if($this->ispremium_val == 0)
        {
            $abonnement = Abonnement::where('abonnement_type','dev_basic')->first();
            DateAbonnement::create([
                'user_id' => Auth::user()->id,
                'abonnement_id' => $abonnement->abonnement_id,
                'mode_paiement' => $mode,
                'paiement_reference' => $this->reference
            ]);

            /*Developpeur::where('user_id',auth()->user()->id)->update([
                    'developpeurs_isvalide' => 1
            ]);*/
        }
        else{
            $abonnement = Abonnement::where('abonnement_type','dev_premium')->first();
            DateAbonnement::create([
                'user_id' => Auth::user()->id,
                'abonnement_id' => $abonnement->abonnement_id,
                'mode_paiement' => $mode ,
                'paiement_reference' => $this->reference
            ]);
            /*Developpeur::where('user_id',auth()->user()->id)->update([
                'premium' => 1
            ]);*/
        }

        redirect('/choix_paiment_success');

    }
    public function abonnement()
    {
        
    }
}
