<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abonnement extends Model
{
    use HasFactory;
    protected $primaryKey = 'abonnement_id';
    protected $fillable = [
        'abonnement_tarif', 'abonnement_type'
    ];

}
