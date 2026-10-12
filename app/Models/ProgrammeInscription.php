<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgrammeInscription extends Model
{
    protected $fillable = [
        'programme_id',
        'client_id',
        'coach_id',
        'statut',
        'commence_le',
        'termine_le',
        'paid_at',
    ];

    protected $casts = [
        'commence_le' => 'date',
        'termine_le' => 'date',
        'paid_at' => 'datetime',
    ];

    public function programme()
    {
        return $this->belongsTo(Programme::class);
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function coach()
    {
        return $this->belongsTo(User::class, 'coach_id');
    }
}
