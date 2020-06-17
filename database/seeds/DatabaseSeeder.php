<?php

use App\Models\Admin;
use App\Models\Player;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminTableSeeder::class);
        $this->call(TeamTableSeeder::class);
        $this->call(PlayerTableSeeder::class);
    }
}

class AdminTableSeeder extends Seeder
{
	public function run()
	{
        DB::statement("SET foreign_key_checks=0");
		Admin::truncate();
        DB::statement("SET foreign_key_checks=1");
        
		$faker = Faker\Factory::create();
		$data = [];

		Admin::create(array(
			// 'location_id' => $faker->numberBetween(1, 5),
			'name' => 'Ebrahim',
			'email' => 'demo@admin.com',
			'password' => Hash::make('password'),
		));

    }
}

class TeamTableSeeder extends Seeder
{
	public function run()
	{
        DB::statement("SET foreign_key_checks=0");
		Team::truncate();
        DB::statement("SET foreign_key_checks=1");

		$faker = Faker\Factory::create();
        $teamsData = ['Manchestor United','Team 2','Team 3','Team 4','Team 5'];
        $datatToInsert = [];

        foreach($teamsData as $team){
            $datatToInsert[] = [
                'name' => $team,
                'active' => 1,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ];
        }
        Team::insert($datatToInsert);
        
    }
}
class PlayerTableSeeder extends Seeder
{
	public function run()
	{
        DB::statement("SET foreign_key_checks=0");
		Player::truncate();
        DB::statement("SET foreign_key_checks=1");

		$faker = Faker\Factory::create();
        $datatToInsert = [];

        $teams = Team::get();

        foreach(range(1,10) as $player){
            $datatToInsert[] = [
                // 'team_id' => $teams[rand(0,4)]['id'],
                'name' => 'Player '.$player,
                'active' => 1,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ];
        }
        Player::insert($datatToInsert);
        
    }
}
