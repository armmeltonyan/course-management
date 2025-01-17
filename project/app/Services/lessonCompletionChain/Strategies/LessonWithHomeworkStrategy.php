<?php

namespace app\Services\lessonCompletionChain\Strategies;

use App\Models\Lesson;
use App\Models\User;
use app\Services\lessonCompletionChain\Contract\LessonCompletionStrategyInterface;

class LessonWithHomeworkStrategy implements LessonCompletionStrategyInterface
{

    public function completeLesson(User $student, Lesson $lesson): bool
    {
        // Проверяем, выполнено ли домашнее задание
        $homework = Homework::where('lesson_id', $lesson->id)
            ->where('student_id', $student->id)
            ->first();

        if (!$homework || !$homework->completed_at) {
            // Если домашнее задание не выполнено, возвращаем false
            return false;
        }

        // Завершаем урок
        $student->markLessonCompleted($lesson);

        return true;
    }
}
