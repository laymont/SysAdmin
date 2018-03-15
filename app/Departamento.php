<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Departamento extends Model
{
  use SoftDeletes;
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'departamentos';
  protected $primary_key = "id";

  /**
   * Fields that can be mass assigned.
   *
   * @var array
   */
  protected $fillable = ['nombre','descripcion'];

  protected $guarded = ['id'];


  /**
  * The attributes that should be mutated to dates.
  *
  * @var array
  */
  protected $dates = ['deleted_at'];

  /**
   * Departamento has many Producto.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function producto()
  {
    // hasMany(RelatedModel, foreignKeyOnRelatedModel = departamento_id, localKey = id)
    return $this->hasMany(Producto::class);
  }
}
