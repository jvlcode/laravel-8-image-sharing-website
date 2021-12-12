<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $fillable = ['title','image'];

    public static $upload_rules = array('title'=> 'required|min:3',
    'image'=> 'required|image'
   );
}
