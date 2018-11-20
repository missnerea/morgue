<?php

use Illuminate\Database\Seeder;

class UndertakersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$admin= App\Undertaker::find(1);
        factory(App\Undertaker::class,3)->create();
    }
}
