<?php

namespace App\Http\Livewire\Parametre;

use App\Models\Abonnement;
use App\Models\Admin;
use App\Models\Commission;
use App\Models\parametre as ModelsParametre;
use Livewire\Component;

class Parametre extends Component
{
    public $montantCDOBasic, $montantCDOPremium;
    public $montantDevBasic, $montantDevPremium;
    public $updateMontantCDOBasic = false, $updateMontantCDOPremium = false;
    public $updateMontantDevBasic = false, $updateMontantDevPremium = false;
    public $updateMvola = false , $updateOrange = false, $updateAirtel = false;
    public $mvola,$airtel,$orange;
    public $updateDuree_min = false, $updateBudget_min = false;
    public $budget_premium_min, $duree_premium_min;
    public $updateCommission_basique = false, $updateCommission_premium = false;
    public $commission_premium, $commission_basique;
    
    public function mount()
    {
        $montantCDOBasic = Abonnement::where('abonnement_type','cdo_basic')->first();
        if(!is_null($montantCDOBasic))
        $this->montantCDOBasic = $montantCDOBasic->abonnement_tarif;
        else
        $this->montantCDOBasic = 0;

        $montantCDOPremium = Abonnement::where('abonnement_type','cdo_premium')->first();
        if(!is_null($montantCDOPremium))
        $this->montantCDOPremium = $montantCDOPremium->abonnement_tarif; 
        else
        $this->montantCDOPremium = 0;

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

        $num_mvola = Admin::where('admin_contact_type','mvola')->first();
        if(!is_null($num_mvola))
        {
            $this->mvola = $num_mvola->admin_contact;
        }
        else{
            $this->mvola = '000 00 000 00';
        }

        $num_orange = Admin::where('admin_contact_type','orange')->first();
        if(!is_null($num_orange))
        {
            $this->orange = $num_orange->admin_contact;
        }
        else{
            $this->orange = '000 00 000 00';
        }

        $num_airtel = Admin::where('admin_contact_type','airtel')->first();
        if(!is_null($num_airtel))
        {
            $this->airtel = $num_airtel->admin_contact;
        }
        else{
            $this->airtel = '000 00 000 00';
        }

        $commission_premium = Commission::where('commission_type','premium')->first();
        if(!is_null($commission_premium))
        $this->commission_premium = $commission_premium->commission_tarif;
        else
        $this->commission_premium = 0;

        $commission_basique = Commission::where('commission_type','basique')->first();
        if(!is_null($commission_basique))
        $this->commission_basique = $commission_basique->commission_tarif;
        else
        $this->commission_basique = 0;
    }

    public function render()
    {
        return view('livewire.parametre.parametre');
    }

    public function editMontantCDOBasic( )
    {
        
        $this->updateMontantCDOBasic = true;
    }

    public function editMontantCDOPremium( )
    {
        
        $this->updateMontantCDOPremium = true;
    }

    public function editMontantDevBasic( )
    {
        
        $this->updateMontantDevBasic = true;
    }

    public function editMontantDevPremium( )
    {
        
        $this->updateMontantDevPremium = true;
    }

    public function editMvola( )
    {
        
        $this->updateMvola = true;
    }

    public function editOrange( )
    {
        
        $this->updateOrange = true;
    }

    public function editAirtel( )
    {
        
        $this->updateAirtel = true;
    }

    public function updateMontantCDOBasic()
    {
        $this->validate([
            'montantCDOBasic' => 'required|numeric'
        ]);
        if(Abonnement::where('abonnement_type','cdo_basic')->exists())
        {
            Abonnement::where('abonnement_type','cdo_basic')->update([
                'abonnement_tarif' => $this->montantCDOBasic
            ]);
        }
        else
        {
            Abonnement::create([
                'abonnement_type' => 'cdo_basic',
                'abonnement_tarif' => $this->montantCDOBasic
            ]);
        }
        
        $this->updateMontantCDOBasic = false;
    }

    public function updateMontantCDOPremium()
    {
        $this->validate([
            'montantCDOPremium' => 'required|numeric'
        ]);
        if(Abonnement::where('abonnement_type','cdo_premium')->exists())
        {
            Abonnement::where('abonnement_type','cdo_premium')->update([
                'abonnement_tarif' => $this->montantCDOPremium
            ]);
        }
        else
        {
            Abonnement::create([
                'abonnement_type' => 'cdo_premium',
                'abonnement_tarif' => $this->montantCDOPremium
            ]);
        }
        
        $this->updateMontantCDOPremium = false;
    }

