<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Test;
use app\Services\lessonCompletionChain\LessonCompletionChain;
use app\Services\User\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StudentController extends BaseController
{
    public function __construct(
        protected LessonCompletionChain $lessonCompletionChain,
        protected UserService $userService
    ) {}

    public function completeLesson(Lesson $lesson): RedirectResponse
    {
        $student = $this->userService->getById(auth()->id());

        return $this->lessonCompletionChain->process($student, $lesson)
            ? self::sendResponse('student.lesson','Lesson passed successfully.')
            : self::sendError('error');
    }
}
