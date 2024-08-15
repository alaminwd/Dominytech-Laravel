<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'class',
        'category_id',
        'title',
        'slug',
        'client',
        'location',
        'short_desp',
        'image',
    ];


    function rel_to_category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
    
}
