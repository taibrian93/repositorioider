<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $fillable = ['idDepartment', 'descripcion', 'codigo', 'codigoProvincial', 'estado'];

    public function department(){
        return $this->belongsTo('App\Models\Department','idDepartment','id');
    }

    public function districts(){
        return $this->hasMany('App\Models\District');
    }
}
