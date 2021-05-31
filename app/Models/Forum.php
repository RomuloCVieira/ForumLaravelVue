<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $fillable = ['titulo', 'mensagem', 'idusuario'];
    protected $dateFormat = 'y-m-d';
    use HasFactory;
}
