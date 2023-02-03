<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetenceRequise extends Model
{
    use HasFactory;
    protected $fillable = [
        'competence_id', 'categorie_id'
    ];
}
