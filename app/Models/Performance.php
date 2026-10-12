<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    protected $fillable = ['user_id', 'seance_id', 'distance_km', 'calories', 'duree_minutes'];
   public function seance()
{
    return $this->belongsTo(Seance::class);
}
}
