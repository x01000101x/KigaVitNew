<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rsvp extends Model
{
    protected $table = "rsvps";
    protected $fillable = ['name', 'type', 'message', 'count', 'respon', 'attend', 'date'];
    use HasFactory;
}
