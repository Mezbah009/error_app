<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjrctController extends Controller
{
    public function index()
    {
        $projects = Project::paginate(10); // Fetch paginated projects, 10 per page
        return view('projects.index', compact('projects')); // Return to the view
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        Project::create($request->all());

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    // public function show(Project $project)
    // {
    //     return view('projects.show', compact('project'));
    // }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

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
