<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->role != 'admin') abort(403);
        $types = Type::orderBy('id', 'DESC')->paginate(10);
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.

     */
    public function create()
    {
        if(Auth::user()->role != 'admin') abort(403);
        $type = new Type;
       return view('admin.types.form', compact('type'));
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
        $type = new Type;

        $type->fill($data);

        $type->save();

        return redirect()->route('admin.types.index', $type);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     */
    public function show(Type $type)
    {
        if(Auth::user()->role != 'admin') abort(403);
        $related_projects = $type->projects()->paginate(10);
        return view('admin.types.show', compact('type', 'related_projects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type
     */
    public function edit(Type $type)
    {
        if(Auth::user()->role != 'admin') abort(403);
       return view('admin.types.form', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        if(Auth::user()->role != 'admin') abort(403);
        $data= $request->all();
        $type->update($data);

        return redirect()->route('admin.types.show', $type);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        if(Auth::user()->role != 'admin') abort(403);
        foreach($type->projects as $project ){
            $project->delete();
        }
        $type->delete();
        return redirect()->back();
    }
}
