<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model implements ITranslatable
{
    use HasFactory;

    protected $fillable = ['name', 'slug','status'];

    protected $casts = [
        'name'=>'array',
        'slug'=>'array'
    ];

    public function translate(string $attr)
    {
        return json_decode($this->{$attr})->{app()->getLocale()};
    }
}
