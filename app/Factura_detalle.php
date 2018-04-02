<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Factura_detalle extends Model
{
  use SoftDeletes;
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'factura_detalles';
  /**
   * Fields that can be mass assigned.
   *
   * @var array
   */
  protected $fillable = ['factura_id','inventario_id','cantidad','precio'];
  protected $guarded = ['id'];
  protected $dates = ['deleted_at'];

  /**
   * Factura_detalle belongs to Factura.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function factura()
  {
    // belongsTo(RelatedModel, foreignKey = factura_id, keyOnRelatedModel = id)
    return $this->belongsTo(Factura::class);
  }

  /**
   * Factura_detalle belongs to Inventario.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function inventario()
  {
    // belongsTo(RelatedModel, foreignKey = inventario_id, keyOnRelatedModel = id)
    return $this->belongsTo(Inventario::class);
  }

}
