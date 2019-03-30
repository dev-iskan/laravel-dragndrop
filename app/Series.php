<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    protected $fillable = [
        'title'
    ];
    public function parts(){
        return $this->hasMany(Part::class)->orderBy('sort_order', 'asc');
    }
}
