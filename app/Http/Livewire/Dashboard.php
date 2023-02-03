<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Demande\Developpeur;
use App\Models\Admin;
use App\Models\Categorie;
use App\Models\CDO;
use App\Models\Depot;
use App\Models\Developpeur as ModelsDeveloppeur;
use App\Models\Groupe;
use App\Models\Participation;
use App\Models\Projet;
use Livewire\Component;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $nombre_participant, $nombre_partenaire,  $nombre_projet, $nombre_groupe;
    public $participant_today, $partenaire_today, $projet_today;
    public $taux_participation, $taux_depot_projet;
    public $projet_encours, $cout;
    public $categorie;
    public $taux_cdo_basic, $taux_cdo_premium, $taux_dev_basic, $taux_dev_premium;
 

    public function render()
    {
        $this->nombre_participant = ModelsDeveloppeur::count();
        $this->nombre_partenaire = CDO::count();

        if(Admin::where('user_id',auth()->user()->id)->exists())
        {
            $this->projet_encours = Projet::where('projet_date_fin','>',Carbon::now()->setTimezone("Turkey"))->count() ;

            $this->nombre_projet = Projet::count();
        }
        else
        {
            $this->cout = Projet::where('created_by',Auth::user()->id)->sum('projet_budget');

            $this->projet_encours = Projet::where('projet_date_fin','>',Carbon::now()->setTimezone("Turkey"))
                                            ->where('created_by',Auth::user()->id)
                                            ->count() ;
            $this->nombre_projet = Projet::where('created_by',Auth::user()->id)->count();
        }

        $this->categorie = Categorie::join('projets','projets.categorie_id','=','categories.categorie_id')
                                ->selectRaw('count(projets.projet_id) as nbre_projet, categories.categorie_label as categorie_label, categories.categorie_id as categorie_id')
                                ->groupBy('categories.categorie_id','categories.categorie_label')
                                ->get();

        $this->calcul_taux_participation();
        $this->calcul_taux_depot();

        $this->nombre_today();

        $this->nbreUserBasicPremium();

        return view('livewire.dashboard');
    }

    public function calcul_taux_participation()
    {
        if(Admin::where('user_id',auth()->user()->id)->exists())
        {
            $nombre_participation = Participation::join('developpeurs','developpeurs.user_id','=','participations.user_id')->distinct('participations.user_id')->count('participations.user_id');

        }
        else{
            $nombre_participation = Participation::join('developpeurs','developpeurs.user_id','participations.user_id')->join('projets','projets.projet_id','=','participations.projet_id')->where('projets.created_by',Auth::user()->id)->distinct('participations.user_id')->count('participations.user_id');
        }
        
        if($nombre_participation == 0 || $this->nombre_participant == 0)
        {
            $resultat = 0;
        }
        else{
            $resultat = ($nombre_participation / $this->nombre_participant) * 100;
        }

        $this->taux_participation = round($resultat);
    }

    public function calcul_taux_depot()
    {
        if(Admin::where('user_id',auth()->user()->id)->exists())
        {
            $nombre_participation = Participation::count();

            $nombre_depot = Depot::count();
            
        }
        else
        {
            $nombre_participation = Participation::join('projets','projets.projet_id','=','participations.projet_id')->where('projets.created_by',Auth::user()->id)->count();

            $nombre_depot = Depot::join('projets','projets.projet_id','=','depots.projet_id')->where('projets.created_by',Auth::user()->id)->count();
        }

        if($nombre_participation == 0 || $nombre_depot == 0)
        {
            $resultat = 0;
        }
        else{
            $resultat = ($nombre_depot/$nombre_participation)  * 100;
        }

        
       $this->taux_depot_projet = round($resultat);

        
    }

    public function nombre_today()
    {
        date_default_timezone_set('Turkey');
        $jour = date('d');

        $this->participant_today = User::join('developpeurs','developpeurs.user_id','=','users.id')->whereDay('users.created_at', $jour)->count();
        $this->partenaire_today = User::join('c_d_o_s','c_d_o_s.user_id','=','users.id')->whereDay('users.created_at', $jour)->count() ;
        if(Admin::where('user_id',auth()->user()->id)->exists())
        {
            $this->projet_today = Projet::whereDay('created_at', $jour)->count();
            
        }
        else
        {
            $this->projet_today = Projet::where('created_at',Auth::user()->id)->whereDay('projets.created_at', $jour)->count();
        }

    }

    public function nbreUserBasicPremium()
    {
        $nbre_cdo_basic = CDO::where('cdo_premium', 0)->where('cdo_isvalide',1)->count();
        $nbre_cdo_premium = CDO::where('cdo_premium', 1)->count();
        $nbre_dev_basic = ModelsDeveloppeur::where('premium',0)->where('developpeurs_isvalide',1)->count();
        $nbre_dev_premium = ModelsDeveloppeur::where('premium',1)->count();
        if( $this->nombre_partenaire != 0 )
        {
            $this->taux_cdo_basic = round(($nbre_cdo_basic/$this->nombre_partenaire)*100);
            $this->taux_cdo_premium = round(($nbre_cdo_premium/$this->nombre_partenaire)*100);
        }
        else
        {
            $this->taux_cdo_basic = 0;
            $this->taux_cdo_premium = 0;
        }
        if( $this->nombre_participant != 0)
        {
            $this->taux_dev_basic =round(($nbre_dev_basic/$this->nombre_participant)*100);
            $this->taux_dev_premium = round(($nbre_dev_premium/$this->nombre_participant)*100);

        }
        else
        {
            $this->taux_dev_basic = 0;
            $this->taux_dev_premium = 0;
        }
        

    }


}
