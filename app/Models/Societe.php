<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Societe extends Model
{
    use HasFactory;

    protected $table = "societes";
    protected $primaryKey = 'societe_id';
    protected $fillable = ['nom', 'adresse_siege'];

    public function agences()
    {
        return $this->hasMany(Agence::class, 'societe_id', 'societe_id');
    }

    public function buses()
    {
        return $this->hasMany(Bus::class, 'societe_id', 'societe_id');
    }
}
