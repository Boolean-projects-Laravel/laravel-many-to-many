<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;


class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = config('projects');

        foreach ($projects as $arrProjects) {
            // metodo 1
            // $objHouse = new House();
            // $objHouse->reference = $arrHouse['reference'];
            // $objHouse->save()

            // metodo 2
            Project::create($arrProjects);
        }
    }
}