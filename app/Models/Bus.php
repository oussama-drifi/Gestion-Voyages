<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    protected $table = "buses";
    protected $primaryKey = 'bus_id';
    protected $fillable = [
        'modele',
        'comfort',
        'wifi',
        'totale_places',
        'societe_id',
    ];

    protected function casts(): array
    {
        return [
            'wifi' => 'boolean',
        ];
    }

    public function societe()
    {
        return $this->belongsTo(Societe::class, 'societe_id', 'societe_id');
    }

    public function voyages()
    {
        return $this->hasMany(Voyage::class, 'bus_id', 'bus_id');
    }
}
