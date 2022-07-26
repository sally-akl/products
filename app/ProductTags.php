<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTags extends Model
{
  protected $table = "products_tags";
  protected $fillable = [
      'name',
      'product_id'
  ];
}
