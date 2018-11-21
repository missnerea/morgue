<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Admin::class,2)->create()->each(function($admin){
            factory(App\Undertaker::class,2)->create()->each(function($undertaker) use($admin ){
                $undertaker->admin_id=$admin->id;
                $undertaker->save();
            });
            
            factory(App\Deceased::class,2)->create()->each(function($deceased) use($admin){
                $deceased->admin_id=$admin->id;
                $deceased->save();
            });
        });
    }
}
