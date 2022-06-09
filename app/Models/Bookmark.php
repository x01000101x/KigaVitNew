<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $table = "bookmarks";
    protected $fillable = ['user_id', 'template_id'];
    use HasFactory;
}
