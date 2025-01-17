<?php

namespace app\Services\lessonCompletionChain\Handlers;

use App\Models\Assignment;
use App\Models\Lesson;
use App\Models\User;
use app\Services\lessonCompletionChain\Handlers\Contract\LessonHandlerInterface;

class AssignmentCompletionHandler implements LessonHandlerInterface
{
    public function handle(User $student, Lesson $lesson): bool
    {
        //if I have time, I will move this logic to service and repository
        $homework = Assignment::where('lesson_id', $lesson->id)
            ->where('student_id', $student->id)
            ->first();

        if (!$homework || !$homework->completed_at) {
            return false;
        }

        return true;
    }
}
