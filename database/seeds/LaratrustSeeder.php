<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaratrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return  void
     */
    public function run()
    {
        $this->command->info('Truncating User, Role and Permission tables');
        $this->truncateLaratrustTables();

        $config = config('laratrust_seeder.role_structure');
        $userPermission = config('laratrust_seeder.permission_structure');
        $mapPermission = collect(config('laratrust_seeder.permissions_map'));

        foreach ($config as $key => $modules) {

            // Create a new role
            $role = \App\Starter\Users\Models\Role::create([
                'name' => $key,
                'type' => $key,
                'display_name' => ucwords(str_replace('_', ' ', $key)),
                'description' => ucwords(str_replace('_', ' ', $key))
            ]);
            $permissions = [];

            $this->command->info('Creating Role '. strtoupper($key));

            // Reading role permission modules
            foreach ($modules as $module => $value) {
                foreach (explode(',', $value) as $p => $perm) {
                    $permissionValue = $mapPermission->get($perm);

                    $permissions[] = \App\Starter\Users\Models\Permission::firstOrCreate([
                        'name' => $permissionValue . '-' . $module,
                        'display_name' => ucfirst($permissionValue) . ' ' . ucfirst($module),
                        'description' => ucfirst($permissionValue) . ' ' . ucfirst($module),
                    ])->id;

                    $this->command->info('Creating Permission to '.$permissionValue.' for '. $module);
                }
            }

            // Attach all permissions to the role
            $role->permissions()->sync($permissions);

            $this->command->info("Creating '{$key}' user");

            // Create default user for each role
            $user = \App\Starter\Users\User::create([
                'first_name' => ucwords(str_replace('_', ' ', $key)),
                'last_name' => ucwords(str_replace('_', ' ', $key)),
                'email' => $key.'@'.$role->name.'.com',
                'password' => 'password',
                'type' => $role->name,
                'mobile_number' => '0100008954'.rand(1, 9),
                'confirmed' => 1
            ]);


            $user->attachRole($role);
        }

        // Creating user with permissions
        if (!empty($userPermission)) {
            foreach ($userPermission as $key => $modules) {
                foreach ($modules as $module => $value) {

                    // Create default user for each permission set
                    $user = \App\Starter\Users\User::create([
                        'first_name' => ucwords(str_replace('_', ' ', $key)),
                        'last_name' => ucwords(str_replace('_', ' ', $key)),
                        'email' => $key.'@'.$role->name.'.com',
                        'password' => 'password',
                        'remember_token' => str_random(10),
                        'type' => $role->name,
                        'mobile_number' => '01001199'.rand(111, 999),
                        'confirmed' => 1
                    ]);
                    $permissions = [];

                    foreach (explode(',', $value) as $p => $perm) {
                        $permissionValue = $mapPermission->get($perm);

                        $permissions[] = \App\Starter\Users\Models\Permission::firstOrCreate([
                            'name' => $permissionValue . '-' . $module,
                            'display_name' => ucfirst($permissionValue) . ' ' . ucfirst($module),
                            'description' => ucfirst($permissionValue) . ' ' . ucfirst($module),
                        ])->id;

                        $this->command->info('Creating Permission to '.$permissionValue.' for '. $module);
                    }
                }

                // Attach all permissions to the user
                $user->permissions()->sync($permissions);
            }
        }
    }

    /**
     * Truncates all the laratrust tables and the users table
     *
     * @return    void
     */
    public function truncateLaratrustTables()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('permission_role')->truncate();
        DB::table('permission_user')->truncate();
        DB::table('role_user')->truncate();
        \App\Starter\Users\User::truncate();
        \App\Starter\Users\Models\Role::truncate();
        \App\Starter\Users\Models\Permission::truncate();
        Schema::enableForeignKeyConstraints();
    }
}
