<?php

namespace App\Http\Livewire\Competence;

use App\Models\Competence;
use Livewire\Component;
use Livewire\WithPagination;
use tidy;

class CompetenceCrud extends Component
{
    use WithPagination;


    protected $paginationTheme = 'bootstrap';

    private $competences;
    public $competence_label, $competence_id;
    public $updateMode = false;
    protected $listeners = [
        'delete'
    ];

    public function render()
    {
        $this->competences =Competence::latest()->paginate(10) ;
        return view('livewire.competence.competence-crud',['competence'=>$this->competences]);
    }

    public function store()
    {
        $this->validate([
            'competence_label' => 'required|min:2|max:50'
        ]);

        Competence::create([
            'competence_label' => $this->competence_label
        ]);

        $this->competence_label = "";
        $this->dispatchBrowserEvent('notification',['title' => 'Competence ajouté avec succès ! ']);        

    }

    public function edit($competence_id,$competence_label)
    {
        $this->competence_id = $competence_id;
        $this->competence_label = $competence_label;
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'competence_label' => 'required|min:2'
        ]);

        if($this->competence_id)
        {
            Competence::where('competence_id',$this->competence_id)->update([
                'competence_label' => $this->competence_label
            ]);
            $this->updateMode = false;
            $this->competence_label = "";
            $this->dispatchBrowserEvent('notification',['title' => 'Competence mise à jour avec succès ! ']);        
        }
    }

    public function delete($competence_id)
    {
        if($competence_id)
        {
            Competence::where('competence_id',$competence_id)->delete();
        }
    }
}
