<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'manage courses']);
        Permission::create(['name' => 'create lessons']);
        Permission::create(['name' => 'manage assignments']);
        Permission::create(['name' => 'manage tests']);
        Permission::create(['name' => 'enroll courses']);
        Permission::create(['name' => 'complete lessons']);


        $admin = Role::create(['name' => 'admin']);
        $teacher = Role::create(['name' => 'teacher']);
        $student = Role::create(['name' => 'student']);


        $admin->givePermissionTo(['manage users', 'manage courses']);
        $teacher->givePermissionTo(['create lessons', 'manage assignments', 'manage tests']);
        $student->givePermissionTo(['enroll courses', 'complete lessons']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $admin = Role::findByName('admin');
        $teacher = Role::findByName('teacher');
        $student = Role::findByName('student');

        if ($admin) {
            $admin->revokePermissionTo(['manage users', 'manage courses']);
            $admin->delete();
        }

        if ($teacher) {
            $teacher->revokePermissionTo(['create lessons', 'manage assignments', 'manage tests']);
            $teacher->delete();
        }

        if ($student) {
            $student->revokePermissionTo(['enroll courses', 'complete lessons']);
            $student->delete();
        }

        Permission::whereIn('name', [
            'manage users',
            'manage courses',
            'create lessons',
            'manage assignments',
            'manage tests',
            'enroll courses',
            'complete lessons',
        ])->delete();
    }
};
