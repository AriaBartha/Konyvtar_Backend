<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $hidden = ["created_at", "updated_at"];
    protected $fillable = ["title", "author", "publish_year", "page_count"];
}
