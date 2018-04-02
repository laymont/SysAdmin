<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Factura extends Model
{
  use SoftDeletes;
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'facturas';
  /**
   * Fields that can be mass assigned.
   *
   * @var array
   */
  protected $fillable = ['fecha','cliente_id','servidore_id','tpago','anulada','pagada'];
  protected $guarde = ['id'];
  protected $dates = ['deleted_at'];

  /**
   * Factura belongs to Cliente.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function cliente()
  {
    // belongsTo(RelatedModel, foreignKey = cliente_id, keyOnRelatedModel = id)
    return $this->belongsTo(Cliente::class);
  }

  /**
   * Factura belongs to Servidore.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function servidore()
  {
    // belongsTo(RelatedModel, foreignKey = servidore_id, keyOnRelatedModel = id)
    return $this->belongsTo(Servidore::class,'servidore_id');
  }

  /**
   * Factura has many Factura_det.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function factura_detalles()
  {
    // hasMany(RelatedModel, foreignKeyOnRelatedModel = factura_id, localKey = id)
    return $this->hasMany(Factura_detalle::class);
  }
}
