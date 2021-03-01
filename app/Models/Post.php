<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts'; //Esta linha não é necessária. Foi usada no curso como exemplo

    //Maneira segura para enviar os dados para o banco. 
    protected $fillable = ['title', 'content', 'image'];
}
