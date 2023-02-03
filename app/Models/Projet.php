<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;
    protected $primaryKey = 'projet_id';
    protected $fillable = [
        'projet_titre',
        'projet_description',
        'categorie_id',
        'projet_duree',
        'projet_budget',
        'projet_premium'
    ];
}
