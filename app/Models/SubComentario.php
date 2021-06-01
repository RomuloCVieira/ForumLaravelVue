<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubComentario extends Model
{
    use HasFactory;
    
    protected $fillable = ['idcomentario', 'comentario'];
}
