<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeFormat extends Model
{
    use HasFactory;

    protected $fillable = ['descripcion', 'codigo', 'estado'];

    public function file(){
        return $this->belongsTo('App\Models\File','idFile','id');
    }
}
