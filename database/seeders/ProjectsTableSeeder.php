<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Project;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 20; $i++) {
            $newProject = new Project();
            $newProject->name = $faker->words(3, true);
            $newProject->slug = Str::slug($newProject->name);
            $newProject->description = $faker->sentence(40);
            $newProject->short_description = $faker->sentence(10);
            $newProject->image = '';
            $newProject->relase_date = $faker->dateTimeBetween('-20 week', '+20 week');
            $newProject->type_id= $faker->numberBetween(1, 4);
            $newProject->visibility = true;
            $newProject->project_link = 'https:://non_lo_so.it';
            $newProject->save();
        }
    }
}
