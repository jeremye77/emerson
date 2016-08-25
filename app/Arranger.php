<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arranger extends Model
{
    // Allow writing to field
    protected $fillable = array('arranger');
    /**
     * Relate to Sheet
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Arranger()
    {
        return $this->belongsTo('App\Sheet', 'id', 'composer_id');
    }

    /**
     * Pull sheets with this model + id.
     */
    public function Arrangers()
    {
        return $this->hasMany('App\Sheet');
    }
}
