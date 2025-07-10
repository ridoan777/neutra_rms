<?php

namespace App\Http\Controllers;

use App\Models\Party;
use Nnjeim\World\Models\Country;
use Nnjeim\World\Models\State;

use Illuminate\Http\Request;

class PartyController extends Controller
{
	public function index(){
		
		$party = Party::all();
		// $doctorData = Doctor::paginate(5);
		
		return view('components.sidebars.party', compact('party'));
	}
	// ------------- Select2 Package ---------------
	public function get_country(Request $request){
		
		$countries =[];
		if($search=$request->name){
			$countries =Country::where('name', 'LIKE', '%'.$search.'%')->get();
		}
		return response()->json([
			'results' => $countries->map(function($country){
				return[
					'id' => $country->id,
					'text' => $country->name
				];
			})
		]);
	}
	// -------------
	public function get_state($id)
	{
		 $states = State::where('country_id', $id)->get();
	
		return response()->json(
			$states->map(function($state) {
				return [
						'id' => $state->id,
						'text' => $state->name
				];
			})
		);
	}
	
	// -------------- Select2 Package ---------------
	public function create(Request $request){
		// dd($request);
		$validated = $request->validate([
			'name' => 'required|string|max:255',
			'country' => 'nullable|exists:countries,id',
			'state' => 'nullable|exists:states,id',
			'address' => 'nullable|string|max:255',
			'openingBal' => 'nullable|numeric',
			'currentBal' => 'nullable|numeric',
			'user' => 'required|string|max:255',
			// 'updator' => 'required|string|max:255',
			'type' => 'required|in:supplier,customer,employee,admin,service,other',
			'description' => 'nullable|string|max:255',
			'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:2048',
	  ]);
	  		/* image */ 
	  	if ($request->hasFile('image')) {
			$image = $request->file('image');

			$originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
			$sanitized = preg_replace('/\s+/', '_', $originalName);
			$trimmedName = substr($sanitized, 0, 6);
	  
			$imageName = substr($validated['name'], 0, 6) . '.' . $trimmedName . '_' . substr(time(), -4) . '.' . $image->getClientOriginalExtension(); //naming for PC file

			// $image->storeAs('partyPics', $imageName, 'public');
			$imagePath = 'storage/partyPics/' . $imageName;

			$validated['image'] = $imagePath;
		}

			/* party id */
		$firstWord = strtok($validated['name'], ' ');
		$countryShort = Country::where('id', $validated['country'])->value('iso2');
		$ptr_id = substr($firstWord, 0, 6) . '_' . $countryShort . '_' . substr(time(), -4);

			/* dropdown search */
		if($validated['country'] || $validated['state']){
			$country = Country::where('id', $validated['country'])->value('name');
			$state = State::where('id', $validated['state'])->value('name');
		}
		
		Party::create([
			'prt_id' => $ptr_id,
			'name' => $validated['name'],
			'country' => $country, // Store country name as a string
			'state' => $state,    // Store state names as an array
			'address' => $validated['address'],
			'openingBal' => $validated['openingBal'] ?? 0.00,
			'currentBal' => $validated['currentBal'] ?? 0.00,
			'user' => $validated['user'],
			'updator' => null,
			'type' => $validated['type'],
			'description' => $validated['description'],
			'image' => $validated['image'] ?? null,
	  ]);

	  	$image->storeAs('partyPics', $imageName, 'public');
	  	// $validated['image'] = 'projects/public/partyPics/' . $imageName;
		
		return redirect()->route('party')->with('success', 'Party created successfully!');
	}
	// -------------
	public function editParty(Request $request, $prt_id){

		// dd($request);
		$validated = $request->validate([
			'name' => 'required|string|max:255',
			'country' => 'nullable|exists:countries,id',
			'state' => 'nullable|exists:states,id',
			'address' => 'nullable|string|max:255',
			'openingBal' => 'nullable|numeric',
			'currentBal' => 'nullable|numeric',
			'updator' => 'required|string|max:255',
			'type' => 'required|in:supplier,customer,employee,admin,service,other',
			'description' => 'nullable|string|max:255',
			'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:2048',
	  ]);

		/* image */ 
		$image = null;
		if ($request->image != null) {
			$image = $request->file('image');

			$originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
			$sanitized = preg_replace('/\s+/', '_', $originalName);
			$trimmedName = substr($sanitized, 0, 6);
		
			$imageName = substr($validated['name'], 0, 6) . '.' . $trimmedName . '_' . substr(time(), -4) . '.' . $image->getClientOriginalExtension(); //naming for PC file

			// ---- then delete the existing file
			$existingImage = Party::where('prt_id', $prt_id)->value('image');
			if ($existingImage && file_exists(public_path($existingImage))) {
				unlink(public_path($existingImage));
			}

			// $image->storeAs('partyPics', $imageName, 'public');
			$imagePath = 'storage/partyPics/' . $imageName;

			$validated['image'] = $imagePath;
		}

	  	/* dropdown search */
		  $country = null;
		  $state = null;
		if(isset($validated['country']) || isset($validated['state'])){
			$country = Country::where('id', $validated['country'])->value('name');
			$state = State::where('id', $validated['state'])->value('name');
		}

		$creator = Party::where('prt_id', $prt_id)->value('user');
		
		Party::where('prt_id', $prt_id)->update([
			'name' => $validated['name'],
			'country' => $country, // Store country name as a string
			'state' => $state,    // Store state names as an array
			'address' => $validated['address'],
			'openingBal' => $validated['openingBal'] ?? 0.00,
			'currentBal' => $validated['currentBal'] ?? 0.00,
			'user' => $creator,
			'updator' => $validated['updator'],
			'type' => $validated['type'],
			'description' => $validated['description'],
			'image' => $validated['image'] ?? null,
	  ]);

		if($image != null){
			$image->storeAs('partyPics', $imageName, 'public');
		}

	  	return redirect()->route('party')->with('success', 'Party updated successfully!');
	}
	// -------------
	public function deleteParty($prt_id)
	{
		$party = Party::where('prt_id', $prt_id)->first();

		if (!$party) {
			return redirect()->route('party')->with('error', 'Party not found.');
		}
		// Delete image if exists
		if ($party->image) {
			// Remove 'storage/' from the beginning of the path
			$relativePath = str_replace('storage/', '', $party->image);

			$fullImagePath = storage_path('app/public/' . $relativePath);

			if (file_exists($fullImagePath)) {
					unlink($fullImagePath);
			}
		}

		// Delete the party record
		$party->delete();

		return redirect()->route('party')->with('success', 'Party deleted successfully!');
	}
	// -------------
}
