<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {   
        $projects = Project::orderBy('id', 'DESC')->where('user_id', Auth::id())->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $project = new project;
        $types = Type::all();
        $technologies = Technology::all();
       return view('admin.projects.form', compact('project', 'types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(StoreProjectRequest $request)
    {
        $request->validated();
        $data = $request->all();

        $project = new project;
        $project->fill($data);
        $project->user_id = Auth::id();
        $project->save();

        $project->technologies()->attach($data["technologies"]);

        return redirect()->route('admin.projects.show', $project);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\project  $project
     */
    public function show(project $project)
    {
        if(Auth::id() != $project->user_id) abort(403);
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\project  $project
     */
    public function edit(project $project)
    {
        if(Auth::id() != $project->user_id) abort(403);
        $types = Type::all();
        $technologies = Technology::all();
        $technologies_id = $project->technologies->pluck('id')->toArray();
        return view('admin.projects.form' , compact('project', 'types', 'technologies', 'technologies_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\project  $project
     */
    public function update(UpdateProjectRequest $request, project $project)
    {
        if(Auth::id() != $project->user_id) abort(403); 
        
        $request->validated();
        $data= $request->all();
        $project->update($data);

        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\project  $project
     */
    public function destroy(project $project)
    {
        if(Auth::id() != $project->user_id) abort(403);

        $project->delete();
        return redirect()->back();
    }
}
