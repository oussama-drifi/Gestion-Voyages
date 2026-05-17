<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agence extends Model
{
    use HasFactory;

    protected $table = "agences";
    protected $primaryKey = 'agence_id';

    protected $fillable = [
        'nom',
        'adresse',
        'ville',
        'societe_id',
    ];

    public function societe()
    {
        return $this->belongsTo(Societe::class, 'societe_id', 'societe_id');
    }

    public function voyagesDepart()
    {
        return $this->hasMany(Voyage::class, 'agence_depart_id', 'agence_id');
    }

    public function voyagesArrive()
    {
        return $this->hasMany(Voyage::class, 'agence_arrive_id', 'agence_id');
    }
}
