<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'summary', 'description', 'stock', 'brand_id', 'cat_id', 'child_cat_id', 'photo', 'price', 'offer_price', 'discount', 'size', 'condition', 'vendor_id', 'status'];

    public function brand(){
        return $this->belongsTo('App\Models\Brand');
    }

    public function rel_prods(){
        
        // $productByCat = $this->hasMany('App\Models\Product','cat_id','cat_id')->where([ 'status'=>'active'])->limit(4) ;
        // $productByBrand = $this->hasMany('App\Models\Product','brand_id','brand_id')->where([ 'status'=>'active'])->limit(4) ;
        // $productByChild_Cat = $this->hasMany('App\Models\Product','child_cat_id','child_cat_id')->where([ 'status'=>'active'])->limit(4) ;
        // $productByVendor = $this->hasMany('App\Models\Product','vendor_id','vendor_id')->where([ 'status'=>'active'])->limit(4) ;

        // return $productByVendor->merge($productByChild_Cat)->merge($productByBrand)->merge($productByCat);
        // return $productSuggest;

        return $this->hasMany('App\Models\Product','cat_id','cat_id')->where('status','active')->limit(2);

    }
}
