<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectData extends Model
{
    protected $fillable = ['name', 'created_at', 'updated_at', 'data'];
    
}
