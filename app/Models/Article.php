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
        'image_id',
        

       
    ];
    public function categorie(){
        return $this->belongsTo(Categorie::class);
    }

    public function image(){
        return $this->belongsTo(Image::class);
    }

}
