<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    // This allows the 'name' to be saved to the database
    protected $fillable = ['name','item_types'];

    // Relationship: One category has many menu items
    public function restaurantMenus()
    {
        return $this->hasMany(RestaurantMenu::class, 'category_id');
    }
}