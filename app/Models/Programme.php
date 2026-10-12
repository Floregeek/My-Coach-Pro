<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    protected $fillable = [
        'coach_id',
        'titre',
        'description',
        'prix_ht',
        'tva',
        'prix_ttc',
        'duree_semaines',
        'seances_par_semaine',
        'actif',
    ];

    public function coach()
    {
        return $this->belongsTo(User::class, 'coach_id');
    }

    public function inscriptions()
    {
        return $this->hasMany(ProgrammeInscription::class);
    }
}
