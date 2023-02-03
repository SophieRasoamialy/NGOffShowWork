<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CDO extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'cdo_premium','cdo_isvalid'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);

    }

}
