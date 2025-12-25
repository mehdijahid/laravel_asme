<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;    
use App\Models\Image;
class Utilisateur extends Authenticatable
{
    use Notifiable;
    protected $table = 'utilisateurs';
    protected $fillable = [
        'nom',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function images(){
        return $this->hasMany(Image::class);
    }
}
