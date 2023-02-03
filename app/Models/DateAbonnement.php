<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DateAbonnement extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','abonnement_id','mode_paiement','paiement_reference'
    ];
}
