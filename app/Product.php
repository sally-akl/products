<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $table = "products";
  protected $fillable = [
      'name',
      'description',
      'category_id',
      'picture'
  ];

  public function category()
  {
      return $this->belongsTo('App\Category','category_id');
  }

  public function productTags()
  {
      return $this->hasMany('App\ProductTags','product_id');
  }
}
