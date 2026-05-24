<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantMenu extends Model
{
    protected $fillable = ['name', 'price', 'image', 'category_id', 'item_types'];

    // Accessor to always return clean numeric price
    public function getPriceAttribute($value)
    {
        // Remove "Nu." prefix and any spaces, return as float
        $cleanPrice = str_replace(['Nu.', 'nu.', 'NU.'], '', $value);
        $cleanPrice = trim($cleanPrice);
        return is_numeric($cleanPrice) ? floatval($cleanPrice) : 0;
    }

    // Mutator to store price with "Nu." prefix if needed
    public function setPriceAttribute($value)
    {
        // If it's already a number, store as is
        // If it has "Nu.", clean it first
        if (is_string($value)) {
            $cleanPrice = str_replace(['Nu.', 'nu.', 'NU.'], '', $value);
            $this->attributes['price'] = trim($cleanPrice);
        } else {
            $this->attributes['price'] = $value;
        }
    }

    public function category()
    {
        return $this->belongsTo(MenuCategory::class, 'category_id');
    }
}