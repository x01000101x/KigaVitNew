<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub_template_client extends Model
{
    protected $table = 'sub_template_clients';
    protected $fillable = ['resource_id', 'user_id', 'section_code'];
    use HasFactory;
}
