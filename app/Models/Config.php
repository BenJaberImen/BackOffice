<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Config extends Model
{
    protected $guarded=[];
    protected $fillable = [
        'tag',
        'valeur',
        'description',
        


    ];
}
