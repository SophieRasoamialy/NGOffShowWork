<?php

namespace App\Http\Livewire\Projet;

use App\Models\Admin;
use App\Models\Categorie;
use App\Models\CDO;
use App\Models\CompetenceRequise;
use App\Models\Depot;
use App\Models\DeveloppeurCompetence;
use App\Models\Participation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Projet;
use App\Models\RoleUser;
use Illuminate\Support\Facades\DB;
use App\Models\SousCategorie;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use Livewire\WithFileUploads;
use DateTime;

use App\Models\User;
use App\Notifications\clientNotif;
use App\Notifications\NouveauProjetNotif;
use App\Notifications\PubProjetNotif;

class ProjetCrud extends Component
{
    use WithPagination;
    use WithFileUploads;


    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['recup_projet_id','delete','annuler_pub', 'invalider'];
    
    public $categorie = [];
    public $sous_categorie;
    public $categorieValue = null;
    public $sousCategorieValue = null;
    private $projets  = [];
    private $projets_encours = [];
    private $projets_termine= [];
    private $projet_premium = [];
    private $projet_basic = [];
    public $search = '';
    public $data = [];
    public $detail = [];
    public $projet_id;
    public $projet_image;
    public $user_id;
    public $categorie_id1,$categorie_id2;
    public $indice = 1;
    public $cdo_premium, $cdo_isvalide;
    public $nbre_total_projet, $nbre_projet_encours, $nbre_projet_termine, $nbre_projet_premium,$nbre_projet_basic;

    public function mount()
    {
        $this->user_id =  Auth::user()->id;
        if( CDO::where('user_id',$this->user_id)->exists())
        {
            $cdo = CDO::where('user_id',$this->user_id)->first();
            $this->cdo_premium = $cdo->cdo_premium;
        }
        else
        {
            $this->cdo_premium = 1;
        }
        $this->nombreTotal();

        $this->listeProjet();
        
    }

    public function render()
    {
       $this->categorie = Categorie::orderBy('created_at','desc')->get();

        if(!is_null($this->search) && $this->search !="")
            $this->updatedSearch($this->search);
            
        if(!is_null($this->categorieValue ) )
        {
            $this->updatedCategorieValue($this->categorieValue);
        }
        
       if( $this->search == '' && is_null($this->categorieValue) && is_null($this->sousCategorieValue))
            $this->listeProjet();
        return view('livewire.projet.projet-crud',['projets'=>$this->projets, 'projets_encours'=>$this->projets_encours, 'projets_termine'=>$this->projets_termine, 'projets_premium'=>$this->projet_premium,'projets_basic'=>$this->projet_basic]);
    }

    public function tabs_change($indice)
    {
        $this->indice = $indice;
    }

    public function redirectFormulaire()
    {
        if( CDO::where('user_id',$this->user_id)->exists())
        {
            $cdo = CDO::where('user_id',$this->user_id)->first();
            $this->cdo_isvalide = $cdo->cdo_isvalide;
            if($this->cdo_isvalide==0)
            {
                return redirect()->to('/accueil_cdo');
            }
        }
        redirect('/form_projet?projet_id=0');
    }

    public function edit($projet_id)
    {
        redirect('/form_projet?projet_id='.$projet_id);

    }

