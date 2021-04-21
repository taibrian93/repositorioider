<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopulationCenter extends Model
{
    use HasFactory;

    protected $fillable = ['idDistrict', 'descripcion', 'codigo', 'codigoCentroPoblado', 'estado'];

    public function district(){
        return $this->belongsTo('App\Models\District','idDistrict','id');
    }
}
