<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Servidore extends Model
{
  use SoftDeletes;
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'servidores';
  /**
   * Fields that can be mass assigned.
   *
   * @var array
   */
  protected $fillable = ['tipo','identificacion','nombre','porcentaje','monto'];
  protected $guarded = ['id'];
  protected $dates = ['deleted_at'];
}
