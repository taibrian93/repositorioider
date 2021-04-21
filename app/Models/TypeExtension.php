<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeExtension extends Model
{
    use HasFactory;

    protected $fillable = ['idTypeFormat', 'descripcion', 'estado'];

    public function typeFormat(){
        return $this->belongsTo('App\Models\TypeFormat','idTypeFormat','id');
    }
}
