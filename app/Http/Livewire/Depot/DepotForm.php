<?php

namespace App\Http\Livewire\Depot;

use App\Models\Depot;
use App\Models\Participation;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Projet;
use App\Models\Groupe;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Livewire\WithFileUploads;


class DepotForm extends Component
{
    use WithFileUploads;

    public $projets,$groupes;
    public $user_id;
    public $selected_projet = false, $selected_groupe = false;
    public $projet_titre, $projet_id;
    public $groupe_id,$groupe_nom;
    public $depot_lien_git;
    public $fait = false;

    public function mount()
    {
        $this->user_id = Auth::user()->id;
    }

    public function render()
    {
        $this->recup_projet();

        return view('livewire.depot.depot-form');
    }
 
    public function recup_projet()
    {
        $this->projets = DB::table('projets')->select('projets.*')
                        ->join('participations','participations.projet_id','=','projets.projet_id')
                        ->where('participations.user_id',$this->user_id)
                        ->whereNotIn('participations.projet_id',Depot::where('user_id',$this->user_id)->pluck('projet_id')->toArray())
                        ->where('projets.projet_date_fin','>=',Carbon::now()->setTimezone('Turkey'))
                        ->orderBy('projets.projet_date_fin','asc')
                        ->distinct('participations.projet_id')
                        ->get();
    }
    public function selectProjet($projet_id)
    {
        $this->projet_id = $projet_id;
        $this->selected_projet = true;

    }

    public function annuler_select_groupe()
    {
        $this->selected_projet = false;
    }

   
    
    public function deposer()
    {
        if(Depot::where('projet_id',$this->projet_id)->where('user_id',$this->user_id)->exists())
        {
            $this->selected_projet = false;
            $this->dispatchBrowserEvent('show_alert');
            
            return ;
        }

        $this->validate([
            'depot_lien_git' => 'required|url|unique:App\Models\Depot,depot_lien_git',
        ]);
        Depot::create([
            'projet_id' => $this->projet_id,
            'depot_lien_git' => $this->depot_lien_git,
            'user_id' => $this->user_id,
        ]);
        
        return redirect('/depot_success');
    }
    

    
}
