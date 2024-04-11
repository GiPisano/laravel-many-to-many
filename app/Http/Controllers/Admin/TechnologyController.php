<?php

namespace App\Http\Controllers\Admin;

use App\Models\Technology;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        if(Auth::user()->role != 'admin') abort(403);
        $technologies = Technology::orderBy('id', 'DESC')->paginate(10);
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        if(Auth::user()->role != 'admin') abort(403);
        $technology = new Technology;
       return view('admin.technologies.form', compact('technology'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        if(Auth::user()->role != 'admin') abort(403);
        $data= $request->all();
        $technology = new Technology;

        $technology->fill($data);

        $technology->save();

        return redirect()->route('admin.technologies.index', $technology);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     */
    public function show(Technology $technology)
    {
        if(Auth::user()->role != 'admin') abort(403);
        $related_projects = $technology->projects()->paginate(10);
        return view('admin.technologies.show', compact('technology', 'related_projects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     */
    public function edit(Technology $technology)
    {
        if(Auth::user()->role != 'admin') abort(403);
       return view('admin.technologies.form', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Technology  $technology
     */
    public function update(Request $request, Technology $technology)
    {
        if(Auth::user()->role != 'admin') abort(403);
        $data= $request->all();
        $technology->update($data);

        return redirect()->route('admin.technologies.show', $technology);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Technology  $technology
     */
    public function destroy(Technology $technology)
    {
        if(Auth::user()->role != 'admin') abort(403);
        foreach($technology->projects as $project ){
            $project->delete();
        }
        $technology->delete();
        return redirect()->back();
    }
}
