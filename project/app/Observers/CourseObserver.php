<?php

namespace App\Observers;

use App\Models\Course;
use Illuminate\Support\Str;

class CourseObserver
{
    /**
     * Handle the Course "creating" event.
     * @param Course $course
     */
    public function creating(Course $course): void
    {
        $course->uuid = Str::uuid()->toString();
    }
}
