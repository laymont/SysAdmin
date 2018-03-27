<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role_user extends Model
{
  use SoftDeletes;
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'role_user';
  /**
   * Fields that can be mass assigned.
   *
   * @var array
   */
  protected $fillable = ['role_id','user_id'];
  protected $guarded = ['id'];
  protected $dates = ['deleted_at'];

  /**
   * Role_user belongs to User.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function User()
  {
    // belongsTo(RelatedModel, foreignKey = user_id, keyOnRelatedModel = id)
    return $this->belongsTo(User::class);
  }
}
