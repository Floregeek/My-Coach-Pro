<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanNutritionAchat extends Model
{
    protected $table = 'plan_nutrition_achats';

    protected $fillable = [
        'plan_nutrition_id',
        'client_id',
        'coach_id',
        'prix_ttc',
        'payment_provider',
        'stripe_checkout_session_id',
        'paid_at',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
    ];

    public function plan()
    {
        return $this->belongsTo(PlanNutrition::class, 'plan_nutrition_id');
    }
}
