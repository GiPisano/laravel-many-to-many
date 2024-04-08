<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $technologies = [
            'HTML5',
            'CSS3',
            'Bootstrap',
            'JavaScript ES5',
            'VueJs 3',
            'Axios',
            'RESTful API',
            'SQL',
            'PHP',
            'Ison',
            'Laravel',
            'Blade',
            'Eloquent',
            'React.js',
            'Angular',
            'Node.js',
            'MongoDB',
            'MySQL',
            'Sass',
            'jQuery',
            'Faker'
        ];

        foreach($technologies as $_technology){
            $technology = new Technology;
            $technology->label = $_technology;
            $technology->color = $faker->hexColor();
            $technology->save();
        }
        
    }
}
