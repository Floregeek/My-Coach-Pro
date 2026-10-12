<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = [
        'Nom', 'Description', 'Consignes', 'Niveau', 
        'Categorie', 'Equipement', 'Media_url', 'user_id'
    ];

    public function seances() {
    return $this->belongsToMany(Seance::class, 'exercise_seance');
}
}
