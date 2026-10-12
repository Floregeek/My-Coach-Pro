<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $fillable = [
        'facture_id',
        'provider',
        'amount',
        'currency',
        'statut',
        'paid_at',
        'reference',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
    ];

    public function facture()
    {
        return $this->belongsTo(Facture::class);
    }
}
