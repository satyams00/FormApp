<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobLocations extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $guarded = [];

    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'job_joblocation', 'job_id', 'jobLocation_id');
    }
}
