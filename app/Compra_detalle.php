<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Compra_detalle extends Model
{
  use SoftDeletes;
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'compras_detalles';
  /**
   * Fields that can be mass assigned.
   *
   * @var array
   */
  protected $fillable = ['compra_id','producto_id','cantidad','costo','inventario'];

  protected $guarded = ['id'];
  protected $dates = ['deleted_at'];

  /**
   * Compra_detalle belongs to Compra.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function compra()
  {
    // belongsTo(RelatedModel, foreignKey = compra_id, keyOnRelatedModel = id)
    return $this->belongsTo(Compra::class);
  }

  /**
   * Compra_detalle belongs to Producto.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function producto()
  {
    // belongsTo(RelatedModel, foreignKey = producto_id, keyOnRelatedModel = id)
    return $this->belongsTo(Producto::class);
  }
    //
}
