<?php

namespace app\Services\Lesson;

use app\Repositories\LessonRepository;

class LessonService
{
    public function __construct(
        protected LessonRepository $lessonRepository,
    ) {}

    public function update(LessonDto $lessonDto)
    {

    }
}
