<?php

namespace App\Http\Controllers\User;

use app\Dto\Course\CourseDto;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Course\StoreCourseRequest;
use app\Services\Course\CourseService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TeacherController extends BaseController
{
    public function __construct(
        protected readonly CourseService $courseService,
    ) {}

    public function index(): View
    {
        $courses = $this->courseService->all();

        return self::sendView('teacher.courses.index',['courses' => $courses]);
    }

    public function storeCourse(StoreCourseRequest $request): RedirectResponse
    {
        $courseDto = new CourseDto(
            title: $request->title,
            description: $request->description
        );

        return (null !== $this->courseService->create($courseDto))
            ? self::sendResponse('teacher.manage.courses','User created successfully.')
            : self::sendError('error');
    }

    public function editCourse()
    {

    }

    public function destroyCourse()
    {

    }
}
