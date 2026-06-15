<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['equipment_id', 'path'];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
}