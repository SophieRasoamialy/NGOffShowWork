<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;
    protected $primaryKey = "commission_id";
    protected $fillable = [
        'commission_type','commission_tarif'
    ];

}
