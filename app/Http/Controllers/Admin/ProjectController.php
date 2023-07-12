<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Technology;

class ProjectController extends Controller
{

    private $validations = [

        'type_id' => "required|integer|exists:types,id",
        'title' => 'required|string|min:5|max:50',
        'creation_date' => 'required|date|max:20',
        'last_update' => 'required|date|max:20',
        'author' => 'required|string|max:30',
        'collaborators' => 'nullable|string|max:150',
        'description' => 'nullable|string|',
        'link_github' => 'required|string|max:150',
        // 'technologies'      => 'nullable|array',
        'technologies. *'   => 'integer|exists:technologies,id',
    ];
    private $validations_messages = [
        'required' => 'il campo :attribute è obbligatorio',
        'min' => 'il campo :attribute deve avere minimo :min caratteri',
        'max' => 'il campo :attribute non può superare i :max caratteri',
        'url' => 'il campo deve essere un url valido',
        'exists' => 'Valore non valido'
    ];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::paginate(5);

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::All();
        $technologies = Technology::All();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validare i dati

        $request->validate($this->validations, $this->validations_messages);

        $data = $request->all();

        // salvare i dati nel database

        $newProject = new Project();

        $newProject->type_id = $data['type_id'];
        $newProject->title = $data['title'];
        $newProject->creation_date = $data['creation_date'];
        $newProject->last_update = $data['last_update'];
        $newProject->author = $data['author'];
        $newProject->collaborators = $data['collaborators'];
        $newProject->description = $data['description'];
        $newProject->link_github = $data['link_github'];

        $newProject->save();

        $newProject->technologies()->sync($data['technologies'] ?? []);

        return redirect()->route('admin.projects.index', ['project' => $newProject]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::All();
        $technologies = Technology::All();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //validare i dati del form

        $request->validate($this->validations, $this->validations_messages);

        $data = $request->all();

        // salvare i dati nel database se validi

        $project->type_id = $data['type_id'];
        $project->title = $data['title'];
        $project->creation_date = $data['creation_date'];
        $project->last_update = $data['last_update'];
        $project->author = $data['author'];
        $project->collaborators = $data['collaborators'];
        $project->description = $data['description'];
        $project->link_github = $data['link_github'];

        $project->update();

        $project->technologies()->sync($data['technologies'] ?? []);

        return redirect()->route('admin.projects.index', ['project' => $project->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return to_route('admin.projects.index')->with('delete_success', $project);
    }

    //da qui in avanti bisogna richiamare i route dal web.php perchè il comando si ferma a 'destroy'

    public function restore($id)
    {
        Project::withTrashed()->where('id', $id)->restore();

        $project = Project::find($id);

        return to_route('admin.projects.index')->with('restore_success', $project);
    }
    public function trashed()
    {
        $trashedProjects = Project::onlyTrashed()->paginate(5);

        return view('admin.projects.trashed', compact('trashedProjects'));
    }
    public function harddelete($id)
    {
        $project = Project::withTrashed()->find($id);

        $project->technologies()->detach();
        $project->forceDelete();

        return to_route('admin.projects.trashed')->with('delete_success', $project);
    }
}
