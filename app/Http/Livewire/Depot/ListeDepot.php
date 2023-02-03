<?php

namespace App\Http\Livewire\Depot;

use App\Models\Admin;
use App\Models\CDO;
use App\Models\Depot;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Groupe;
use Illuminate\Support\Facades\DB;
use App\Models\Projet;
use Illuminate\Support\Facades\Auth;
use App\Models\RoleUser;
use App\Models\User;
use App\Notifications\clientNotif;

class ListeDepot extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    private $groupes = [];
    public $search;
    public $projet_id, $projets = [];
    public $user,$role;
    public $rating;
    public $depot_remarque;
    public $update_remarque = false,$id_mod;
    


    public function mount()
    {
        $this->user = Auth::user()->id;
        
    }

    public function render()
    {
 
        if(!is_null($this->search) && $this->search!='' )
            $this->updatedSearch($this->search);
        else
            $this->groupes = DB::table('users')
                            ->selectRaw('users.name as groupe_nom, users.id as id, depots.created_at as depot_date, depots.depot_lien_git as depot_lien_git, depots.depot_note as depot_note, depots.depot_remarque, depots.depot_isaccepted as depot_isaccepted ')
                            ->join('depots','users.id','=','depots.user_id')
                            ->where('depots.projet_id',$this->projet_id)->paginate(10);

        if(Admin::where('user_id', Auth::user()->id)->exists())
        {
            $this->projets = Projet::where('projet_proclame',0)->where('projet_isvalide',1)->get();

        }
        else{
            $this->projets = Projet::where('projet_proclame',0)->where('projet_isvalide',1)->where('created_by',$this->user)->orderBy('created_at','DESC')->get();
        }

        return view('livewire.depot.liste-depot',['groupes'=>$this->groupes]);
    }
    
    public function updatedSearch($search)
    {
        $this->groupes = DB::table('users')
                        ->selectRaw('users.name as groupe_nom,  users.id as id, depots.created_at as depot_date, depots.depot_lien_git as depot_lien_git, depots.depot_note as depot_note, depots.depot_remarque')
                        ->join('depots','users.id','=','depots.user_id')
                        ->where('depots.projet_id',$this->projet_id)
                        ->where('users.name','like','%'.$search.'%')
                        ->paginate(10);


    }

    public function editremarque($user_id)
    {
        $this->update_remarque = true;
        $this->id_mod = $user_id;
        $depot = Depot::where('user_id',$user_id)->where('projet_id',$this->projet_id)->first();
        $this->depot_remarque = $depot->depot_remarque;
    }

    public function gagnant($user_id)
    {
        Depot::where('user_id',$user_id)->where('projet_id',$this->projet_id)->update([
            'depot_isaccepted' => 1
        ]);

        Projet::where('projet_id',$this->projet_id)->update([
            'projet_proclame' =>1
        ]);
        $projet = Projet::where('projet_id',$this->projet_id)->first();
        if(CDO::where('user_id',$projet->created_by)->exists())
        {
            $user_destination = User::find($projet->created_by);
            $message = "Le projet ".$projet->projet_titre." est déjà proclamé. Voir dans l'archive";
            $illustration = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
          </svg>';
            $user_destination->notify(new clientNotif($message,$illustration));
        }
        redirect()->to('/archive');
    }

    public function resetRate($user_id)
    {
    $this->rating = 0;
    Depot::where('user_id', $user_id)->where('projet_id', $this->projet_id)->update([
        'depot_note' => 0
    ]); 
    }

    public function rate($user_id)
    {
        Depot::where('user_id', $user_id)->where('projet_id', $this->projet_id)->update([
            'depot_note' => $this->rating
        ]);
    $this->dispatchBrowserEvent('notification');
    }
    public function archiver()
    {
        Projet::where('projet_id',$this->projet_id)->update([
            'projet_proclame' =>1
        ]);
        $projet = Projet::where('projet_id',$this->projet_id)->first();
        if(CDO::where('user_id',$projet->created_by)->exists())
        {
            $user_destination = User::find($projet->created_by);
            $message = "Le projet ".$projet->projet_titre." est déjà archivé";
            $illustration = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
          </svg>';
            $user_destination->notify(new clientNotif($message,$illustration));
        }
        redirect()->to('/archive');
    }
    public function resetRemarque($user_id)
    {
        $this->depot_remarque = "";
        Depot::where('user_id', $user_id)->where('projet_id', $this->projet_id)->update([
            'depot_remarque' => ""
        ]);
        $this->update_remarque = false;
    }
    public function envoyerRemarque($user_id)
    {
        Depot::where('user_id', $user_id)->where('projet_id', $this->projet_id)->update([
            'depot_remarque' => $this->depot_remarque
        ]);
        $this->dispatchBrowserEvent('notification');
        $this->update_remarque = false;
        
    }
}
