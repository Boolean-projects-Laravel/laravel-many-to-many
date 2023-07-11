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

            $project = Project::create([
                "title"         => $arrProjects['title'],
                "author"        => $arrProjects['author'],
                "creation_date" => $arrProjects['creation_date'],
                "last_update"   => $arrProjects['last_update'],
                "collaborators" => $arrProjects['collaborators'],
                "description"   => $arrProjects['description'],
                "link_github"   => $arrProjects['link_github'],
                "type_id"       => $arrProjects['type_id'],
            ]);
            $project->technologies()->sync($arrProjects['technologies']);
        }
    }
}
