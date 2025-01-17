<?php

namespace app\Repositories;

use app\Dto\Course\CourseDto;
use App\Models\Course;
use app\Repositories\Contracts\CourseRepositoryInterface;
use app\Repositories\Contracts\UserDto;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class CourseRepository implements CourseRepositoryInterface
{
    protected Builder $query;

    public function __construct()
    {
        $this->query = Course::query();
    }

    public function getAll(): Collection
    {
        return $this->query->with('teacher')->get();
    }

    public function assignTeacher(Course $course, int $teacherId): bool
    {
        return $course->teacher()->associate($teacherId)->save();
    }

    public function findById(int $id): ?Course
    {
        // TODO: Implement findById() method.
    }

    public function create(CourseDto $courseDto): ?Course
    {
        return $this->query->create($courseDto->toArray());
    }

    public function update(int $id, CourseDto $courseDto): bool
    {
        // TODO: Implement update() method.
    }

    public function delete(int $id): bool
    {
        // TODO: Implement delete() method.
    }
}
