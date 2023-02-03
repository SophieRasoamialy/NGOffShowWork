<?php

namespace App\Http\Livewire\Demande;

use Livewire\Component;
use App\Models\Categorie;
use App\Models\Competence;
use App\Models\CompetenceRequise;
use App\Models\DeveloppeurCompetence;
use App\Models\User;
use App\Models\Developpeur as Dev;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use stdClass;

class Developpeur extends Component
{ 
    use WithFileUploads;

    protected $listeners = [
        'showCompetence','next'
    ];

    public $categorie, $user_id;
    public $categorie_label,$categorie_id;
    public $profile_photo = null;
    public $profile_nom;
    public $profile_prenom;
    public $profile_contact;
    public $a_propos,$developpeur_etablissement;
    public $show_competence = false, $competence;
    public $currentStep = 1;
    public $competence_user = [];
    public $experience = [], $education = [], $qualification = [];
    public $experience_until_now  = false, $education_until_now = false;

    public function mount()
    {
        $this->user_id = Auth::user()->id;
         
    }
    public function render()
    {
        

        $this->showCompetenceUser();

        $this->categorie = Categorie::all();
        return view('livewire.demande.developpeur');
    }

    

   /**
     * Write code on Method
     *
     * @return response()
     */
    //enregistrement de profile
    public function firstStepSubmit()
    {
        $validatedData = $this->validate([
            'profile_nom' => 'required|min:3|max:50',//validaion text seulement
            'profile_prenom' => 'max:50',
            'profile_contact' => 'required|numeric|digits:10'
        ]);
 
        $this->currentStep = 2;
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    //enregistrement de a propos
    public function secondStepSubmit()
    {
        $validatedData = $this->validate([
            'a_propos' => 'required|max:50',
            'developpeur_etablissement' => 'required|max:50'
        ]);
  
        $this->currentStep = 3;
    }

    //enregistrement de  l'experience
    public function thirdStepSubmit()
    {        
        $validator = Validator::make($this->experience, [
            'titre' => 'required|min:3',
            'entreprise_nom' => 'required|min:2',
            'experience_debut_mois' => 'required',
            'experience_debut_annee' => 'required',
            'description' => 'required|min:10'

        ])->validate();
        

        if($this->experience_until_now ==true)
        {
            

            $this->experience['experience_fin_mois'] = 0;
            $this->experience['experience_fin_annee'] = 0;
        }
        else{
            Validator::make($this->experience, [
                'experience_fin_annee' =>'gte:experience_debut_annee',
            ])->validate();
        }
        if($this->experience['experience_debut_annee'] == $this->experience['experience_fin_annee'])
        {
            Validator::make($this->experience,[
                'experience_fin_mois' => 'gte:experience_debut_mois'
            ])->validate();
        }

        switch ($this->experience['experience_fin_mois']) {
            case "1":
                $this->experience['experience_fin_mois'] = "Janvier";
              break;
            case "2":
                $this->experience['experience_fin_mois'] = "Février";
              break;
              case "3":
                $this->experience['experience_fin_mois'] = "Mars";
              break;
              case "4":
                $this->experience['experience_fin_mois'] = "Avril";
              break;
              case "5":
                $this->experience['experience_fin_mois'] = "Mai";
              break;
              case "6":
                $this->experience['experience_fin_mois'] = "Juin";
              break;
              case "7":
                $this->experience['experience_fin_mois'] = "Juillet";
              break;
              case "8":
                $this->experience['experience_fin_mois'] = "Août";
              break;
              case "9":
                $this->experience['experience_fin_mois'] = "Septembre";
              break;
              case "10":
                $this->experience['experience_fin_mois'] = "Octobre";
              break;
              case "11":
                $this->experience['experience_fin_mois'] = "Novembre";
              break;
              case "12":
                $this->experience['experience_fin_mois'] = "décembre";
              break;
            default:
                $this->experience['experience_fin_mois'] = "Inconnu";
          }

          switch ($this->experience['experience_debut_mois']) {
            case "1":
                $this->experience['experience_debut_mois'] = "Janvier";
              break;
            case "2":
                $this->experience['experience_debut_mois'] = "Février";
              break;
              case "3":
                $this->experience['experience_debut_mois'] = "Mars";
              break;
              case "4":
                $this->experience['experience_debut_mois'] = "Avril";
              break;
              case "5":
                $this->experience['experience_debut_mois'] = "Mai";
              break;
              case "6":
                $this->experience['experience_debut_mois'] = "Juin";
              break;
              case "7":
                $this->experience['experience_debut_mois'] = "Juillet";
              break;
              case "8":
                $this->experience['experience_debut_mois'] = "Août";
              break;
              case "9":
                $this->experience['experience_debut_mois'] = "Septembre";
              break;
              case "10":
                $this->experience['experience_debut_mois'] = "Octobre";
              break;
              case "11":
                $this->experience['experience_debut_mois'] = "Novembre";
              break;
              case "12":
                $this->experience['experience_debut_mois'] = "décembre";
              break;
            default:
                $this->experience['experience_debut_mois'] = "Inconnu";
          }
          
        

        $this->currentStep = 4;


    }
    //enregistrement de l'education

    public function forthStepSubmit()
    {
        Validator::make($this->education, [
            'province' => 'required',
            'universite' => 'required',
            'diplome' => 'required',
            'education_debut_annee' => 'required',
        ])->validate();

        if($this->education_until_now == true)
        {
            $this->education['education_fin_annee'] = 0;
        }
        else{
            Validator::make($this->education,[
                'education_fin_annee' => 'gte:education_debut_annee'
            ])->validate();
        }
        $this->currentStep = 5;
    }

    //enregistrement de qualificatio et envoie dans la base de données de tous les données
    public function lastStepSubmit()
    {


        if(is_null($this->profile_photo))
        {
            $imageName = "user.png";
        }
        else{
            $imageName = Carbon::now()->timestamp. '.' .$this->profile_photo->extension();
            $this->profile_photo->storeAs('public/profile',$imageName);

        }
        User::where('id',$this->user_id)->update([
            'avatar' =>$imageName
        ]);

            // Créez un autre objet JSON vide
            $experience = new stdClass();
            $experience_par_defaut = new stdClass() ;
            $experience = json_encode($this->experience);
            $obj_experience = array_merge((array)$experience,(array)json_encode($experience_par_defaut));
            
            // Créez un autre objet JSON vide
            $education = new stdClass();
            $education_par_defaut = new stdClass() ;
            $education = json_encode($this->education);
            $obj_education = array_merge((array)$education,(array)json_encode($education_par_defaut)); 

            // Créez un autre objet JSON vide
            $qualification = new stdClass();
            $qualification_par_defaut = new stdClass();
            $education = json_encode($this->qualification);
            $obj_qualification = array_merge((array)$qualification,(array)json_encode($qualification_par_defaut));


        Dev::create([
            'user_id' => $this->user_id,
            'developpeur_a_propos' => $this->a_propos,
            'developpeur_etablissement' =>$this->developpeur_etablissement,
            'developpeur_experience' =>json_encode($obj_experience),
            'developpeur_education' => json_encode($obj_education),
            'developpeur_qualification' => json_encode($obj_qualification),
            'firstname' => $this->profile_nom,
            'lastname'  => $this->profile_prenom,
            'developpeur_contact' => $this->profile_contact
        ]);

        $this->clearForm();
        redirect('/projets');
    }
  
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function back($step)
    {
        $this->currentStep = $step;    
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function clearForm()
    {
        $this->profile_nom = "";
        $this->profile_photo = "";
        $this->profile_contact = "";
        $this->profile_prenom = "";
        $this->a_propos = "";
        $this->developpeur_etablissement  = "";
        $this->experience = [];
        $this->education = [];
        $this->qualification = [];
    }

    public function showCompetenceUser()
    {
        $this->competence_user = Competence::join('developpeur_competences','developpeur_competences.competence_id','=','competences.competence_id')
                                            ->where('developpeur_competences.user_id',$this->user_id) 
                                            ->get();

    }

    public function enleverCompetence($competence_id)
    {
        DeveloppeurCompetence::where('competence_id',$competence_id)->where('user_id',$this->user_id)->delete();
        $this->showCompetence($this->categorie_id);
    }

    public function showCompetence($categorie_id)
    {
        $this->show_competence = true;
        $categorie = Categorie::where('categorie_id',$categorie_id)->first();
        $this->categorie_label = $categorie->categorie_label;
        $this->categorie_id = $categorie_id;
        $this->competence = Competence::join('competence_requises','competence_requises.competence_id','=','competences.competence_id')
                                        ->where('competence_requises.categorie_id',$categorie_id)
                                        ->whereNotIn('competence_requises.competence_id', DeveloppeurCompetence::where('user_id',$this->user_id)->pluck('competence_id')->toArray())
                                        ->get();
        
    }

    public function selectCompetence($competence_id)
    {
        DeveloppeurCompetence::create([
            'competence_id' => $competence_id,
            'user_id' => $this->user_id
        ]);
        $this->showCompetence($this->categorie_id);
    }

}
