<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
    protected $fillable = [
        'nom',
        'adresse',
    ];

    public function responsables()
    {
        return $this->hasMany(User::class);
    }

    public function coachs()
    {
        return $this->belongsToMany(User::class, 'coach_salle', 'salle_id', 'coach_id');
    }
}
