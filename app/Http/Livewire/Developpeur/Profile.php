<?php

namespace App\Http\Livewire\Developpeur;

use App\Models\Categorie;
use App\Models\Competence;
use App\Models\Developpeur;
use App\Models\DeveloppeurCompetence;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use stdClass;

class Profile extends Component
{

    public $developpeur, $user_id;
    public $firstname,$lastname, $username, $a_propos, $contact, $email;
    public $experience = [],$updateExperience = false, $experience_until_now= false;
    public $education = [], $updateEducation = false, $education_until_now = false;
    public $qualification = [], $updateQualification = false;
    public $categorie, $categorie_id, $categorie_label;
    public $indice;
    public $show_competence = false, $competenceCategorie;
    
    
 
    public function mount()
    {
    $this->user_id = auth()->user()->id;
    }

    public function render()
    {
        if(isset($_GET['user_id']))
        {
            
            $user_id = $_GET['user_id'];
        }
        else
        {
            $user_id = auth()->user()->id;
        }

        $this->categorie = Categorie::all();
        $this->developpeur = User::join('developpeurs','users.id','=','developpeurs.user_id')->where('users.id',$user_id)->first();
        return view('livewire.developpeur.profile');
    }

    //ABOUT
    //modification de About
    public function editAbout($developpeur_id)
    {
        $developpeur = User::join('developpeurs','users.id','=','developpeurs.user_id')->where('users.id',$developpeur_id)->first(); 
        $this->firstname = $developpeur->firstname;
        $this->lastname = $developpeur->lastname;
        $this->username = $developpeur->name;
        $this->a_propos = $developpeur->developpeur_a_propos;
        $this->contact = $developpeur->developpeur_contact;
        $this->email = $developpeur->email;
    }

    //mis à jour de About
    public function enregistrerAbout()
    {
        $validatedData = $this->validate([
            'firstname' => 'required|min:3|max:50',//validaion text seulement
            'lastname' => 'max:50',
            'contact' => 'required|numeric|digits:10',
            'username' => 'required|string|max:50',
            'a_propos' => 'required|min:5',
            'email' => 'required'

        ]);

        Developpeur::where('user_id',$this->user_id)->update([
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'developpeur_contact' => $this->contact,
            'developpeur_a_propos' => $this->a_propos
        ]);
        User::where('id',$this->user_id)->update([
            'name' => $this->username,
            'email' =>$this->email,
        ]);

        $this->dispatchBrowserEvent('hide_modal_about');;

    }

    public function annulerAbout()
    {
        $this->firstname = "";
        $this->lastname = "";
        $this->username = "";
        $this->a_propos = "";
        $this->contact = "";
        $this->email = ""; 
    }
//FIN ABOUT

//COMPETENCE
    public function supprimerCompetence($competence_id)
    {
        DeveloppeurCompetence::where('user_id',$this->user_id)->where('competence_id',$competence_id)->delete();
    }

    public function showCompetence($categorie_id)
    {
        $this->show_competence = true;
        $categorie = Categorie::where('categorie_id',$categorie_id)->first();
        $this->categorie_label = $categorie->categorie_label;
        $this->categorie_id = $categorie_id;
        $this->competenceCategorie = Competence::join('competence_requises','competence_requises.competence_id','=','competences.competence_id')
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
    
//FIN COMPETENCE

//EXPERIENCE

    public function ajouterExperience()
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
            $fin_mois =  $this->experience['experience_fin_mois'] ;
            $this->experience['experience_fin_mois'] = date("m", strtotime($fin_mois));
            $debut_mois =  $this->experience['experience_debut_mois'] ;
            $this->experience['experience_debut_mois'] = date("m", strtotime($debut_mois));


            Validator::make($this->experience,[
                'experience_fin_mois' => 'gte:experience_debut_mois'
            ])->validate();

            $this->experience['experience_fin_mois'] = $fin_mois;
            $this->experience['experience_debut_mois'] = $debut_mois;
        }

        $dev = Developpeur::where('user_id',$this->user_id)->first();
       // $experience = json_decode($dev->developpeur_experience,true);

