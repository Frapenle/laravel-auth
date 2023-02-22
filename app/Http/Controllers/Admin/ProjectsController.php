<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use illuminate\Validation\Rule;

class ProjectsController extends Controller
{
    // <<<<<<<<< validation rules >>>>>>>>>>>>
    // ======== da aggiornare =========
    protected $rules = [
        'name' => ['required', 'unique', 'max: 25'],
        'description' => ['max: 1000'],
        'start_date' => ['date', 'after: 1990-01-01', 'before:today', 'required'],
        'update' => ['datetime', 'after: start_date', 'before:today', 'required'],
        'preview' => ['max: 255', 'default: Preview non disponibile'],
        'authors' => ['required', 'max: 255', 'min: 2'],
        'license' => ['min: 2', 'max:255'],
        'program_lang' => ['min: 2', 'max: 100'],
        'frameworks' => ['min: 2', 'max: 100'],
        'github_url' => ['max: 255', 'url']
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.resources.index', compact('projects'));
        // return 'sono la pagina projects';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        return view('admin.projects.resources.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // variable request all
        $data = $request->all();

        // request validation rules -> top of the page
        $request->validate($this->rules);

        //create new book
        $newProject = new Project();
        $newProject->fill($data);
        $newProject->save();
        return redirect()->route('admin.projects.resources.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.resources.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  iApp\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.projects.resources.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //salvo tutti i dati nella variabile data
        $data = $request->all();
        //creo nuova regola per i campi unique della validation aggiungendola a quelle gia esistenti
        $newRules = $this->rules;
        $newRules['name'] = ['required', 'unique', 'max: 25', Rule::unique('projects')->ignore($project->name)];
        //richiedo validazione con le nuove regole
        $request->validate($newRules);
        $project->update($data);
        return redirect()->route('admin.projects.resources.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return view('admin.projects.resources.index');
    }

    public function trashed()
    {
        $project = Project::onlyTrashed()->get();

        return view('admin.projects.trashed', compact('projects'));
    }

    public function forceDelete($id)
    {
        $project = Project::onlyTrashed()->find($id);
        $project->forceDelete();
        return redirect()->route('admin.projects.trashed');
    }
}
