<?php

namespace App\Http\Livewire\User;

use App\Models\Groupe;
use Livewire\Component;
use App\Models\Projet;
use Illuminate\Support\Facades\Auth;
use App\Models\Participation;
use Livewire\WithPagination;

class ProjetUser extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['annulerParticiption'];

    private  $projets;
    public $user_id;
    public $nomGroupe = [];

    public function mount()
    {
        $this->user_id = Auth::user()->id;
    }

    public function render()
    { 

        $this->projets = Projet::join('participations','participations.projet_id','=','projets.projet_id')
                               ->join('categories','categories.categorie_id','=','projets.categorie_id')
                               ->where('participations.user_id',$this->user_id)
                               ->orderby('projets.projet_date_fin','desc')->paginate(6);
        return view('livewire.user.projet-user',['projets'=>$this->projets]);
    }

    public function annulerParticiption($user_id,$projet_id)
    {
        if(!is_null($user_id) && !is_null($projet_id))
        {
            Participation::where('user_id',$user_id)
                           ->where('projet_id', $projet_id)
                           ->delete();
        }
        // + notifcation dans la page admin
    }
}
