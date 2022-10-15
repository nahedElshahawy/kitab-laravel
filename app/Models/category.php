<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $table = 'categorys';
    protected $fillable = [
        'name',
      
    ];




    public function books()
    {
        return $this->morphMany(book::class, 'category_id');
    }

}
