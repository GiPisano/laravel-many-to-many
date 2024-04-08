<?php

namespace Database\Seeders;

use App\Models\project;
use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProjectTechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $projects = Project::all();
        $technologies = Technology::all();

        foreach($projects as $project){
            $random_technologies = $faker->randomElement($technologies, rand(1, 5));
            $project->technologies()->sync($random_technologies);
        }
        
    }
}
