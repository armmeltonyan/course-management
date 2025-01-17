<?php

namespace app\Services\lessonCompletionChain\Handlers;

use App\Models\Lesson;
use App\Models\User;
use app\Services\lessonCompletionChain\Handlers\Contract\LessonHandlerInterface;

class UnlockNextLessonHandler implements LessonHandlerInterface
{
    public function handle(User $student, Lesson $lesson): bool
    {
        //if I have time, I will move this logic to service and repository
        $nextLesson = $lesson->nextLesson;

        if ($nextLesson) {
            $nextLesson->update(['state' => 'unlocked']);
            return true;
        }

        return false;
    }
}
