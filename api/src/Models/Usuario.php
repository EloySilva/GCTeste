<?php
namespace CMS\Models;

use illuminate\Database\Eloquent\Model;

class Usuario extends Model
{

    protected $fillable= [
        'nome',
        'email',
        'user',
        'pass',
    
    ];

}