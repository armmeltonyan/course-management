<?php

namespace App\Http\Controllers\Admin;

use app\Dto\Admin\UserDto;
use app\Enum\RoleEnum;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\AssignTeacherToCourseRequest;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Models\Course;
use App\Models\User;
use app\Services\Course\CourseService;
use app\Services\Role\RoleService;
use app\Services\User\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class UserController extends BaseController
{
    public function __construct(
        protected UserService $userService,
        protected readonly CourseService $courseService,
        protected readonly RoleService $roleService
    ) {}

    public function index(): View
    {
        return self::sendView('admin.users.index',['users' => $this->userService->all()]);
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $userDto = new UserDto(
            name: $request->name,
            email: $request->email,
            password: $request->password,
            role: $request->role,
        );

        return (null !== $this->userService->create($userDto))
            ? self::sendResponse('admin.manage.users','User created successfully.')
            : self::sendError('error');
    }

    public function edit(User $user): View
    {
        return self::sendView('admin.users.edit',['user' => $user,'roles' => $this->roleService->all()]);
    }

    /**
     * @throws UnknownProperties
     */
    public function update(StoreUserRequest $request, User $user): RedirectResponse
    {
        $userDto = new UserDto(
            name: $request->name,
            email: $request->email,
            password: Hash::make($request->password),
            role: $request->role,
        );

        return $this->userService->update($user->id,$userDto)
            ? self::sendResponse('admin.manage.users','User updated successfully.')
            : self::sendError('error');
    }

    public function destroy(User $user): RedirectResponse
    {
        return $this->userService->delete($user->id)
            ? self::sendResponse('admin.manage.users','User deleted successfully.')
            : self::sendError('error');
    }

    public function manageCourses(): View
    {
        $courses = $this->courseService->all();
        $teachers = $this->userService->getByRole(RoleEnum::TEACHER);

        return self::sendView('admin.courses.index',['courses' => $courses,'teachers' => $teachers]);
    }

    public function assignTeacherToCourse(AssignTeacherToCourseRequest $request, Course $course): RedirectResponse
    {
        return $this->courseService->assignTeacher($course,$request->teacher_id)
            ? self::sendResponse('admin.manage.courses','Course attached to course.')
            : self::sendError('error');
    }
}
