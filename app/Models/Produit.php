<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','name','category_id', 'description', 'prix', 'stock', 'region_id','image'];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function category()
    {
        return $this->belongsTo(Categorie::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

