<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Facture extends Model
{
    protected $fillable = [
        'numero',
        'user_id',
        'coach_id',
        'type',
        'reference_id',
        'total_ht',
        'tva',
        'total_ttc',
        'statut',
        'issued_at',
        'due_at',
    ];

    protected $casts = [
        'issued_at' => 'datetime',
        'due_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coach()
    {
        return $this->belongsTo(User::class, 'coach_id');
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }

    public static function generateNumero(): string
    {
        $prefix = 'FACT-' . now()->format('Ymd');

        do {
            $numero = $prefix . '-' . Str::upper(Str::random(5));
        } while (self::where('numero', $numero)->exists());

        return $numero;
    }
}
