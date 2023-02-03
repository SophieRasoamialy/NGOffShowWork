<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    protected $primaryKey = 'categorie_id';
    protected $fillable = [
        'categorie_label', 'categorie_illustration', 'budget_min','duree_min'
    ];

    public function baremes()
    {
        return $this->belongsTo(Bareme::class);
    }



}
