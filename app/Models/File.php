<?php

namespace App\Models;

use Cviebrock\EloquentTaggable\Taggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    use Taggable;

    protected $fillable = ['idTypeDocument','idTypeFormat','idLanguage','idDepartment','idProvince','idDistrict','idPopulationCenter','idUser','idNode','titulo','descripcion','enlace','mimeType','extensionArchivo','sizeFile','codigo','estado'];
}