    public function updateMontantDevBasic()
    {
        $this->validate([
            'montantDevBasic' =>'required|numeric'
        ]);
        if(Abonnement::where('abonnement_type','dev_basic')->exists())
        {
            Abonnement::where('abonnement_type','dev_basic')->update([
                'abonnement_tarif' => $this->montantDevBasic
            ]);
        }
        else
        {
            Abonnement::create([
                'abonnement_type' => 'dev_basic',
                'abonnement_tarif' => $this->montantDevBasic
            ]);
        }
        
        $this->updateMontantDevBasic = false;
    }

    public function updateMontantDevPremium()
    {
        $this->validate([
           'montantDevPremium' => 'required|numeric' 
        ]);
        if(Abonnement::where('abonnement_type','dev_premium')->exists())
        {
            Abonnement::where('abonnement_type','dev_premium')->update([
                'abonnement_tarif' => $this->montantDevPremium
            ]);
            //envoie d'email aux user
        }
        else
        {
            Abonnement::create([
                'abonnement_type' => 'dev_premium',
                'abonnement_tarif' => $this->montantDevPremium
            ]);
        }
        
        $this->updateMontantDevPremium = false;
    }

    public function updateMvola()
    {
        $this->validate([
           'mvola' => 'required|numeric|digits:10|regex:/^[0]{1}[3]{1}[4]{1}[0-9]{7}$/|digits:10' 
        ]);
        if(Admin::where('admin_contact_type','mvola')->exists())
        {
            Admin::where('admin_contact_type','mvola')->update([
                'admin_contact' => $this->mvola
            ]);
        }
        else
        {
            Admin::create([
                'admin_contact_type' => 'mvola',
                'admin_contact' => $this->mvola,
                'user_id' => auth()->user()->id

            ]);
        }
        
        $this->updateMvola = false;
    }

    public function updateAirtel()
    {
        $this->validate([
           'airtel' => 'required|numeric|digits:10|regex:/^[0]{1}[3]{1}[2]{1}[0-9]{7}$/|digits:10' 
        ]);
        if(Admin::where('admin_contact_type','airtel')->exists())
        {
            Admin::where('admin_contact_type','airtel')->update([
                'admin_contact' => $this->airtel
            ]);
        }
        else
        {
            Admin::create([
                'admin_contact_type' => 'airtel',
                'admin_contact' => $this->airtel,
                'user_id' => auth()->user()->id
            ]);
        }
        
        $this->updateAirtel = false;
    }

    public function updateOrange()
    {
        $this->validate([
           'orange' => 'required|numeric|digits:10|regex:/^[0]{1}[3]{1}[2]{1}[0-9]{7}$/' 
        ]);
        if(Admin::where('admin_contact_type','orange')->exists())
        {
            Admin::where('admin_contact_type','orange')->update([
                'admin_contact' => $this->mvola
            ]);
        }
        else
        {
            Admin::create([
                'admin_contact_type' => 'orange',
                'admin_contact' => $this->orange,
                'user_id' => auth()->user()->id
            ]);
        }
        
        $this->updateOrange = false;
    }

    public function editCommissionPremium()
    {
        $this->updateCommission_premium = true;
    }

    public function updateCommissionPremium()
    {
        $this->validate([
            'commission_premium' => 'required|numeric' 
         ]);
         if(Commission::where('commission_type','premium')->exists())
         {
             Commission::where('commission_type','premium')->update([
                 'commission_tarif' => $this->commission_premium
             ]);
         }
         else
         {
             Commission::create([
                 'commission_type' => 'premium',
                 'commission_tarif' => $this->commission_premium
             ]);
         }
         
         $this->updateCommission_premium = false;
    }

    public function editCommissionBasique()
    {
        $this->updateCommission_basique = true;
    }

    public function updateCommissionBasique()
    {
        $this->validate([
            'commission_basique' => 'required|numeric' 
         ]);
         if(Commission::where('commission_type','basique')->exists())
         {
             Commission::where('commission_type','basique')->update([
                 'commission_tarif' => $this->commission_basique
             ]);
         }
         else
         {
             Commission::create([
                 'commission_type' => 'basique',
                 'commission_tarif' => $this->commission_basique
             ]);
         }
         
         $this->updateCommission_basique = false;
    }
    

}