    function nombreTotal()
    {
        if(Admin::where('user_id', Auth::user()->id)->exists())
        {
            $this->nbre_total_projet = Projet::count();
            $this->nbre_projet_encours = Projet::where('projet_date_fin','>=',Carbon::now()->setTimezone('Turkey'))->count();
            $this->nbre_projet_termine = Projet::where('projet_date_fin','<',Carbon::now()->setTimezone('Turkey'))->count() ;
            $this->nbre_projet_premium = Projet::where('projet_premium',1)->count() ;
            $this->nbre_projet_basic = Projet::where('projet_premium',0)->count();
        }
        else
        {
            if($this->cdo_premium == 1)
            {
                $this->nbre_total_projet = Projet::where('created_by',$this->user_id)->count();
                $this->nbre_projet_encours = Projet::where('projet_date_fin','>=',Carbon::now()->setTimezone('Turkey'))
                                                    ->where('created_by',$this->user_id)
                                                    ->count();
                $this->nbre_projet_termine = Projet::where('projet_date_fin','<',Carbon::now()->setTimezone('Turkey'))
                                                    ->where('created_by',$this->user_id)
                                                    ->count() ;
                $this->nbre_projet_premium = Projet::where('projet_premium',1)
                                                    ->where('created_by',$this->user_id)
                                                    ->count() ;
                $this->nbre_projet_basic = Projet::where('projet_premium',0)
                                                    ->where('created_by',$this->user_id)
                                                    ->count();
            }
            else
            {
                $this->nbre_total_projet = Projet::where('created_by',$this->user_id)
                                                    ->where('projet_premium',0)
                                                    ->count();
                $this->nbre_projet_encours = Projet::where('projet_date_fin','>=',Carbon::now()->setTimezone('Turkey'))
                                                    ->where('created_by',$this->user_id)
                                                    ->where('projet_premium',0)
                                                    ->count();
                $this->nbre_projet_termine = Projet::where('projet_date_fin','<',Carbon::now()->setTimezone('Turkey'))
                                                    ->where('created_by',$this->user_id)
                                                    ->where('projet_premium',0)
                                                    ->count() ; 
            }

        }
    }

    private function listeProjet()
    {
        $projet = Projet::orderBy('created_at','desc');
        $projet_cdo = Projet::where('created_by',$this->user_id)->orderBy('created_at','desc');
        //si admin
        if(Admin::where('user_id', Auth::user()->id)->exists())
        {

            //tous les projets
            $this->projets = Projet::orderBy('created_at','desc')->paginate(3);
            
            //projet en cours
            $this->projets_encours =$projet->where('projet_date_fin','>=',Carbon::now()->setTimezone('Turkey'))->paginate(3);
        
            //projet terminé
            $this->projets_termine = Projet::orderBy('created_at','desc')
                                            ->where('projet_date_fin','<',Carbon::now()->setTimezone('Turkey'))
                                            ->paginate(3);
            //projet premium
            $this->projet_premium = Projet::where('projet_premium',1)->orderBy('created_at','desc')->paginate(3);

            //projet basic
            $this->projet_basic = Projet::where('projet_premium',0)->orderBy('created_at','desc')->paginate(3);
           // dd($this->projets);
           

        }

        else{
            if($this->cdo_premium == 0)
            {
                //tous les projets
                $this->projets = $projet_cdo->where('projet_premium',0)->paginate(3);
                //projet en cours
                $this->projets_encours = $projet_cdo->where('projet_date_fin','>=',Carbon::now()->setTimezone('Turkey'))->where('projet_premium',0)->paginate(3);

                //projet terminé
                $this->projets_termine = Projet::orderBy('created_at','desc')
                                            ->where('projet_date_fin','<',Carbon::now()->setTimezone('Turkey'))
                                            ->where('projet_premium',0)
                                            ->paginate(3);
            }

            else{
                //tous les projets
                $this->projets = $projet_cdo->paginate(3);
                            
                //projet en cours
                $this->projets_encours = $projet_cdo->where('projet_date_fin','>=',Carbon::now()->setTimezone('Turkey'))->paginate(3);

                //projet terminé
                $this->projets_termine = $projet_cdo->where('projet_date_fin','<',Carbon::now()->setTimezone('Turkey'))->paginate(3);

                //projet premium
                $this->projet_premium = $projet->where('projet_premium',1)->paginate(3);
        
                //projet basic
                $this->projet_basic = $projet->where('projet_premium',0)->paginate(3);

            }
            

        }
        
        
    }

    private function resetInputFields(){
        $this->reset('data');
        $this->projet_id = '';
        $this->projet_image = '';
    }

