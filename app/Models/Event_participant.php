<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event_participant extends Model
{
    protected $fillable = ['event_id','participant_id'];
    use HasFactory;
}
