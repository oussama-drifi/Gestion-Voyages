<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = "tickets";
    protected $primaryKey = 'ticket_id';

    protected $fillable = [
        'numero_place',
        'prix',
        'statut',
        'user_id',
        'voyage_id',
    ];

    protected function casts(): array
    {
        return [
            'prix' => 'decimal:2',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function voyage()
    {
        return $this->belongsTo(Voyage::class, 'voyage_id', 'voyage_id');
    }
}
