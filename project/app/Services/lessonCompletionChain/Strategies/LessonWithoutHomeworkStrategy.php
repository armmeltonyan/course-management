<?php

namespace app\Services\lessonCompletionChain\Strategies;

use App\Models\Lesson;
use App\Models\User;
use app\Services\lessonCompletionChain\Contract\LessonCompletionStrategyInterface;

class LessonWithoutHomeworkStrategy implements LessonCompletionStrategyInterface
{

    public function completeLesson(User $student, Lesson $lesson): bool
    {
        $student->markLessonCompleted($lesson);

        return true;
    }
}
