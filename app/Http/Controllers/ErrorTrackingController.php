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
        // Check the role of the authenticated user
        if (auth()->user()->role === 'admin') {
            // If the user is an admin, fetch all error tracking records
            $errorTrackings = ErrorTracking::with(['developer', 'project'])
                ->orderBy('id', 'desc')
                ->paginate(10);

            // Fetch all developers with role 'user'
            $developers = User::where('role', 'user')->get();

            // Set the default developer for the admin to null (no selection)
            $defaultDeveloperId = null;
        } else {
            // If the user is not an admin, fetch only their error tracking records
            $errorTrackings = ErrorTracking::with(['developer', 'project'])
                ->where('developer_id', auth()->id())
                ->orderBy('id', 'desc')
                ->paginate(10);

            // Fetch only the authenticated user
            $developers = User::where('id', auth()->id())->get();

            // Default developer ID is the authenticated user
            $defaultDeveloperId = auth()->id();
        }

        // Fetch all projects
        $projects = Project::all();

        // Return the view with the data
        return view('error_trackings.index', compact('errorTrackings', 'developers', 'projects', 'defaultDeveloperId'));
    }


    /**
     * store method.
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
     * show method.
     */

    public function show(ErrorTracking $errorTracking)
    {
        return response()->json($errorTracking->load(['developer', 'project']));
    }



    /**
     * edit method.
     */
    public function edit(ErrorTracking $errorTracking)
    {
        return response()->json($errorTracking->load(['developer', 'project']));
    }


    /**
     * update method.
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
