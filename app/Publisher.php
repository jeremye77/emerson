<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    // Allow writing to field
    protected $fillable = array('publisher');
    /**
     * Relate to Sheet
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Publisher()
    {
        return $this->belongsTo('App\Sheet', 'id', 'publisher_id');
    }

    /**
     * Pull sheets with this model + id.
     */
    public function Publishers()
    {
        return $this->hasMany('App\Sheet');
    }
}
