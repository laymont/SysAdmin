<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contabplan extends Model
{
  use SoftDeletes;
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'contabplans';
  /**
   * Fields that can be mass assigned.
   *
   * @var array
   */
  protected $fillable = ['cuenta','descripcion'];
  protected $guarded = ['id','cuenta'];
  /**
  * The attributes that should be mutated to dates.
  *
  * @var array
  */
  protected $dates = ['deleted_at'];
}
