<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClienteOld extends Model
{
  protected $connection = 'verold';
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'clientes';
  /**
   * Fields that can be mass assigned.
   *
   * @var array
   */
  protected $fillable = ['codigo','rif','nombre','direccion','telefono','correo','credito','dias'];
  protected $guarded = ['codigo'];
}
