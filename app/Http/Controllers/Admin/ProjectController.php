<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    // <<<<<<<<< validation rules >>>>>>>>>>>>
    // ======== da aggiornare =========
    protected $rules = [
        'name' => ['required', 'unique:projects,name', 'max: 25'],
        'description' => ['max: 1000'],
        'start_date' => ['date', 'after: 1990-01-01', 'before:today', 'required'],
        'update' => ['date', 'after: start_date', 'before:today', 'nullable'],
        'preview' => ['max: 255'],
        'authors' => ['required', 'max: 255', 'min: 2'],
        'license' => ['min:2', 'max:255', 'nullable'],
        'program_lang' => ['min: 2', 'max: 100', 'nullable'],
        'frameworks' => ['min: 2', 'max: 100', 'nullable'],
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
        // metodo per visualizzare il  numero di elementi nel btn cestino
        $trashed = Project::onlyTrashed()->get()->count();

        return view('admin.projects.resources.index', compact('projects', 'trashed'));
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
        return redirect()->route('admin.projects.index');
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
        $newRules['name'] = ['required', Rule::unique('projects')->ignore($project->name), 'max: 25'];
        //richiedo validazione con le nuove regole
        $request->validate($newRules);
        $project->update($data);
        $message = "{$project->name} è stato modificato";
        return redirect()->route('admin.projects.index')->with('message', $message)->with('alert-type', 'alert-success');
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
        $message = "{$project->name} è stato eliminato";
        return redirect()->route('admin.projects.index')->with('message', $message)->with('alert-type', 'alert-danger');
    }

    public function restoreDeleted($id)
    {
        $project = Project::onlyTrashed()->find($id);
        $project->restore();
        $message = "{$project->name} è stato ripristinato";
        return redirect()->route('admin.projects.trashed')->with('message', $message)->with('alert-type', 'alert-primary');
    }

    public function trashed()
    {
        $projects = Project::onlyTrashed()->get();

        return view('admin.projects.trashed', compact('projects'));
    }

    public function forceDelete($id)
    {
        $project = Project::onlyTrashed()->find($id);
        $project->forceDelete();
        $message = "{$project->name} è stato eliminato dal database";
        return redirect()->route('admin.projects.trashed')->with('message', $message)->with('alert-type', 'alert-danger');
    }
}
