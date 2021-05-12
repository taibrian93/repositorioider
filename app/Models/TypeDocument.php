<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeDocument extends Model
{
    use HasFactory;

    protected $fillable = ['descripcion', 'observacion', 'codigo', 'estado'];

    public function files(){
        return $this->hasMany('App\Models\File');
    }
}
