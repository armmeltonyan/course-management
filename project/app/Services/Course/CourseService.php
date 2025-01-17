<?php

namespace app\Services\Course;

use app\Dto\Course\CourseDto;
use App\Models\Course;
use app\Repositories\CourseRepository;
use Illuminate\Database\Eloquent\Collection;

class CourseService
{
    public function __construct(protected CourseRepository $courseRepository) {}

    public function all(): Collection
    {
        return $this->courseRepository->getAll();
    }

    public function create(CourseDto $courseDto): ?Course
    {
       return $this->courseRepository->create($courseDto);
    }

    public function assignTeacher(Course $course, int $teacherId): bool
    {
        return $this->courseRepository->assignTeacher($course,$teacherId);
    }
}
