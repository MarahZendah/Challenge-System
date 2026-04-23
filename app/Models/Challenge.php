<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    /** @use HasFactory<\Database\Factories\ChallengeFactory> */
    use HasFactory;
    protected $fillable = ['title', 'description', 'total_days'];
    public function users() {
    return $this->belongsToMany(User::class)
                ->withPivot('status', 'start_date')
                ->withTimestamps();
}

public function progressLogs() {
    return $this->hasMany(ProgressLog::class);
}
}
