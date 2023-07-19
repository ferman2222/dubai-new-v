<?php

namespace App\Models;

use App\Helpers\ITranslatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Region extends Model implements ITranslatable
{
    use HasFactory;

    protected  $fillable=
    [
      'name',
      'slug',
      'status',
    ];

    protected $casts = [
        'name'=>'array',
        'slug'=>'array',
    ];

    public function translate(string $attr)
    {
        return json_decode($this->{$attr})->{app()->getLocale()};
    }

    
}
