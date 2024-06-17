<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $guarded = [];


    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function examCenters()
    {
        return $this->belongsToMany(ExamCenter::class, 'job_examcenter', 'job_id', 'examCenter_id');
    }

    public function jobLocations()
    {
        return $this->belongsToMany(JobLocations::class, 'job_joblocation', 'job_id', 'jobLocation_id');
    }
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

}
