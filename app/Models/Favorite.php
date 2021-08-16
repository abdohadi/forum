<?php

namespace App\Models;

use App\Models\Activity;
use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory, RecordsActivity;

    protected $guarded = [];

    public function activities()
    {
        return $this->morphMany(Activity::class, 'subject');
    }

    public function favorited()
    {
        return $this->morphTo();
    }
}
