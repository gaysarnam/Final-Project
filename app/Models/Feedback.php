<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    // Tell Laravel to use the "feedbacks" table (with the 's')
    protected $table = 'feedbacks';

    protected $fillable = [
        'user_id', 
        'full_name', 
        'email', 
        'service', 
        'rating', 
        'feedback'
    ];
}