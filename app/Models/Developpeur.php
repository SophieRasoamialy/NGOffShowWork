<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Developpeur extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','developpeur_isvalide','developpeur_a_propos','developpeur_competence','developpeur_experience','developpeur_education','developpeur_qualification','developpeur_contact','firstname','lastname', 'developpeur_etablissement'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);

    }

}
