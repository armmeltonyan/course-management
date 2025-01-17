<?php

namespace app\Services\lessonCompletionChain\Contract;

use App\Models\Lesson;
use App\Models\User;

interface LessonCompletionStrategyInterface
{
    public function completeLesson(User $student, Lesson $lesson): bool;
}
