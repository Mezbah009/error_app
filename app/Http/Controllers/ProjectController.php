<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    //-----------------index method-------------------
    public function index()
    {
        $projects = Project::when(!auth()->user()->hasRole('admin'), function ($query) {
            return $query->where('developer_id', auth()->id());
        })
        ->orderBy('created_at', 'desc') // Order by created_at in descending order
        ->paginate();

        return view('projects.index', compact('projects')); // Return to the view
    }


    //--------create method-------------------


    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        Project::create([
            'title' => $request->title,
            'developer_id' => auth()->id()
        ]);

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    // public function show(Project $project)
    // {
    //     return view('projects.show', compact('project'));
    // }


    //--------edit method-------------------

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }


    //--------update method-------------------

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $project->update($request->all());

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
