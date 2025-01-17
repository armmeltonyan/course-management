<?php

namespace app\Services\lessonCompletionChain;

use App\Models\Lesson;
use App\Models\User;
use app\Services\lessonCompletionChain\Handlers\AssignmentCompletionHandler;
use app\Services\lessonCompletionChain\Handlers\LessonCompletionHandler;
use app\Services\lessonCompletionChain\Handlers\UnlockNextLessonHandler;
use JetBrains\PhpStorm\Pure;

class LessonCompletionChain
{
    private array $handlers;

    #[Pure]
    public function __construct()
    {
        $this->handlers = [
            new LessonCompletionHandler(),
            new AssignmentCompletionHandler(),
            new UnlockNextLessonHandler()
        ];
    }

    public function process(User $student, Lesson $lesson): bool
    {
        foreach ($this->handlers as $handler) {
            if (!$handler->handle($student, $lesson)) {
                return false;
            }
        }

        return true;
    }
}