        $experience_existant = $dev->developpeur_experience;
        
        // Créez un autre objet JSON vide
        $experience = new stdClass();

        $experience = json_encode($this->experience);
        if($experience_existant == "[]")
        {
            $obj = (array)$experience;
        }
        else
        {
            $obj = array_merge((array)$experience,(array)json_decode($experience_existant));
        }

        Developpeur::where('user_id',$this->user_id)->update([
            'developpeur_experience' =>json_encode($obj)
        ]);
    }

    public function AnnulerExperience()
    {
        $this->experience = [];
    }

   
    public function editExperience($value,$i)
    {

        $this->indice = $i;
        $this->experience = $value;
        if($value['experience_fin_annee'] == 0)
            $this->experience_until_now = true;
        $this->updateExperience = true;
    }

    public function enregistrerExperience()
    {
        $dev = Developpeur::where('user_id',$this->user_id)->first();
        $experience_existant = $dev->developpeur_experience;
        $array_experience = json_decode($experience_existant);
        unset($array_experience[$this->indice]);

        $data_experience = json_encode($array_experience);
        Developpeur::where('user_id',$this->user_id)->update([
            'developpeur_experience'=>$data_experience
        ]);

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
            $fin_mois =  $this->experience['experience_fin_mois'] ;
            $this->experience['experience_fin_mois'] = date("m", strtotime($fin_mois));
            $debut_mois =  $this->experience['experience_debut_mois'] ;
            $this->experience['experience_debut_mois'] = date("m", strtotime($debut_mois));


            Validator::make($this->experience,[
                'experience_fin_mois' => 'gte:experience_debut_mois'
            ])->validate();

            $this->experience['experience_fin_mois'] = $fin_mois;
            $this->experience['experience_debut_mois'] = $debut_mois;
        }

        $dev = Developpeur::where('user_id',$this->user_id)->first();
       // $experience = json_decode($dev->developpeur_experience,true);

        $experience_existant = $dev->developpeur_experience;
        
        // Créez un autre objet JSON vide
        $experience = new stdClass();

        $experience = json_encode($this->experience);
        if($experience_existant == "[]")
        {
            $obj = (array)$experience;
        }
        else
        {
            $obj = array_merge((array)$experience,(array)json_decode($experience_existant));
        }

        Developpeur::where('user_id',$this->user_id)->update([
            'developpeur_experience' =>json_encode($obj)
        ]);
    }

    public function supprimerExperience($indice)
    {
        $dev = Developpeur::where('user_id',$this->user_id)->first();
        $experience_existant = $dev->developpeur_experience;
        $array_experience = json_decode($experience_existant);
        unset($array_experience[$indice]);

        $data_experience = json_encode($array_experience);
        Developpeur::where('user_id',$this->user_id)->update([
            'developpeur_experience'=>$data_experience
        ]);
    }
//FIN EXPERIENCE

