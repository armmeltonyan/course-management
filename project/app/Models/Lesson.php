<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'course_id'];

    // Relationship with course
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    // Relationship with assignments
    public function assignments(): HasMany
    {
        return $this->hasMany(Assignment::class);
    }

    // Relationship with tests
    public function tests(): HasMany
    {
        return $this->hasMany(Test::class);
    }
}
