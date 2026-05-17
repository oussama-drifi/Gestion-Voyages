<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voyage extends Model
{
    use HasFactory;

    protected $table = "voyages";
    protected $primaryKey = 'voyage_id';

    protected $fillable = [
        'ville_depart',
        'ville_arrive',
        'heure_depart',
        'heure_arrive',
        'date',
        'agence_depart_id',
        'agence_arrive_id',
        'voyage_principale_id',
        'bus_id'
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }

    public function agenceDepart()
    {
        return $this->belongsTo(Agence::class, 'agence_depart_id', 'agence_id');
    }

    public function agenceArrive()
    {
        return $this->belongsTo(Agence::class, 'agence_arrive_id', 'agence_id');
    }

    public function voyagePrincipale()
    {
        return $this->belongsTo(Voyage::class, 'voyage_principale_id', 'voyage_id');
    }

    public function sousVoyages()
    {
        return $this->hasMany(Voyage::class, 'voyage_principale_id', 'voyage_id');
    }

    public function bus()
    {
        return $this->belongsTo(Bus::class, 'bus_id', 'bus_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'voyage_id', 'voyage_id');
    }
}
