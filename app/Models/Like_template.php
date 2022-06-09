<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like_template extends Model
{
    protected $table = "like_templates";
    protected $fillable = ['user_id', 'template_id'];
    use HasFactory;
}
