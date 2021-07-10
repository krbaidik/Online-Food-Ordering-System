<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        	// $data = new User(
        	// 	[
        	// 		'name'=> Str::random(10),
        	// 		'phone'=> random_int(0000000000,9999999999),
        	// 		'usertype'=> "user",
        	// 		'type'=> 1,
        	// 		'email' => Str::random(9)."@gmail.com",
        	// 		'password' => Hash::make(Str::random(8)),
        	// 	]);
        	
        	// $data->save();

        	$data1 = new User(
        		[
        			'name'=> "khubi",
        			'phone'=> 9810258144,
        			'usertype'=> "admin",
        			'type'=> 1,
        			'email' => "krbaidik0@gmail.com",
        			'password' => Hash::make("khubiram"),
        		]
            );
        	
        	$data1->save();

            $data2 = new User(
            [
                    'name'=> "Hunter",
                    'phone'=> 9999955555,
                    'usertype'=> "user",
                    'type'=> "1,2",
                    'email' => "hunter@gmail.com",
                    'password' => Hash::make("hunter123"),
                ]);
            $data2->save();
        }
    }