    public function cache_form()
    {
        $this->resetInputFields();
        $this->dispatchBrowserEvent('cache_form');
    }

    public function cancel()
    {
        $this->resetInputFields();
    }

    public function recup_projet_id($projet_id)
    {
        if(!is_null($projet_id))
        $this->projet_id = $projet_id;
        $this->listeProjet();
        $this->dispatchBrowserEvent('show_modal_pub');
    }

//reherche
    public function updatedSearch($search)
    {
        if(!is_null($search) && $search!='' )
        {
            $projet =  DB::table('projets')
                        ->join('users','users.id','=','projets.created_by')
                        ->where('projets.projet_titre', 'LIKE', '%'.$search.'%')
                        ->orwhere('projets.projet_description', 'LIKE', '%'.$search.'%')
                        ->orderBy('projets.created_at','desc');

            $projet_cdo = DB::table('projets')
                        ->where('created_by',$this->user_id)
                        ->where('projet_titre', 'LIKE', '%'.$search.'%')
                        ->orwhere('projet_description', 'LIKE', '%'.$search.'%')
                        ->orderBy('created_at','desc');
            //if admin
            if(Admin::where('user_id', Auth::user()->id)->exists())
            {
                //projet en cours
                    $this->projets_encours = $projet->where('projet_date_fin','>=',Carbon::now()->setTimezone('Turkey'))
                                            ->paginate(3);
                    $this->nbre_projet_encours = $projet->where('projet_date_fin','>=',Carbon::now()->setTimezone('Turkey'))
                                                        ->count();
                
                //projet terminé
                    $this->projets_termine = DB::table('projets')
                                            ->join('users','users.id','=','projets.created_by')
                                            ->where('projets.projet_titre', 'LIKE', '%'.$search.'%')
                                            ->orwhere('projets.projet_description', 'LIKE', '%'.$search.'%')
                                            ->orderBy('projets.created_at','desc')
                                            ->where('projet_date_fin','<',Carbon::now()->setTimezone('Turkey'))
                                            ->paginate(3);
                    $this->nbre_projet_termine = DB::table('projets')
                                                ->join('users','users.id','=','projets.created_by')
                                                ->where('projets.projet_titre', 'LIKE', '%'.$search.'%')
                                                ->orwhere('projets.projet_description', 'LIKE', '%'.$search.'%')
                                                ->where('projet_date_fin','<',Carbon::now()->setTimezone('Turkey'))
                                                ->count();
                
                //tous les projets
                    $this->projets =$projet->paginate(3);
                    $this->nbre_total_projet = $projet->count();
                //projet premium
                $this->projet_premium = $projet->where('projet_premium',1)->paginate(3);
                $this->nbre_projet_premium =  $projet->where('projet_premium',1)->count();
        
                //projet basic
                $this->projet_basic = $projet->where('projet_premium',0)->paginate(3);
                $this->nbre_projet_basic =  $projet->where('projet_premium',0)->count();

            }

            // if not admin
            else{
                //cdo non premium
                if($this->cdo_premium == 0)
                {
                    //projet en cours
                    $this->projets_encours = $projet_cdo->where('projet_date_fin','>=',now())
                                                        ->where('projet_premium',0)
                                                         ->paginate(3);
                    $this->nbre_projet_encours = $projet_cdo->where('projet_date_fin','>=',now())
                                                        ->where('projet_premium',0)
                                                        ->count();

                    //projet terminé
                    $this->projets_termine = $projet_cdo->where('projet_date_fin','<',now())
                                                        ->where('projet_premium',0)
                                                        ->paginate(3);
                    $this->nbre_projet_termine = $projet_cdo->where('projet_date_fin','<',now())
                                                ->where('projet_premium',0)
                                                ->count();

                    //tous les projets
                    $this->projets =$projet_cdo->where('projet_premium',0)->paginate(3);
                    $this->nbre_total_projet = $projet_cdo->where('projet_premium',0)->count() ;
                    
                }

                else{
                 //projet en cours
                    $this->projets_encours = $projet_cdo->where('projet_date_fin','>=',now())
                                                        ->paginate(3);
                    $this->nbre_projet_encours = $projet_cdo->where('projet_date_fin','>=',now())->count();
                
                //projet terminé
                    $this->projets_termine = $projet_cdo->where('projet_date_fin','<',now())
                                                        ->paginate(3); 
                    $this->nbre_projet_termine = $projet_cdo->where('projet_date_fin','<',now())->count();
                
                //tous les projets
                    $this->projets =$projet_cdo->paginate(3);
                    $this->nbre_total_projet = $projet_cdo->count();

                    //projet premium
                    $this->projet_premium = $projet->where('projet_premium',1)->paginate(3);
                    $this->nbre_projet_premium = $projet->where('projet_premium',1)->count();
            
                    //projet basic
                    $this->projet_basic = $projet->where('projet_premium',0)->paginate(3);
                    $this->nbre_projet_basic = $projet->where('projet_premium',0)->count();
                }
            }
            
                 
        }
        
        else  
            $this->listeProjet();
        
    }

