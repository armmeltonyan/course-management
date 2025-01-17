<?php

namespace app\Services\lessonCompletionChain\Handlers;

use App\Models\Lesson;
use App\Models\User;
use app\Services\lessonCompletionChain\Handlers\Contract\LessonHandlerInterface;
use app\Services\lessonCompletionChain\Strategies\LessonWithHomeworkStrategy;
use app\Services\lessonCompletionChain\Strategies\LessonWithoutHomeworkStrategy;

class LessonCompletionHandler implements LessonHandlerInterface
{
    public function handle(User $student, Lesson $lesson): bool
    {
        $strategy = match (true) {
            $lesson->assignments => app(LessonWithHomeworkStrategy::class),
            default => app(LessonWithoutHomeworkStrategy::class)
        };

        return $strategy->completeLesson($student, $lesson);
    }
}
