<?php

namespace App\Http\Livewire\Projet;

use App\Models\Admin;
use App\Models\Depot;
use App\Models\Projet;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Archive extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $projet_id, $projets = [];
    public $search;
    public $rating;

    

    public function render()
    {

        if(!is_null($this->search) && $this->search!='' )
            {
                $archive = User::join('developpeurs','developpeurs.user_id','=','users.id')
                            ->join('depots','users.id','=','depots.user_id')
                            ->join('projets','projets.projet_id','=','depots.projet_id')
                            ->where('projets.projet_proclame',1)
                            ->where('projets.projet_id',$this->projet_id)
                            ->where('users.name','like','%'.$this->search.'%')
                            ->paginate(6);
                            
            }
        else
            $archive = User::join('developpeurs','developpeurs.user_id','=','users.id')
                            ->join('depots','users.id','=','depots.user_id')
                            ->join('projets','projets.projet_id','=','depots.projet_id')
                            ->where('projets.projet_proclame',1)
                            ->where('projets.projet_id',$this->projet_id)
                            ->paginate(6);

           

        if(Admin::where('user_id', Auth::user()->id)->exists())
        {
            $this->projets = Projet::where('projet_proclame',1)->where('projet_isvalide',1)->get();

        }
        else{
            $this->projets = Projet::where('projet_proclame',1)->where('projet_isvalide',1)->where('created_by',Auth::user()->id)->orderBy('created_at','DESC')->get();
        }
        return view('livewire.projet.archive',['archive'=>$archive]);
    }

}
