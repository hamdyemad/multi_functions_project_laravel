<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserCategory extends Model
{
    protected $table = 'user_categories';
    protected $fillable = ['user_id', 'category_id'];


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
