<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    // function rel_to_category(){
    //     return $this->belongsTo(Category::class, 'category_id');
    // }

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'short_desp',
        'long_desp',
        'image',
    ];
    public function rel_to_category() {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
