<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends \Cviebrock\EloquentTaggable\Models\Tag
{
    use HasFactory;

    public function files()
    {
        return $this->morphedByMany(File::class, 'taggable', 'taggable_taggables', 'tag_id', 'taggable_id');
    }
}
