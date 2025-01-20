<?php

namespace App\Http\Controllers;

use App\Models\ErrorTracking;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ErrorTrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all error tracking records with related developer and project
        $errorTrackings = ErrorTracking::with(['developer', 'project'])->paginate(10);

        return view('error_trackings.index', compact('errorTrackings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $developers = User::where('role', 'user')->get(); // Fetch users with role 'user'
        $projects = Project::all(); // Fetch all projects

        return view('error_trackings.create', compact('developers', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'developer_id' => 'required|exists:users,id',
            'project_id' => 'required|exists:projects,id',
            'date' => 'required|date',
            'error_type' => 'required|string|max:255',
            'solution_description' => 'required|string',
            'solution_provided_by' => 'required|string|max:255',
            'status' => 'required|string|max:50',
            'comments' => 'nullable|string',
        ]);

        ErrorTracking::create($request->all());

        return redirect()->route('error_trackings.index')->with('success', 'Error tracking record created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ErrorTracking $errorTracking)
    {
        return view('error_trackings.show', compact('errorTracking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ErrorTracking $errorTracking)
    {
        $developers = User::where('role', 'user')->get(); // Fetch users with role 'user'
        $projects = Project::all(); // Fetch all projects

        return view('error_trackings.edit', compact('errorTracking', 'developers', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ErrorTracking $errorTracking)
    {
        $request->validate([
            'developer_id' => 'required|exists:users,id',
            'project_id' => 'required|exists:projects,id',
            'date' => 'required|date',
            'error_type' => 'required|string|max:255',
            'solution_description' => 'required|string',
            'solution_provided_by' => 'required|string|max:255',
            'status' => 'required|string|max:50',
            'comments' => 'nullable|string',
        ]);

        $errorTracking->update($request->all());

        return redirect()->route('error_trackings.index')->with('success', 'Error tracking record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ErrorTracking $errorTracking)
    {
        $errorTracking->delete();

        return redirect()->route('error_trackings.index')->with('success', 'Error tracking record deleted successfully.');
    }
}