<?php
use Illuminate\Database\Seeder;

class BasicSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ///////////////////////////////////////////////////////////////// Default Configs
        dump('Default Configs');
        DB::table('configs')->delete();
//        DB::statement("ALTER TABLE configs AUTO_INCREMENT = 1");
        insertDefaultConfigs();
        ////////////////////////////////////////////////////////// insert default role
        dump('Insert Default Role');
        $this->call(LaratrustSeeder::class);
    }
}
