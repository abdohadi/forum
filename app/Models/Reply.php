<?php

namespace App\Models;

use App\Favoritable;
use App\Models\Favorite;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory, Favoritable;

    protected $fillable = ['body', 'user_id'];

    protected $with = ['owner', 'favorites'];

    public function owner()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }
}
