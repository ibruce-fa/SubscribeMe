<?php

use Illuminate\Database\Seeder;

class BusinessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('businesses')->truncate();
        factory(App\Business::class, 30)->create();
    }
}
