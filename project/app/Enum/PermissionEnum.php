<?php

namespace app\Enum;

enum PermissionEnum: string
{
    case MANAGEUSERS = 'manage users';
    case MANAGECOURSES = 'manage courses';
    case CREATELESSONS = 'create lessons';
    case MANAGEASSIGNMENTS = 'manage assignments';
    case MANAGETESTS = 'manage tests';
    case ENROLlCOURSES = 'enroll courses';
    case COMPLETELESSONS = 'complete lessons';
    case MANAGEPERMISSIONS = 'manage permisssions';
}
