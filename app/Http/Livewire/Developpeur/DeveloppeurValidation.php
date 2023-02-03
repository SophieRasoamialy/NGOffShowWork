<?php

namespace App\Http\Livewire\Developpeur;

use App\Models\Abonnement;
use App\Models\Developpeur;
use Livewire\Component;

class DeveloppeurValidation extends Component
{
    public $montantDevBasic, $montantDevPremium;
    public $dev_isbasique, $dev_ispremium;

    public function render()
    {
        $montantDevBasic = Abonnement::where('abonnement_type','dev_basic')->first();
        if(!is_null($montantDevBasic))
        $this->montantDevBasic = $montantDevBasic->abonnement_tarif;
        else
        $this->montantDevBasic = 0;

        $montantDevPremium = Abonnement::where('abonnement_type','dev_premium')->first();
        if(!is_null($montantDevPremium))
        $this->montantDevPremium = $montantDevPremium->abonnement_tarif; 
        else
        $this->montantDevPremium = 0;

        $this->dev_isbasique = Developpeur::where('user_id', auth()->user()->id)->first()->developpeurs_isvalide;
        $this->dev_ispremium = Developpeur::where('user_id', auth()->user()->id)->first()->premium;
        
        return view('livewire.developpeur.developpeur-validation');
    }

    
}
