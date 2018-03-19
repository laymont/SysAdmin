<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedor extends Model
{
  use SoftDeletes;

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'proveedores';

  /**
  * Fields that can be mass assigned.
  *
  * @var array
  */
  protected $fillable = ['rif','nombre','retiene','isrl','direccion','telefono','email','credito','dias'];

  protected $guarded = ['id'];

  /**
  * The attributes that should be mutated to dates.
  *
  * @var array
  */
  protected $dates = ['deleted_at'];

  /**
   * Proveedor has many Compras.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function compras()
  {
    // hasMany(RelatedModel, foreignKeyOnRelatedModel = proveedor_id, localKey = id)
    return $this->hasMany(Compra::class);
  }
}
