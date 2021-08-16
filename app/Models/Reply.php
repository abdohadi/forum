<?php

namespace App\Models;

use App\Models\Activity;
use App\Models\Favorite;
use App\Models\Thread;
use App\Models\User;
use App\Traits\Favoritable;
use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory, Favoritable, RecordsActivity;

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

    public function activities()
    {
        return $this->morphMany(Activity::class, 'subject');
    }

    public function route()
    {
        return $this->thread->route() . '#reply-' . $this->id;
    }
}
