<?php

namespace App\Http\Controllers\Admin;

use App\Models\Technology;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TechnologyController extends Controller
{


    private $validations = [
        "name" => "required|string|max:50",
        "description" => "required|string|max:5000",
    ];

    private $validation_messages = [
        'required' => 'Il campo :attribute è obbligatorio',
        'max' => 'Il campo :attribute non può superare i :max caratteri',
        'exists' => 'Valore non valido'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $technologies = Technology::all();

        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.technologies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validations, $this->validation_messages);

        $data = $request->all();

        // salvare i dati nel db
        $newTechnology = new Technology();

        $newTechnology->name = $data['name'];
        $newTechnology->description = $data['description'];

        $newTechnology->save();

        // rotta di tipo get
        return to_route('admin.technologies.index', ['technology' => $newTechnology]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Technology $technology)
    {
        return view('admin.technologies.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Technology $technology)
    {
        // validare i dati del form
        $request->validate($this->validations, $this->validation_messages);

        $data = $request->all();

        // aggiornare i dati nel db
        $technology->name = $data['name'];
        $technology->description = $data['description'];

        $technology->update();

        // rotta di tipo get
        return to_route('admin.technologies.index', ['technology' => $technology->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Technology $technology)
    {

        $technology->projects()->detach();
        $technology->delete();

        return to_route('admin.technologies.index')->with('delete_success', $technology);
    }
}
