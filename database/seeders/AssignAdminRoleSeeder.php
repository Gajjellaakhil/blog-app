<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AssignAdminRoleSeeder extends Seeder
{
    public function run()
    {
        $user = User::find(1); // Replace with the user ID
        if ($user) {
            $user->role = 'admin';
            $user->save();
            echo "Admin role assigned to User ID {$user->id}.\n";
        } else {
            echo "User not found.\n";
        }
    }
}
