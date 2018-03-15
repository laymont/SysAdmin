<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Marca extends Model
{
  use SoftDeletes;
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'marcas';
  protected $primary_key = "id";

  /**
   * Fields that can be mass assigned.
   *
   * @var array
   */
  protected $fillable = ['nombre'];

  protected $guarded = ['id'];


  /**
  * The attributes that should be mutated to dates.
  *
  * @var array
  */
  protected $dates = ['deleted_at'];

  /**
   * Marca has many Producto.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function producto()
  {
    // hasMany(RelatedModel, foreignKeyOnRelatedModel = marca_id, localKey = id)
    return $this->hasMany(Producto::class);
  }
}
