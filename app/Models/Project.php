<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    use SoftDelete;

    protected $fillable = array('name', 'description', 'start_date', 'update', 'preview', 'authors', 'license', 'program_lang', 'frameworks', 'github_url');
}
