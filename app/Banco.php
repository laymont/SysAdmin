<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'bancos';
  /**
   * Fields that can be mass assigned.
   *
   * @var array
   */
  protected $fillable = ['nombre','codigo','cuenta','tipo','saldo'];

  protected $guarded =['id'];
  protected $dates = ['deleted_at'];

  /**
   * Banco has many Ctapagar.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function ctapagar()
  {
    // hasMany(RelatedModel, foreignKeyOnRelatedModel = banco_id, localKey = id)
    return $this->hasMany(Ctapagar::class);
  }
}
