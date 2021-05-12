<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    use HasFactory;

    protected $fillable = ['descripcion', 'siglas', 'observacion', 'codigo', 'estado'];

    public function files(){
        return $this->hasMany('App\Models\File');
    }
}
