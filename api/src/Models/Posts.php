<?php
namespace CMS\Models;

use illuminate\Database\Eloquent\Model;

class Posts extends Model
{

    protected $fillable= [
        'id',
        'titulo',
        'categoria',
        'post',
        'autor',
        'created_at',
        'updated_at'



    ];

}