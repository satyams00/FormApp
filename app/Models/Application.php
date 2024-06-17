<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $guarded = [];
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }


}
