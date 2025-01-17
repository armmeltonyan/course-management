<?php

namespace App\Http\Requests\Admin;

use app\Enum\PermissionEnum;
use app\Enum\RoleEnum;
use app\Http\Requests\Traits\HasPermissions;
use Illuminate\Foundation\Http\FormRequest;

class AssignTeacherToCourseRequest extends FormRequest
{
    use HasPermissions;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->hasPermission(RoleEnum::ADMIN,PermissionEnum::MANAGECOURSES);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'role' => 'required|exists:roles,name',
        ];
    }
}
