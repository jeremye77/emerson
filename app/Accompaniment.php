<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accompaniment extends Model
{
    // Allow writing to field
    protected $fillable = array('accompaniment');
    /**
     * relate to sheet
     */
    public function Accompaniment()
    {
        return $this->belongsTo('App\Sheet', 'id', 'accompaniment_id');
    }


    /**
     * Pull sheets with this model + id.
     */
    public function Accompaniments()
    {
        return $this->hasMany('App\Sheet');
    }
}
