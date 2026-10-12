<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanNutrition extends Model
{
    protected $table = 'plans_nutrition';

    protected $fillable = [
        'coach_id',
        'titre',
        'description',
        'calories',
        'proteines',
        'glucides',
        'lipides',
        'prix_ht',
        'tva',
        'prix_ttc',
        'actif',
    ];

    public function coach()
    {
        return $this->belongsTo(User::class, 'coach_id');
    }

    public function achats()
    {
        return $this->hasMany(PlanNutritionAchat::class, 'plan_nutrition_id');
    }
}
