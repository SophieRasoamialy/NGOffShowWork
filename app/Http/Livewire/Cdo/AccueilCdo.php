<?php

namespace App\Http\Livewire\Cdo;

use App\Models\Abonnement;
use App\Models\Categorie;
use App\Models\CDO;
use App\Models\DateAbonnement;
use App\Models\Developpeur;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class AccueilCdo extends Component
{
    public $cdo_isvalide;
    public $montantCDOPremium,$montantCDOBasique;
    public $type, $ispaye;

    public function render()
    {
       $cdo =  CDO::where('user_id',Auth::user()->id)->first();
        $this->cdo_isvalide = $cdo->cdo_isvalide;

        if(DateAbonnement::join('abonnements','abonnements.abonnement_id','=','date_abonnements.abonnement_id')
                        ->join('c_d_o_s','c_d_o_s.user_id','=','date_abonnements.user_id')
                        ->where('date_abonnements.user_id',Auth::user()->id)
                        ->where('abonnements.abonnement_type',"cdo_basic")
                        ->where('c_d_o_s.cdo_isvalide','=',0)
                        ->exists())
        {
            $this->type = "basique";
            $this->ispaye = true;

        }
        if(DateAbonnement::join('abonnements','abonnements.abonnement_id','=','date_abonnements.abonnement_id')
                        ->join('c_d_o_s','c_d_o_s.user_id','=','date_abonnements.user_id')
                        ->where('date_abonnements.user_id',Auth::user()->id)
                        ->where('abonnements.abonnement_type',"cdo_premium")
                        ->where('c_d_o_s.cdo_isvalide','=',1)
                        ->where('c_d_o_s.cdo_premium','=',0)
                        ->exists())
        {
            $this->type = "premium";
            $this->ispaye = true;
        }

        //si le cdo n'est pas encore validé
       /* if( CDO::where('user_id',Auth::user()->id)->where('cdo_isvalide',0)->exists())
        {
            $abonnement = DateAbonnement::where('date_abonnements.user_id',auth()->user()->id)
            ->join('abonnements','abonnements.abonnement_id','=','date_abonnements.abonnement_id')
            ->join('c_d_o_s','c_d_o_s.user_id','=','date_abonnements.user_id')
            ->where('cdo_isvalide',0)
            ->orderBy('date_abonnements.created_at','desc');
            
        }
        //si le cdo est déjà validé et fai un demmande de premium
        else
        {
        
            $abonnement = DateAbonnement::where('date_abonnements.user_id',auth()->user()->id)
            ->join('c_d_o_s','c_d_o_s.user_id','=','date_abonnements.user_id')
            ->where('cdo_isvalide',1)
            ->where('date_abonnements.updated_at','=','date_abonnements.created_at')
            ->where('cdo_premium',0)
            ->orderBy('date_abonnements.created_at','desc');
             
            $this->type = "premium";
        }*/
        
        
        $montantCDOBasic = Abonnement::where('abonnement_type','cdo_basic')->first();
        if(!is_null($montantCDOBasic))
        $this->montantCDOBasique = $montantCDOBasic->abonnement_tarif;
        else
        $this->montantCDOBasique = 0;

        $montantCDOPremium = Abonnement::where('abonnement_type','cdo_premium')->first();
        if(!is_null($montantCDOPremium))
        $this->montantCDOPremium = $montantCDOPremium->abonnement_tarif; 
        else
        $this->montantCDOPremium = 0;
        return view('livewire.cdo.accueil-cdo');
    }
 
    public function redirection($ispremium)
    {
        redirect('/cdo_validation?ispremium='.$ispremium);
    }

    public function payerAbonnement()
    {
        $cdo = CDO::where('user_id',auth()->user()->id)->first();
        $ispremium = $cdo->cdo_premium;

        redirect('/cdo_validation?ispremium='.$ispremium);
    }

}
