<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'message'];

    // Ensure user relationship is properly set
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}



