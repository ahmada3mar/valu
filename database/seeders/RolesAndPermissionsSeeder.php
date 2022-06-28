<?php

namespace Database\Seeders;

use Hyperpay\ConnectIn\Models\MongoLog;
use Hyperpay\ConnectIn\Models\Merchant;
use Hyperpay\ConnectIn\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
/**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info( Permission::class);
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $collection = collect([
            User::class,
            Role::class,
            Permission::class,
            Merchant::class,
            MongoLog::class,
            Transaction::class,
            // ... // List all your Models you want to have Permissions for.
        ]);

        $adminEmail = env('NOVA_PERMISSION_ADMIN_EMAIL', 'admin@hyperpay.com');

        if (is_null($adminEmail)) {
            throw new \InvalidArgumentException('Email parameter must be provided!');
        }

        $collection->each(function ($item, $key) {
            // create permissions for each collection item
            $group = $this->getGroupName($item);
            $permission = $this->getPermissionName($item);

              Permission::updateOrCreate([
                    'group' => $group,
                    'name' =>   'view ' . $permission,
                    ]);
                    Permission::updateOrCreate([
                        'group' => $group,
                        'name' =>   'create ' . $permission,
                    ]);
                    Permission::updateOrCreate([
                        'group' => $group,
                        'name' =>   'update ' . $permission,
                    ]);
                    Permission::updateOrCreate([
                        'group' => $group,
                        'name' =>   'delete ' . $permission,
                    ]);
                    Permission::updateOrCreate([
                        'group' => $group,
                        'name' =>   'destroy ' . $permission,
                    ]);
                    Permission::updateOrCreate([
                        'group' => $group,
                        'name' =>   'restore ' . $permission,
                    ]);
                });

        Permission::updateOrCreate([
            'name' => 'view action events',
            'group' => 'Action Events',
        ]);

        // Create an Admin Role and assign all Permissions
        $role = Role::updateOrCreate(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());

       // Give User Admin Role
         $user = User::whereEmail($adminEmail)->first(); // Change this to your email.
         $user->assignRole('admin');
    }

    /**
     * Get group name based on the model class provided
     *
     * @param $class
     *
     * @return string
     */
    private function getGroupName($class)
    {
        return Str::plural(Str::title(Str::snake(class_basename($class), ' ')));
    }

    /**
     * Get permission name based on the model class provided
     *
     * @param $class
     *
     * @return string
     */
    private function getPermissionName($class)
    {
        return Str::plural(Str::snake(class_basename($class), ' '));
    }
}
