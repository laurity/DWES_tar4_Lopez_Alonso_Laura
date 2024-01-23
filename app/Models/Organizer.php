<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organizer extends Model
{
    protected $fillable = ['nombre','apellido','email','telefono','direccion'];
    
    public function events()
    {
        return $this->belongToMany(Event::class);
    }
    use HasFactory;
}
