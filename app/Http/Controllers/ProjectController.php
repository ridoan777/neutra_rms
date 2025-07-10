<?php

namespace App\Http\Controllers;

use App\Models\AllRecords;
use App\Models\Project;
use App\Models\Record;
use App\Models\RecordItems;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function project()
	{
		$projectData = Project::get();
		$dropdownData = User::all();

		return view('components.projects.projects', [
			'dropdownData' => $dropdownData,
			'projectData' => $projectData
		]);
	}
	// --------------------------------
	public function invoice()
	{
		return view('components.projects.invoice');
	}
	// ---------------------------------
	public function makeProject(Request $request)
	{
		// dd("dumped here"); 
		$validated = $request->validate([
			'name' => 'required|string|max:255',
			'p_id' => 'nullable|string|min:2|max:6|unique:projects',
			'status' => 'nullable|in:running,completed,cancelled,halted',
			'party' => 'nullable',
			'user' => 'required',
			'updater' => 'nullable|string|max:255',
			'description' => 'nullable|string|max:255',
			'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
		]);

		if ($request->hasFile('image')) {
			$image = $request->file('image');
			$imageName = time() . '.' . $image->getClientOriginalExtension(); //naming for PC file

			$image->move(public_path('projects'), $imageName); //raw php code. No symbolic link needed.
			// $image->storeAs('projectPics', $imageName, 'public'); //laravel code. Symbolic link needed.

			$validated['image'] = 'projects/' . $imageName; //naming for database
		}

		Project::create($validated);

		return redirect()->route('project')->with('success', 'Project created successfully!');
	}
	// ---------------------------------
	public function singleProject($id)
	{
		$showProject = Project::findOrFail($id);
		$partyName = User::findOrFail($showProject->party);
		
		$recordHead = AllRecords::where('p_id', $id)->orderBy('date_made', 'DESC')->get();
		if($recordHead->isNotEmpty())
		{
			$recordIds = $recordHead->pluck('r_id');
			$recordData = RecordItems::whereIn('r_id', $recordIds)->orderBy('id', 'ASC')->get();
			return view('components.projects.singleProject', 
				compact('showProject', 'partyName', 'recordHead', 'recordData')
			);
		}
		else{
			return view('components.projects.singleProject', [
				'showProject' => $showProject,
				'partyName' => $partyName,
			]);
		}

	}
	// ---------------------------------
	public function editProject(Request $request, $id)
	{
		$fetchEditData = Project::findOrFail($id);

		$validated = $request->validate([
			'name' => 'required|string|max:255',
			'p_id' => 'nullable|string|min:2|max:6',
			'status' => 'nullable|in:running,completed,cancelled,halted',
			'party' => 'nullable',
			'updated_by' => 'required|string|max:255',
			'description' => 'nullable|string|max:255',
			'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
		]);

		$fetchEditData->updater = $validated['updated_by'];

		if ($request->hasFile('image')) {

			if ($fetchEditData->image && file_exists(public_path($fetchEditData->image))) {
				unlink(public_path($fetchEditData->image));
			}

			$newImage = $request->file('image');
			$imageName = time() . '.' . $newImage->getClientOriginalExtension();

			$newImage->move(public_path('projects'), $imageName);

			$validated['image'] = 'projects/' . $imageName;
		}

		$fetchEditData->update($validated);

		return redirect()->route('project')->with('success', 'Project updated successfully!');
	}
	// ---------------------------------
	public function deleteProjectImg($id)
	{

		$deleteProjectImg = Project::where('id', $id)->firstOrFail();

		if ($deleteProjectImg->image && file_exists(public_path($deleteProjectImg->image))) {
			unlink(public_path($deleteProjectImg->image));
		}

		$deleteProjectImg->image = null;
		$deleteProjectImg->save();

		return redirect()->route('project')->with('success', 'Image deleted successfully!');
	}
	// ---------------------------------
	public function deleteProject(string $id)
	{
		$deleteProject = Project::where('id', $id)->firstOrFail();

		if ($deleteProject->image && file_exists(public_path($deleteProject->image))) {
			unlink(public_path($deleteProject->image));
		}

		$deleteProject->delete();

		return redirect()->route('project')->with('success', 'Project deleted successfully!');
	}
}
