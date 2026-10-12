<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoachSalleContrat extends Model
{
    protected $table = 'coach_salle_contrats';

    protected $fillable = [
        'coach_id',
        'salle_id',
        'type',
        'commission_rate',
        'statut',
        'date_debut',
        'date_fin',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
    ];

    public function coach()
    {
        return $this->belongsTo(User::class, 'coach_id');
    }

    public function salle()
    {
        return $this->belongsTo(Salle::class, 'salle_id');
    }
}
