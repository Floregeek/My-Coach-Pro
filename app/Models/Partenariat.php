<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partenariat extends Model
{
    protected $fillable = [
        'coach_id',
        'partner_coach_id',
        'type',
        'commission_rate',
        'statut',
    ];

    public function coach()
    {
        return $this->belongsTo(User::class, 'coach_id');
    }

    public function partenaire()
    {
        return $this->belongsTo(User::class, 'partner_coach_id');
    }
}
