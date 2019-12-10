<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
  protected $fillable = [
      'term_name', 'terms_of_service', 'status',
  ];
}
