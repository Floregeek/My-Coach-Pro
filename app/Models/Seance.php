<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation; 
use App\Models\User;

class Seance extends Model
{
    
    protected $fillable = [
    'coach_id', 
    'salle_id',
    'titre', 
    'type',
    'description', 
    'debut_a', 
    'fin_a', 
    'max_participants',
    'statut'
];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function salle()
    {
        return $this->belongsTo(Salle::class);
    }

    public function coach()
    {
        return $this->belongsTo(User::class, 'coach_id');
    }

    public function clients()
    {
        return $this->belongsToMany(User::class, 'reservations')->withTimestamps();
    }

    public function exercises() {
    return $this->belongsToMany(Exercise::class, 'exercise_seance')
                ->withPivot('reps_series', 'ordre')
                ->withTimestamps();
}
}
