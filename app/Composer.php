<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Composer extends Model
{
        // Allow writing to field
    protected $fillable = array('composer');
    /**
     * Relate to Sheet
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Sheet()
    {
        return $this->belongsTo('App\Sheet', 'id', 'composer_id');
    }

    /**
     * Pull sheets with this model + id.
     */
    public function Sheets()
    {
        return $this->hasMany('App\Sheet');
    }
}
