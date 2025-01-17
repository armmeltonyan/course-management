<?php

namespace app\Repositories\Contracts;

use app\Dto\Course\CourseDto;
use App\Models\Course;
use Illuminate\Database\Eloquent\Collection;

interface CourseRepositoryInterface
{
    public function getAll(): Collection;
    public function findById(int $id): ?Course;
    public function create(CourseDto $courseDto): ?Course;
    public function update(int $id, CourseDto $courseDto): bool;
    public function delete(int $id): bool;
}
