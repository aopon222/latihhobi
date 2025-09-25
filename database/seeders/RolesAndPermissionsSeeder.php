<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions
        $permissions = [
            // User management
            'manage-users',
            'view-users',
            'create-users',
            'edit-users',
            'delete-users',
            
            // Role management
            'manage-roles',
            'view-roles',
            'create-roles',
            'edit-roles',
            'delete-roles',
            
            // Content management
            'manage-content',
            'view-content',
            'create-content',
            'edit-content',
            'delete-content',
            
            // E-course management
            'manage-ecourses',
            'view-ecourses',
            'create-ecourses',
            'edit-ecourses',
            'delete-ecourses',
            
            // Program management
            'manage-programs',
            'view-programs',
            'create-programs',
            'edit-programs',
            'delete-programs',
            
            // Event management
            'manage-events',
            'view-events',
            'create-events',
            'edit-events',
            'delete-events',
            
            // Community management
            'manage-communities',
            'view-communities',
            'create-communities',
            'edit-communities',
            'delete-communities',
            
            // Payment management
            'manage-payments',
            'view-payments',
            'process-payments',
            'refund-payments',
            
            // Analytics
            'view-analytics',
            'view-reports',
        ];
        
        // Create permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
        
        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $moderatorRole = Role::firstOrCreate(['name' => 'moderator']);
        $teacherRole = Role::firstOrCreate(['name' => 'teacher']);
        $parentRole = Role::firstOrCreate(['name' => 'parent']);
        $studentRole = Role::firstOrCreate(['name' => 'student']);
        
        // Assign all permissions to admin
        $adminRole->givePermissionTo(Permission::all());
        
        // Assign specific permissions to moderator
        $moderatorRole->givePermissionTo([
            'view-users',
            'manage-content',
            'view-content',
            'create-content',
            'edit-content',
            'manage-ecourses',
            'view-ecourses',
            'create-ecourses',
            'edit-ecourses',
            'manage-programs',
            'view-programs',
            'create-programs',
            'edit-programs',
            'manage-events',
            'view-events',
            'create-events',
            'edit-events',
            'manage-communities',
            'view-communities',
            'edit-communities',
            'view-payments',
            'view-analytics',
            'view-reports',
        ]);
        
        // Assign specific permissions to teacher
        $teacherRole->givePermissionTo([
            'view-content',
            'edit-content',
            'view-ecourses',
            'edit-ecourses',
            'view-programs',
            'edit-programs',
            'view-events',
            'edit-events',
        ]);
        
        // Parent and student roles don't need specific permissions
        // They will be granted permissions through policies or direct checks
    }
}
