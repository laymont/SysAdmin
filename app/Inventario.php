<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventario extends Model
{
  use SoftDeletes;
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'inventarios';
  /**
   * Fields that can be mass assigned.
   *
   * @var array
   */
  protected $fillable = ['compra_id','producto_id','lote','vence','cantidad','costo','base1','base2','base3','ubicacion'];
  protected $guarded = ['id'];
  protected $dates = ['deleted_at'];

  /**
   * Inventario belongs to Compra.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function compra()
  {
    // belongsTo(RelatedModel, foreignKey = compra_id, keyOnRelatedModel = id)
    return $this->belongsTo(Compra::class);
  }
  /**
   * Inventario belongs to Detalles.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function detalles()
  {
    // belongsTo(RelatedModel, foreignKey = detalles_id, keyOnRelatedModel = id)
    return $this->belongsTo(Compra_detalle::class);
  }
  /**
   * Inventario belongs to Producto.
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
