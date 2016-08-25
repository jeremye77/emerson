<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Legal_table extends Model
{
    // Allow writing to field
    protected $fillable = array('legal');
    /**
     * Relate to Sheet
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Legal_table()
    {
        return $this->belongsTo('App\Sheet', 'id', 'legal_table_id');
    }

    /**
     * Pull sheets with this model + id.
     */
    public function Legal_tables()
    {
        return $this->hasMany('App\Sheet');
    }
}
