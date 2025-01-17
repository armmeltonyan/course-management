<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'teacher_id'];

    // Relationship with lessons
    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }

    // Relationship with students (many-to-many)
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    // Relationship with teacher (one-to-many)
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}
