<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $fillable = [
        'libille',
        'description',
        'prix_intial',
        'categorie_id',
        'cover',




    ];
    public function categorie(){
        return $this->belongsTo(Categorie::class);
    }

    public function image(){
        return $this->hasMany(Image::class);
    }

}