    //grouper par categorie
    public function updatedCategorieValue($categorie)
    {  
        if(!is_null($categorie) && $categorie!=0)
        {
            $projet = Projet::join('categories','projets.categorie_id','=','categories.categorie_id')
                    ->where('categories.categorie_id',$categorie)
                    ->orderBy('projets.created_at','desc');

            $projet_cdo =  Projet::join('categories','projets.categorie_id','=','categories.categorie_id')
                                ->where('created_by',$this->user_id)
                                ->where('categories.categorie_id',$categorie)
                                ->orderBy('projets.created_at','desc');
            

            //if admin
            if(Admin::where('user_id', Auth::user()->id)->exists())
            {
            //projet en cours
                $this->projets_encours = $projet->where('projet_date_fin','>=',now())
                                        ->paginate(3);
                $this->nbre_projet_encours =$projet->where('projet_date_fin','>=',now())
                                        ->count(); 
            
            //projet terminé
                $this->projets_termine = $projet->where('projet_date_fin','<',now())
                                        ->paginate(3);
                $this->nbre_projet_termine = $projet->where('projet_date_fin','<',now())
                                            ->count();
            
            //tous les projets
                $this->projets = Projet::join('categories','projets.categorie_id','=','categories.categorie_id')
                                        ->where('categories.categorie_id',$categorie)
                                        ->orderBy('projets.created_at','desc')->paginate(3);

                $this->nbre_total_projet = Projet::join('categories','projets.categorie_id','=','categories.categorie_id')
                                                ->where('categories.categorie_id',$categorie)
                                                ->orderBy('projets.created_at','desc')
                                                ->count();
               // dd($this->projets);
            //projet premium
            $this->projet_premium = $projet->where('projet_premium',1)->paginate(3);
            $this->nbre_projet_premium = $projet->where('projet_premium',1)->count(); 
       
            //projet basic
            $this->projet_basic = $projet->where('projet_premium',0)->paginate(3);

            $this->nbre_projet_basic = $projet->count();
            }

            else{
                if($this->cdo_premium == 0)
                {
                    //projet en cours
                $this->projets_encours = $projet_cdo->where('projet_premium',0)
                                            ->where('projet_date_fin','>=',now())
                                            ->paginate(3);
                $this->nbre_projet_encours = $projet_cdo->where('projet_premium',0)
                                                ->where('projet_date_fin','>=',now())
                                                ->count();
                //projet terminé
                $this->projets_termine =$projet_cdo->where('projet_premium',0)
                                        ->where('projet_date_fin','<',now())
                                        ->paginate(3);
                $this->nbre_projet_termine = $projet_cdo->where('projet_premium',0)
                                            ->where('projet_date_fin','<',now())
                                            ->count();

                //tous les projets
                $this->projets =$projet_cdo->where('projet_premium',0)->paginate(3);
                $this->nbre_total_projet = $projet_cdo->where('projet_premium',0)->count();
                }
                else
                {
                //projet en cours
                $this->projets_encours = $projet_cdo->where('projet_date_fin','>=',now())
                                        ->paginate(3);
                $this->nbre_projet_encours = $projet_cdo->where('projet_date_fin','>=',now())->count();
            
                //projet terminé
                    $this->projets_termine =$projet_cdo->where('projet_date_fin','<',now())
                                            ->paginate(3);
                    $this->nbre_projet_termine = $projet_cdo->where('projet_date_fin','<',now())->count() ;
                
                //tous les projets
                    $this->projets =Projet::join('categories','projets.categorie_id','=','categories.categorie_id')
                                            ->where('created_by',$this->user_id)
                                            ->where('categories.categorie_id',$categorie)
                                            ->orderBy('projets.created_at','desc')->paginate(3);
                    $this->nbre_total_projet = Projet::join('categories','projets.categorie_id','=','categories.categorie_id')
                                                    ->where('created_by',$this->user_id)
                                                    ->where('categories.categorie_id',$categorie)
                                                    ->count();

                //projet premium
                $this->projet_premium = $projet->where('projet_premium',1)->paginate(3);

                $this->nbre_projet_premium = $projet->where('projet_premium',1)->count();
        
                //projet basic
                $this->projet_basic = $projet->where('projet_premium',0)->paginate(3);
                $this->nbre_projet_basic = $projet->where('projet_premium',0)->count();
                }
            }

        }
        if($categorie == 0)
        {
            $this->listeProjet();
        }
    }

    
    public function delete($id)
    {
        $projet = Projet::where('projet_id',$id)->first();

        
          if(CDO::where('user_id',$projet->created_by)->exists())
          {
            $message = "Votre projet intitulé ".$projet->projet_titre." est supprimé par l'admin";
            $illustration = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
          </svg>
          ';
          $user_destination = User::find($projet->created_by);
          $user_destination->notify(new clientNotif($message, $illustration));
          }

        if($id){
            Projet::where('projet_id',$id)->delete();
        }
        
        $this->listeProjet();
    }
    
   
    
