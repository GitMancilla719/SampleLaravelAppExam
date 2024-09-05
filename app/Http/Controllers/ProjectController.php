<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectController extends Controller {
    public function get() {
        $projects = Project::with('tasks')->get();

        return Inertia::render('Projects', ["projects" => $projects]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        Project::create($request->only('name', 'description'));

        return redirect()->route('projects.get')->with('success', 'Project created successfully!');
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $project = Project::findOrFail($id);
        $project->update($request->only('name', 'description'));

        return redirect()->route('projects.get')->with('success', 'Project updated successfully!');
    }

    public function destroy($id) {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('projects.get')->with('success', 'Project deleted successfully!');
    }
}
