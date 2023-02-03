<?php

namespace App\Http\Livewire\Projet;

use App\Models\Projet;
use Livewire\Component;

class ProjetDetail extends Component
{
    public $projet;

    public function render()
    {
        $projet_id = $_GET['projet_id'];
        $this->infoProjet($projet_id);
        
        return view('livewire.projet.projet-detail');
    }

    public function infoProjet($projet_id)
    {
        if(!is_null($projet_id))
        {
            $this->projet = Projet::where('projet_id',$projet_id)->first();
        }
    }

    public function participer($projet_id, $projet_premium)
    {
        $projet_participant = new ProjetParticipant();
        $projet_participant->participer($projet_id,$projet_premium);
    }
}
