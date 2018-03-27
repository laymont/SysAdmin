<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'roles';
  /**
   * Fields that can be mass assigned.
   *
   * @var array
   */
  protected $fillable = ['name','description'];
  public function users()
  {
    return $this->belongsToMany('App\User')->withTimestamps();
  }
}
