<?php

namespace App\Http\Livewire\Categorie;

use App\Models\Categorie;
use App\Models\Competence;
use App\Models\CompetenceRequise;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\Carbon;


class CategorieCrud extends Component
{
    use WithFileUploads;

    public $select_categorie_id;
    public $categorie_id ;
    public $categorie_label;
    public $categorie;
    public $data = [];
    public $updateMode = false;
    public $user_id;
    public $showCompetence = false;
    public $categorie_illustration, $budget_min,$duree_min;
    public $competence = [];
    public $toutCompetence = [];
    public $change = false, $showListeCompetence = false;
    protected $listeners = [
        'recup_categorie_id','recup_sous_categorie_id','delete','deleteSousCategorie'
   ];
   


    public function render()
    {
        $sql = 'select * from categories order by created_at desc';
        $this->categorie = DB::select($sql);
       
        return view('livewire.categorie.categorie-crud');
    }
    
    public function close()
    {
        $this->categorie_label = "";
        $this->categorie_illustration = null;
        $this->budget_min = "";
        $this->duree_min = "";
        $this->categorie_id = "";
        $this->change = false;
    }
    
    private function resetInputFields(){
        $this->categorie_label = "";
        $this->categorie_illustration = null;
        $this->budget_min = "";
        $this->duree_min = "";
        $this->categorie_id = "";
        $this->updateMode = false;
        $this->change = false;
    }

    public function store()
    {
        $validate = $this->validate([
            'categorie_label' => 'required|min:2|max:50',
            'budget_min' => 'required|numeric|min:5',
            'duree_min' => 'required|numeric'
            
        ]);
        $this->validate([
            'categorie_illustration' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
        ]);
        $imageName = Carbon::now()->timestamp. '.' .$this->categorie_illustration->extension();

        $this->categorie_illustration->storeAs('public/categorieImage',$imageName);

        
        $donnee = Categorie::make($validate);
        $donnee->categorie_illustration = $imageName;
        $donnee->save();
        $this->resetInputFields();
        $this->dispatchBrowserEvent('notification',['title' => 'Categorie ajouté avec succès ! ']);
        
    }

    public function showCompetence($categorie_id)
    {
       $this->showCompetence = true;
        $this->competence = Competence::join('competence_requises', 'competence_requises.competence_id','=','competences.competence_id')->where('competence_requises.categorie_id',$categorie_id)->get();
        $this->categorie_id = $categorie_id;
        $this->dispatchBrowserEvent('changeColor',['categorie_id' => $categorie_id]);
    
    }

    public function listeCompetence($categorie_id)
    {
        $this->categorie_id = $categorie_id;
        if($this->showListeCompetence==true)
        {
            $this->showListeCompetence = false;
        }
        else
        {
            $this->showListeCompetence = true;
            $this->toutCompetence = Competence::whereNotIn('competence_id',CompetenceRequise::where('categorie_id',$categorie_id)->pluck('competence_id')->toArray())
                                                 ->get();
        }
        
    }

    public function selectCompetence($competence_id)
    {
        CompetenceRequise::create([
            'competence_id' => $competence_id,
            'categorie_id' => $this->categorie_id
        ]);
        $this->listeCompetence($this->categorie_id);
        $this->showCompetence($this->categorie_id);
        $this->showListeCompetence = true;
    }

    public function enleverCompetence($competence_id,$categorie_id)
    {
        CompetenceRequise::where('competence_id',$competence_id)->where('categorie_id',$categorie_id)->delete();
        $this->showListeCompetence = false;
        $this->listeCompetence($categorie_id);
        $this->showCompetence($categorie_id);

    }

    public function edit($id)
    {
        $this->updateMode = true;
        $categorie = Categorie::where('categorie_id',$id)->first();
        
        $this->categorie_label =  $categorie->categorie_label;
        $this->budget_min = $categorie->budget_min;
        $this->duree_min = $categorie->duree_min;
        $this->categorie_illustration = $categorie->categorie_illustration;
        $this->categorie_id = $id;
    }
   

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }


    public function updatedCategorieIllustration()
    {
        $this->change = true;
    }

    public function update()
    {
        $validate = $this->validate([
            'categorie_label' => 'required|min:5',
            'budget_min' => 'required',
            'duree_min' => 'required'
            
        ]);
        if($this->change )
        {
            $this->validate([
                'categorie_illustration' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
            ]);

            $imageName = Carbon::now()->timestamp. '.' .$this->categorie_illustration->extension();

            $this->categorie_illustration->storeAs('public/categorieImage',$imageName);
        }

        else{
            $imageName = $this->categorie_illustration;
        }



        if ($this->categorie_id) {
            $categorie = Categorie::where('categorie_id',$this->categorie_id);
            $categorie->update([
                'categorie_label' => $this->categorie_label,
                'categorie_illustration' => $imageName,
                'budget_min' => $this->budget_min,
                'duree_min' => $this->duree_min
            ]);

            $this->updateMode = false;
            $this->resetInputFields();
            $this->dispatchBrowserEvent('notification',['title' => 'Categorie mis à jour avec succès ! ']);        
        }
    }

    public function delete($id)
    {
        if($id){
            Categorie::where('categorie_id',$id)->delete();
            $this->dispatchBrowserEvent('notification',['title' => 'Categorie supprimée ! ']);        
        }
    }

  
}
