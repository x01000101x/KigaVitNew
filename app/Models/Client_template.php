<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client_template extends Model
{
    protected $table = 'client_templates';
    protected $fillable = ['user_id', 'template_id', 'music'];
    use HasFactory;
}
