<?php

namespace App\Models;

use App\Models\Reply;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;

    public function replies()
    {
    	return $this->hasMany(Reply::class);
    }

    public function addReply($reply)
    {
    	$this->replies()->create($reply);
    }

    public function creator()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }
}

