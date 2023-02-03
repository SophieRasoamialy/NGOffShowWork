<?php

namespace App\Http\Livewire\Projet;

use App\Models\Admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Projet;
use Illuminate\Support\Facades\DB;
use App\Models\SousCategorie;
use Livewire\Component;
use App\Models\Categorie;
use App\Models\CDO;
use App\Models\CompetenceRequise;
use App\Models\DeveloppeurCompetence;
use App\Models\User;
use App\Notifications\NouveauProjetNotif;
use Carbon\Carbon;
use DateTime;
use Livewire\WithFileUploads;


class ProjetForm extends Component
{
    use WithFileUploads;
    protected $listeners = ['edit','update','store'];
   
    public $projets ;
    public $categorie;
    public $categorieId = NULL;
    public $data = [];
    public $updateMode = false;
    public $user_id;
    public $projet_id;
    public $projet_image,$change = false;
    public $budget_min, $duree_min;
    public $projet_premium = false;
    public $cdo_premium;
    public $projet_description;
    public $ancien_duree;
    
    public function mount()
    {
        $this->projet_id = $_GET['projet_id'];
        $this->user_id = Auth::user()->id;
        if( CDO::where('user_id',$this->user_id)->exists())
        {
        $cdo = CDO::where('user_id',$this->user_id)->first();
        $this->cdo_premium = $cdo->cdo_premium;
        }
        else
        {
            $this->cdo_premium = 1;
        }
    }

    public function render()
    {
        $this->categorie = DB::select('select * from categories order by created_at desc');
        if($this->projet_id != 0)
        {
            $this->edit($this->projet_id);
        }
       
        return view('livewire.projet.projet-form');
    }

    private function resetInputFields(){
        $this->projet_image = "";
        $this->reset('data');
    }

    public function store()
    {
        if($this->projet_premium == true)
        {
            $validator = Validator::make($this->data, [
                'projet_titre' => 'required|min:3|max:70',
                'projet_duree' => 'required|numeric|min:7',
                'projet_budget' => 'required|numeric|min:800000',
            ])->validate();
        }
        else
        {
                $validator = Validator::make($this->data, [
                    'projet_titre' => 'required|min:3|max:70',
                    'projet_duree' => 'required|numeric|min:'.$this->duree_min,
                    'projet_budget' => 'required|numeric|min:'.$this->budget_min,
                    
                ])->validate();
        }
        
        $this->validate([
            'categorieId' => 'required',
            'projet_description' => 'required|min:5|max:65535'
        ]);
        

        $date_fin  = now()->addDays($this->data['projet_duree']);
        $projet = Projet::make($this->data);
        $projet->categorie_id = $this->categorieId;
        $projet->projet_description = $this->projet_description;
        $projet->projet_date_fin = $date_fin;
        $projet->created_by = $this->user_id;
        $projet->projet_premium = $this->projet_premium;
        if(Admin::where('user_id',$this->user_id)->exists())
        $projet->projet_isvalide = 1;
        $projet->save();

        
    
        $this->resetInputFields();
        $this->dispatchBrowserEvent('hide_modal_form',['title' => 'Projet crée avec succès ! ']);
        redirect('/liste_projet');
    }
    
    
    function updatedCategorieId($categorieId)
    {
        $categorie = Categorie::where('categorie_id',$categorieId)->first();
        $this->budget_min = $categorie->budget_min;
        $this->duree_min = $categorie->duree_min;

        if($this->projet_premium != null)
        {
           $this->updatedProjetPremium(); 
        }
    }

    function updatedProjetPremium()
    {
        $this->budget_min = 800000;
        $this->duree_min = 7;
    }

    function updatedProjetImage()
    {
        $this->change = true;
    }

    public function edit($id)
    {
        $this->updateMode = true;
       // $this->projet_id = $id;

        $projet = Projet::where('projet_id',$id)->first();
        $categorie_id = $projet->categorie_id;
        $categorie = Categorie::where('categorie_id',$categorie_id)->first();
        $categorie_label = $categorie->categorie_label;
        
        $this->categorieId = $categorie_id;
        $this->projet_description = $projet->projet_description;

        $this->data= [
            'categorie_label' => $categorie_label,
            'categorie_id' => $categorie_id,
            'projet_duree' => $projet->projet_duree,
            'projet_budget' => $projet->projet_budget,
            'projet_date_fin' =>$projet->projet_date_fin,
           // 'projet_description' => $projet->projet_description,
            'projet_titre' => $projet->projet_titre,
        ];
           // $this->projet_premium = $projet->projet_premium;
        $this->updatedCategorieId($categorie_id);
        $this->ancien_duree = $projet->projet_duree ;
        $this->projet_image = $projet->projet_image;


    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->categorieId = null;
        $this->projet_description = "";
        $this->resetInputFields();
        redirect('/liste_projet');

    }

    public function update()
    {
        if($this->projet_premium == true)
        {
            $validator = Validator::make($this->data, [
                'projet_titre' => 'required|min:3|max:70',
                'projet_duree' => 'required|numeric|min:7',
                'projet_budget' => 'required|numeric|min:800000',
                
            ])->validate();
        }
        else{
            $validator = Validator::make($this->data, [
                'projet_titre' => 'required|min:3|max:70',
                'projet_duree' => 'required|numeric|min:'.$this->duree_min,
                'projet_budget' => 'required|numeric|min:'.$this->budget_min,
                
            ])->validate();
            }
        
            $this->validate([
                'categorieId' => 'required',
                'projet_description' => 'required|min:5|max:65535',
            ]);
            
            $dt = Carbon::createFromFormat("Y-m-d H:i:s", $this->data['projet_date_fin']);

            if($this->data['projet_duree'] > $this->ancien_duree)
            {
                $duree_plus =(int) ((int) $this->data['projet_duree'] - (int) $this->ancien_duree);
                $date_fin  = $dt->addDays($duree_plus);
            }
            elseif($this->data['projet_duree'] < $this->ancien_duree)
            {
                $duree_plus =(int) ((int) $this->ancien_duree -  (int)$this->data['projet_duree']) ;
                $date_fin  = $dt->subDays($duree_plus);
            }
            else
            $date_fin = $this->data['projet_date_fin'];

            if($this->projet_premium == true)
                $projet_ispremium = 1;
            else
            $projet_ispremium = 0;

            if (!is_null($this->projet_id)) {
                $projet = Projet::where('projet_id',$this->projet_id);
                $projet->update([
                    'categorie_id' => $this->categorieId,
                    'projet_duree' => $this->data['projet_duree'],
                    'projet_description' =>$this->projet_description,
                    'projet_budget' => $this->data['projet_budget'],
                    'projet_titre' => $this->data['projet_titre'],
                    'projet_date_fin' => $date_fin,
                    'projet_premium' => $projet_ispremium
                ]);

            $this->updateMode = false;
            $this->resetInputFields();

            $this->dispatchBrowserEvent('hide_modal_form',['title' => 'Projet mis à jour avec succès ! ']);
            redirect('/liste_projet');
            }
        

    
    }
}
