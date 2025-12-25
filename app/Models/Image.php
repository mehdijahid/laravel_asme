<?php

namespace App\Models;
use App\Models\Utilisateur;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['url','name','description','utilisateur_id'];
    public function utilisateur(){
        return $this->belongsTo(Utilisateur::class);
    }
}