    public function valider($projet_id)
    {
        Projet::where('projet_id',$projet_id)->update([
            'projet_isvalide' => 1
        ]);
        $projet = Projet::where('projet_id',$projet_id)->first();

        $projet = Projet::where('projet_id',$projet_id)->first();
        //notification pour le client
          if(CDO::where('user_id',$projet->created_by)->exists())
          {
            $message = "Votre projet intitulé ".$projet->projet_titre." est déjà public";
            $illustration = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
          </svg>
          ';
          $user_destination = User::find($projet->created_by);
          $user_destination->notify(new clientNotif($message, $illustration));
          }

          //notification pour les dévéloppeurs
        $competence = CompetenceRequise::where('categorie_id',$projet->categorie_id)->get();
    
        $user = DeveloppeurCompetence::whereIn('competence_id',$competence->toArray())->distinct('user_id')->get('user_id');
        foreach($user as $ligne)
        {
        $user_destination = User::find($ligne->user_id);
        $user_destination->notify(new NouveauProjetNotif($projet->projet_titre, $projet->projet_budget,""));
        }
    }
    public function invalider($projet_id,$motif)
    {
        Projet::where('projet_id',$projet_id)->update([
            'projet_isvalide' => 0
        ]);
        $projet = Projet::where('projet_id',$projet_id)->first();

        if(CDO::where('user_id',$projet->created_by)->exists())
          {
            $message = "La publication de votre projet intitulé ".$projet->projet_titre." est annnulé.\n Cause: ".$motif;
            $illustration = ' <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            ';
            $user_destination = User::find($projet->created_by);
            $user_destination->notify(new clientNotif($message, $illustration));
          }
    }

}
