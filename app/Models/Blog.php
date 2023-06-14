<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'user_id', 'category_id'];

    public function user(){
        // return $this->belongsTo(User::class, 'user_id', 'id'); //if you didn't define as 'user_id' you must have to give foreign key and owner key
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
