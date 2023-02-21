<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    
    protected $fillable =['title','body','slug','Prix','image'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
