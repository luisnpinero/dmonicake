<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Order;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Image;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected static function booted()
    {
        //
    }

    protected $with = [
        'images',
    ];

    protected $fillable = [
        'name',
        'description',
        'stock',
        'modified_by',
        'cost_id',
        'category_id',
        'status',
    ];

    public function cost(){
        return $this->belongsTo(Cost::class);
    }

    public function category(){
        return $this->belongsTo(category::class);
    }

    public function orders(){
        return $this->morphedByMany(Order::class, 'productable')->withPivot('quantity');
    }

    public function carts(){
        return $this->morphedByMany(Cart::class, 'productable')->withPivot('quantity');
    }

    public function categories(){
        return $this->belongsToMany(Category::class); //,'category_product','product_id','category_id');
    }

    public function images(){
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getTotalAttribute(){
        $cost = Cost::find($this->cost_id);
        return $this->pivot->quantity * $cost->cost;
    }
    
    public function getProductImageAttribute()
    {
        return $this->image
            ? "images/{$this->image->path}"
            : 'https://www.gravatar.com/avatar/404?d=mp';
    }
}
