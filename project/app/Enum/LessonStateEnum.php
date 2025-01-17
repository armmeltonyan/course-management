<?php

namespace app\Enum;

enum LessonStateEnum: string
{
    case Locked = 'locked';
    case Unlocked = 'unlocked';
    case Completed = 'completed';
}
