<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['nombre_evento','fecha','ubicacion'];
    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }

    public function participants()
    {
        return $this->belongsToMany(Participant::class);
    }
    use HasFactory;
}