//EDUCATION
    public function ajouterEducation()
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
        $dev = Developpeur::where('user_id',$this->user_id)->first();
        $education_existant = $dev->developpeur_education;
        // Créez un autre objet JSON vide
        $education = new stdClass();
        // Ajoutez une clé et un objet JSON à l'objet JSON
        $education= json_encode($this->education);
        if($education_existant == "[]" )
        {
            $obj = (array)$education;
        }
        else
        {
            $obj = array_merge((array)$education,(array)json_decode($education_existant));
        }

        Developpeur::where('user_id',$this->user_id)->update([
            'developpeur_education' =>json_encode($obj)
        ]);
    }

    public function AnnulerEducation()
    {
        $this->education = [];
    }

    public function editEducation($value,$i)
    {
        $this->education = $value;
        $this->indice = $i;
        if($value['education_fin_annee'] == 0)
            $this->education_until_now = true;
        $this->updateEducation = true;
    }

    public function enregistrerEducation()
    {
        $dev = Developpeur::where('user_id',$this->user_id)->first();
        $education_existant = $dev->developpeur_education;
        $array_education = json_decode($education_existant);
        unset($array_education[$this->indice]);

        $data_education = json_encode($array_education);
        Developpeur::where('user_id',$this->user_id)->update([
            'developpeur_education'=>$data_education
        ]);

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
        $dev = Developpeur::where('user_id',$this->user_id)->first();
        $education_existant = $dev->developpeur_education;
        // Créez un autre objet JSON vide
        $education = new stdClass();
        // Ajoutez une clé et un objet JSON à l'objet JSON
        $education= json_encode($this->education);
        if($education_existant == "[]" )
        {
            $obj = (array)$education;
        }
        else
        {
            $obj = array_merge((array)$education,(array)json_decode($education_existant));
        }

        Developpeur::where('user_id',$this->user_id)->update([
            'developpeur_education' =>json_encode($obj)
        ]);
    }

    public function supprimerEducation()
    {
        $dev = Developpeur::where('user_id',$this->user_id)->first();
        $education_existant = $dev->developpeur_education;
        $array_education = json_decode($education_existant);
        unset($array_education[$this->indice]);

        $data_education = json_encode($array_education);
        Developpeur::where('user_id',$this->user_id)->update([
            'developpeur_education'=>$data_education
        ]);
    }
//FIN EDUCATION


//QUALIFICATION
public function ajouterQualification()
{
    Validator::make($this->qualification, [
        'certificat' => 'required',
        'organisation' => 'required',
        'description' => 'required',
        'qualification_annee' => 'required',
    ])->validate();

     
    $dev = Developpeur::where('user_id',$this->user_id)->first();
    $qualification_existant = $dev->developpeur_qualification;
    // Créez un autre objet JSON vide
    $qualification = new stdClass();
    // Ajoutez une clé et un objet JSON à l'objet JSON
    $qualification= json_encode($this->qualification);
    if($qualification_existant == "[]" )
    {
        $obj = (array)$qualification;
    }
    else
    {
        $obj = array_merge((array)$qualification,(array)json_decode($qualification_existant));
    }

    Developpeur::where('user_id',$this->user_id)->update([
        'developpeur_qualification' =>json_encode($obj)
    ]);
    
}

public function AnnulerQualification()
{
    $this->qualification = [];
}

public function editQualification($value,$i)
{
    $this->qualification = $value;
    $this->indice = $i;
    $this->updateQualification = true;
}

public function enregistrerQualification()
{
    $dev = Developpeur::where('user_id',$this->user_id)->first();
    $qualification_existant = $dev->developpeur_qualification;
    $array_qualification = json_decode($qualification_existant);
    unset($array_qualification[$this->indice]);

    $data_qualification = json_encode($array_qualification);
    Developpeur::where('user_id',$this->user_id)->update([
        'developpeur_qualification'=>$data_qualification
    ]);

    Validator::make($this->qualification, [
        'certificat' => 'required',
        'organisation' => 'required',
        'description' => 'required',
        'qualification_annee' => 'required',
    ])->validate();

     
    $dev = Developpeur::where('user_id',$this->user_id)->first();
    $qualification_existant = $dev->developpeur_qualification;
    // Créez un autre objet JSON vide
    $qualification = new stdClass();
    // Ajoutez une clé et un objet JSON à l'objet JSON
    $qualification= json_encode($this->qualification);
    if($qualification_existant == "[]" )
    {
        $obj = (array)$qualification;
    }
    else
    {
        $obj = array_merge((array)$qualification,(array)json_decode($qualification_existant));
    }

    Developpeur::where('user_id',$this->user_id)->update([
        'developpeur_qualification' =>json_encode($obj)
    ]);
}

public function supprimerQualification()
{
    $dev = Developpeur::where('user_id',$this->user_id)->first();
    $qualification_existant = $dev->developpeur_qualification;
    $array_qualification = json_decode($qualification_existant);
    unset($array_qualification[$this->indice]);

    $data_qualification = json_encode($array_qualification);
    Developpeur::where('user_id',$this->user_id)->update([
        'developpeur_qualification'=>$data_qualification
    ]);
}

    

    

}
