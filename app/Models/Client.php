<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    
    protected $fillable = [
        'Prenom', 'Nom', 'Email', 'Date_nais', 'Adresse', 
        'Telephone', 'Objectifs', 'Pathologies', 'Niveau', 
        'consentement_rgpd', 'user_id'
    ];

    // Lien avec l'utilisateur (le compte Jean Client)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
