<?php

namespace app\Services\lessonCompletionChain\Handlers\Contract;

use App\Models\Lesson;
use App\Models\User;

interface LessonHandlerInterface
{
    public function handle(User $student, Lesson $lesson): bool;
}
