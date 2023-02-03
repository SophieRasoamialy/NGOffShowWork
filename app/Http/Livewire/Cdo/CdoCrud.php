<?php

namespace App\Http\Livewire\Cdo;

use App\Models\CDO;
use Livewire\Component;
use App\Models\User;
use App\Notifications\clientNotif;
use App\Notifications\DeleteUserNotif;
use App\Notifications\ReponseDemande;
use Livewire\WithPagination;

class CdoCrud extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
                'supprimer'
   ];
    private $partenaire;
    public $data = [];
    public $updateMode = false;

    
    public function render()
    {
        $this->partenaire = CDO::join('users','users.id','=','c_d_o_s.user_id')->paginate(6);

        return view('livewire.cdo.cdo-crud',['partenaire' => $this->partenaire]);
    }

    public function validerPremium($user_id)
    {
        CDO::where('user_id',$user_id)->update([
            'cdo_premium' => 1,
            'cdo_isvalide' => 1
        ]);

        $user = User::find($user_id);
                $message = "Vous pouvez maintenant déposer des projets premium.";
                $illustration = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
              </svg>
              ';
                $user->notify(new clientNotif($message,$illustration));
                $this->dispatchBrowserEvent('notification');
    }

    public function validerBasic($user_id)
    {
        if($user_id){
            $user = CDO::where('user_id',$user_id);
            $user->update([
                'cdo_isvalide' => 1
            ]);
           
                $user = User::find($user_id);
                $message = "Vous pouvez maintenant déposer des projets basiques.";
                $illustration = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
              </svg>
              ';
                $user->notify(new clientNotif($message,$illustration));
                $this->dispatchBrowserEvent('notification');
            }
    }

    public function supprimer($user_id,$motif)
    {
        $user = User::find($user_id);
        $user->notify(new DeleteUserNotif($motif));
        User::where('id',$user_id)->delete();
        $this->dispatchBrowserEvent('notifsup');
        //User::join('role_users', 'users.id', '=', 'role_users.user_id')->where('users.id',$user_id)->delete();

    }
}
