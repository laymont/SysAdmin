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
  protected $fillable = ['fecha','cliente_id','servidor_id','tpago','anulada','pagada'];
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
}
