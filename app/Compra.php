<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Compra extends Model
{
  use SoftDeletes;
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'compras';

  /**
   * Fields that can be mass assigned.
   *
   * @var array
   */
  protected $fillable = ['fecha','proveedor_id','documento','subtotal','exento','iva','total','pago','nula'];

  protected $guarded = ['id'];
  protected $dates = ['deleted_at'];

  /**
   * Compra has many Compra_detalle.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function compra_detalle()
  {
    // hasMany(RelatedModel, foreignKeyOnRelatedModel = compra_id, localKey = id)
    return $this->hasMany(Compra_detalle::class);
  }

  /**
   * Compra belongs to Proveedor.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function proveedor()
  {
    // belongsTo(RelatedModel, foreignKey = proveedor_id, keyOnRelatedModel = id)
    return $this->belongsTo(Proveedor::class);
  }
  /**
   * Compra has many Inventario.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function inventario()
  {
    // hasMany(RelatedModel, foreignKeyOnRelatedModel = compra_id, localKey = id)
    return $this->hasMany(Inventario::class);
  }
}
