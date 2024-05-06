<?php

namespace App\Models;

use App\Http\Traits\ApiResponses;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory,ApiResponses;


    protected $fillable = [
        'name',
        'content',
        'created_at'
    ];


}
