<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


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
            // $slug = Project::slugger($arrProjects['title']);

            $slug = Project::slugger($arrProjects['title']);

            $project = Project::create([
                "title"         => $arrProjects['title'],
                "slug"          => $slug,
                "author"        => $arrProjects['author'],
                "creation_date" => $arrProjects['creation_date'],
                "last_update"   => $arrProjects['last_update'],
                "collaborators" => $arrProjects['collaborators'],
                "image"         => $arrProjects['image'],
                "description"   => $arrProjects['description'],
                "link_github"   => $arrProjects['link_github'],
                "type_id"       => $arrProjects['type_id'],
            ]);
            $project->technologies()->sync($arrProjects['technologies']);
        }
    }
}
