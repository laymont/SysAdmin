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

  /**
   * Fields that can be mass assigned.
   *
   * @var array
   */
  protected $fillable = ['departamento_id','nombre','marca_id','presentacion','descripcion','exento','min','max'];

  protected $guarded = ['id'];


  /**
  * The attributes that should be mutated to dates.
  *
  * @var array
  */
  protected $dates = ['deleted_at'];

  /**
   * Producto belongs to Departamento.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function departamento()
  {
    // belongsTo(RelatedModel, foreignKey = departamento_id, keyOnRelatedModel = id)
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

}
