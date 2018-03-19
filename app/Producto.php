<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
  use SoftDeletes;
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'productos';
  protected $primary_key = "id";

  /**
   * Fields that can be mass assigned.
   *
   * @var array
   */
  protected $fillable = ['departamento_id','nombre','marca_id','presentacion','descripcion','exento','servicio','min','max'];

  protected $guarded = ['id'];


  /**
  * The attributes that should be mutated to dates.
  *
  * @var array
  */
  protected $dates = ['deleted_at'];

  /**
   * Producto belongs to Depar.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function departamento()
  {
    // belongsTo(RelatedModel, foreignKey = depar_id, keyOnRelatedModel = id)
    return $this->belongsTo(Departamento::class);
  }

  /**
   * Producto belongs to Marca.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function marca()
  {
    // belongsTo(RelatedModel, foreignKey = marca_id, keyOnRelatedModel = id)
    return $this->belongsTo(Marca::class);
  }

  /**
   * Producto has many Compra_detalle.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function compra_detalle()
  {
    // hasMany(RelatedModel, foreignKeyOnRelatedModel = producto_id, localKey = id)
    return $this->hasMany(Compra_detalle::class);
  }
  /**
   * Producto has many Inventario.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function inventario()
  {
    // hasMany(RelatedModel, foreignKeyOnRelatedModel = producto_id, localKey = id)
    return $this->hasMany(Inventario::class);
  }
}
