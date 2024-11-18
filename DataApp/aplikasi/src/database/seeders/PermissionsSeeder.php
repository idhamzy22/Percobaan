<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        // Create permissions for Staff
        $staffPermissions = [
            'books',
            'view_any_books',
            'create_books',
            'update_books',
            'delete_books',
            'delete_any_books',
            'borrowings',
            'view_any_borrowings',
            'create_borrowings',
            'update_borrowings',
            'delete_borrowings',
            'delete_any_borrowings',
            'visitors',
            'view_any_visitors',
            'create_visitors',
            'update_visitors',
            'delete_visitors',
            'delete_any_visitors',
        ];

        // Create permissions if they don't exist
        foreach ($staffPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create or get the 'staff' role
        $staffRole = Role::firstOrCreate(['name' => 'Staff']);
        // Assign permissions to the 'staff' role
        $staffRole->givePermissionTo($staffPermissions);
    }
}
