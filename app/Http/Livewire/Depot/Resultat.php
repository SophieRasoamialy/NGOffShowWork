<?php

namespace App\Http\Livewire\Depot;

use App\Models\Categorie;
use App\Models\Depot;
use App\Models\Projet;
use Livewire\Component;
use Livewire\WithPagination;

class Resultat extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    private $resultat;
    public $categorie;
    public $categorie_label = null, $projet_titre = null;
    public $nbre_categorie;

    public function mount()
    {
        $this->show_tout_categorie();
    }

    public function render()
    {
        $this->categorie = Categorie::selectRaw('categories.categorie_id as categorie_id, categories.categorie_label as categorie_label, count(projets.projet_id) as nbre_projet')
                                    ->join('projets','projets.categorie_id','=','categories.categorie_id')
                                    ->orderBy('categories.categorie_label', 'ASC')
                                    ->groupBy('categories.categorie_id','categories.categorie_label')
                                    ->get();
        $this->nbre_categorie = Categorie::count();
        return view('livewire.depot.resultat',['resultat'=>$this->resultat]);
    }

    public function resultParCategorie($categorie_id)
    {
        $categ = Categorie::where('categorie_id',$categorie_id)->first();
        $this->categorie_label = $categ->categorie_label;
        $this->projet_titre = null;

        $this->resultat = Depot::join('developpeurs','developpeurs.user_id','=','depots.user_id')
                            ->join('users','users.id','=','developpeurs.user_id')
                            ->join('projets','projets.projet_id','=','depots.projet_id')
                            ->selectRaw('COUNT(projets.projet_id) as nbre_projet, SUM(depots.depot_note) as nbre_etoile, users.name as name, users.avatar as avatar, developpeurs.developpeur_a_propos, users.id as id, developpeurs.developpeur_etablissement')
                            ->where('projets.categorie_id',$categorie_id)
                            ->groupBy('developpeurs.user_id', 'users.name', 'users.avatar', 'developpeurs.developpeur_a_propos','users.id', 'developpeurs.developpeur_etablissement')
                            ->orderBy('nbre_etoile', 'DESC')
                            ->paginate(10);
    }

    public function resultParProjet($projet_id)
    {
        $projet = Projet::where('projet_id',$projet_id)->first();
        $this->projet_titre = $projet->projet_titre;
        $this->resultat = Depot::join('developpeurs','developpeurs.user_id','=','depots.user_id')
                            ->join('users','users.id','=','developpeurs.user_id')
                            ->join('projets','projets.projet_id','=','depots.projet_id')
                            ->selectRaw('COUNT(projets.projet_id) as nbre_projet, SUM(depots.depot_note) as nbre_etoile, users.name as name, users.avatar as avatar, developpeurs.developpeur_a_propos, users.id as id, developpeurs.developpeur_etablissement')
                            ->where('projets.projet_id',$projet_id)
                            ->groupBy('developpeurs.user_id', 'users.name', 'users.avatar', 'developpeurs.developpeur_a_propos','users.id', 'developpeurs.developpeur_etablissement')
                            ->orderBy('nbre_etoile', 'DESC')
                            ->paginate(10);
    }

    public function show_tout_categorie()
    {
        $this->resultat = Depot::join('developpeurs','developpeurs.user_id','=','depots.user_id')
                            ->join('users','users.id','=','developpeurs.user_id')
                            ->join('projets','projets.projet_id','=','depots.projet_id')
                            ->selectRaw('COUNT(projets.projet_id) as nbre_projet, SUM(depots.depot_note) as nbre_etoile, users.name as name, users.avatar as avatar, developpeurs.developpeur_a_propos, users.id as id, developpeurs.developpeur_etablissement')
                            ->groupBy('developpeurs.user_id', 'users.name', 'users.avatar', 'developpeurs.developpeur_a_propos','users.id', 'developpeurs.developpeur_etablissement')
                            ->orderBy('nbre_etoile', 'DESC')
                            ->paginate(10);
        
        $this->categorie_label = null;
        $this->projet_titre = null;
    }
}
