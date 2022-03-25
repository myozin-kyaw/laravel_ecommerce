<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';
    protected $fillable = [
        'user_id',
        'prod_id',
        'user_review'
    ];

    public function customer()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    // public function rating()
    // {
    //     return $this->belongsTo('App\Models\Rating', 'user_id', 'user_id');
    // }

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'prod_id', 'id');
    }
}
