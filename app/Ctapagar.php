<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ctapagar extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ctapagars';
    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['fecha','referencia','tipo','observacion','monto','abono','fecha_abono','banco_id','movimiento','pagada'];
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    /**
     * Ctapagar belongs to Banco.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function banco()
    {
      // belongsTo(RelatedModel, foreignKey = banco_id, keyOnRelatedModel = id)
      return $this->belongsTo(Banco::class);
    }
}
