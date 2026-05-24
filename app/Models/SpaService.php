<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpaService extends Model
{
    protected $fillable = ['name', 'description', 'price', 'duration', 'image', 'category_id'];
    public function category() { return $this->belongsTo(SpaCategory::class, 'category_id'); }
}
