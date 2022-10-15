<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class book extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        "description",
        "price",
        "category_id",
        "value",
    ];

    public function rateBook()
    {
        return $this->hasMany(RateBook::class, 'book_id');
    }
}
