<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sheet extends Model
{
    //fillable fields (deleted, created, updated are handled by laravel)
    protected $fillable = ['sheet_name', 'sheet_alternative_name', 'composer_id', 'arranger_id',
        'voicing_id', 'accompaniment_id', 'publisher_number', 'publisher_id', 'copyright_year',
        'quantity', 'legal_table_id'];

    protected $dates = ['deleted_at'];

    /**
     * Construct Sheet
     * Functions that define relationships to build the sheet based on lookup tables and sheet table
     */

    public function composer()
    {
        return $this->hasOne('App\Composer', 'id', 'composer_id');
    }

    public function arranger()
    {
        return $this->hasOne('App\Arranger', 'id', 'arranger_id');
    }

    public function voicing()
    {
        return $this->hasOne('App\Voicing', 'id', 'voicing_id');
    }

    public function accompaniment()
    {
        return $this->hasOne('App\Accompaniment', 'id', 'accompaniment_id');
    }

    public function publisher()
    {
        return $this->hasOne('App\Publisher', 'id', 'publisher_id');
    }

    public function Legal_table()
    {
        return $this->hasOne('App\Legal_table', 'id', 'legal_table_id');
    }

}
