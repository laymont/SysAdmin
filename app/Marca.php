<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Marca extends Model
{
  use SoftDeletes;
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'marcas';

  /**
   * Fields that can be mass assigned.
   *
   * @var array
   */
  protected $fillable = ['nombre'];

  protected $guarded = ['id'];


  /**
  * The attributes that should be mutated to dates.
  *
  * @var array
  */
  protected $dates = ['deleted_at'];

  /**
   * Marca has many Marca.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function marca()
  {
    // hasMany(RelatedModel, foreignKeyOnRelatedModel = marca_id, localKey = id)
    return $this->hasMany(App\Marca::class);
  }
}
