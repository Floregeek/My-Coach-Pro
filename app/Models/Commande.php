<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    
    protected $fillable = [
        'user_id',
        'produit_id',
        'quantite',
        'total',
        'adresse',
        'ville',
        'code_postal',
        'statut',
        'payment_provider',
        'stripe_checkout_session_id',
    ];

    // N'oublie pas d'ajouter les relations pour que ton historique fonctionne bien
    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
