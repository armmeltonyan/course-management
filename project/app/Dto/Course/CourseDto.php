<?php

namespace app\Dto\Course;

use Spatie\DataTransferObject\DataTransferObject;

class CourseDto extends DataTransferObject
{
    public string $title;
    public string $description;
}
