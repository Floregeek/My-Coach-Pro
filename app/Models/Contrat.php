<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    protected $casts = [
        'date_expiration' => 'date',
    ];

    protected $fillable = [
        'client_id',
        'coach_id',
        'offre_id',
        'type',
        'total_seances',
        'seances_restantes',
        'date_expiration',
        'prix_ht',
        'tva',
        'prix_ttc',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function coach()
    {
        return $this->belongsTo(User::class, 'coach_id');
    }

    public function offre()
    {
        return $this->belongsTo(Offre::class);
    }

    public function getSeancesConsommeesAttribute()
    {
        return max(0, ($this->total_seances ?? 0) - ($this->seances_restantes ?? 0));
    }
}
