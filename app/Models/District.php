<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $fillable = ['idProvince', 'descripcion', 'codigo', 'codigoDistrital', 'estado'];

    public function province(){
        return $this->belongsTo('App\Models\Province','idProvince','id');
    }

    
    public function populationCenters(){
        return $this->hasMany('App\Models\PopulationCenter');
    }

    public function files(){
        return $this->hasMany('App\Models\File');
    }
}
