<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    protected $fillable = [
        'coach_id',
        'titre',
        'type',
        'description',
        'prix_ht',
        'tva',
        'prix_ttc',
        'total_seances',
        'duree_mois',
        'active',
    ];

    public function coach()
    {
        return $this->belongsTo(User::class, 'coach_id');
    }

    public function contrats()
    {
        return $this->hasMany(Contrat::class);
    }
}
