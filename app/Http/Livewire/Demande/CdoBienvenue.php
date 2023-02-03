<?php

namespace App\Http\Livewire\Demande;

use App\Models\CDO;
use App\Models\Developpeur;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CdoBienvenue extends Component
{

    public $commencer_click = false;
    
    public function render()
    {
        return view('livewire.demande.cdo-bienvenue');
    }

    public function redirection()
    {
        $this->commencer_click = true;
        if(!CDO::where('user_id', Auth::user()->id)->exists() && !Developpeur::where('user_id', Auth::user()->id)->exists())
        {
            CDO::create([
                'user_id' => Auth::user()->id
            ]);
            return;
             //redirect()->to('/liste_projet');
        }
        
        else
        {
            return;

        }

    }
}
