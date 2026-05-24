<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpaCategory extends Model
{
    protected $fillable = ['name'];
    public function services() { return $this->hasMany(SpaService::class, 'category_id'); }
}
