<?php

namespace App\Http\Controllers;

use App\Models\AllRecords;
use App\Models\Project;
use App\Models\Record;
use App\Models\RecordItems;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Session;


class RecordController extends Controller
{

	public function singleRecord(Request $request, $r_id)
	{
		$recordHead = AllRecords::where('r_id', $r_id)->first();
		$fetchProjectDetails = Project::where('id', $recordHead->p_id)->first();
		$recordData = RecordItems::where('r_id', $recordHead->r_id)->orderBy('id', 'ASC')->get();

		return view('components.records.singleRecord', [
			'fetchProjectDetails' => $fetchProjectDetails,
			'recordHead' => $recordHead,
			'recordData' => $recordData,
		]);
	}
	// ---------------------------------
	public function makeRecord(Request $request, $id)
	{	
		$validated = $request->validate([
			'date_made' => 'required|date',
			'date_due' => 'required|date',
			'ref' => 'required|string|max:255',
			'user' => 'required|string|max:255',
			'p_id' => 'nullable|string|max:255',
			'method' => 'nullable|string|max:255',
			'type' => 'nullable|string|max:255',
			'from' => 'nullable|string|max:255',
			'to' => 'nullable|string|max:255',
			'ship' => 'nullable|string|max:255',
			'note' => 'nullable|string',
			'terms' => 'nullable|string',
			'total' => 'required|numeric',
			'tax' => 'nullable|numeric',
			'discount' => 'nullable|numeric',
			'paid' => 'nullable|numeric',
			'dues' => 'nullable|numeric',
			'items' => 'required|array',
			// 'items.*.item_id' => 'required|string',
			'items.*.particular' => 'required|string',
			'items.*.quantity' => 'required|numeric|min:1',
			'items.*.rate' => 'required|numeric|min:0',
			'items.*.total' => 'required|numeric|min:0',
		]);
		$r_id = substr(Project::where('id', $id)->value('name'), 0, 4).'_'. Substr($validated['items'][0]['particular'], 0, 4). '_' . substr(time(), -4);

		// Create the record as Record_Heads
		$recordHead = AllRecords::create([
			'date_made' => $validated['date_made'],
			'date_due' => $validated['date_due'],
			'r_id' => $r_id,
			'ref' => $validated['ref'],
			'user' => $validated['user'],
			'p_id' => $validated['p_id'] ?? null,
			'method' => $validated['method'] ?? null,
			'type' => $validated['type'] ?? null,
			'from' => $validated['from'] ?? null,
			'to' => $validated['to'] ?? null,
			'ship' => $validated['ship'] ?? null,
			'note' => $validated['note'] ?? null,
			'terms' => $validated['terms'] ?? null,
			'total' => $validated['total'],
			'tax' => $validated['tax'] ?? 0,
			'discount' => $validated['discount'] ?? 0,
			'paid' => $validated['paid'] ?? 0,
			'dues' => $validated['dues'] ?? 0,
		]);

		// Loop through the validated items and create records as Record_Items
		foreach ($validated['items'] as $index => $item) {
			$recordItem = RecordItems::create([
				'r_id' => $r_id,
				'item_id' => $index+1 . '-' . $r_id,
				'particular' => $item['particular'],
				'quantity' => $item['quantity'],
				'rate' => $item['rate'],
				'total' => $item['total'],
			]);
		}

		if ($recordItem) {
			Session::flash('Success', 'Added New Record Successfully!');
			return redirect()->route('singleProject', $id);
		} else {
			Session::flash('error', ' Opps! Operation Failed.');
			return redirect()->route('singleProject', $id);
		}

		// return redirect()->route('singleProject', $id)->with('success', 'Record created successfully!');
	}
	// ---------------------------------
	public function editRecord($rid)
	{
		$recordHead = AllRecords::where('r_id', $rid)->first();
		// $fetchProjectDetails = Project::where('id', $recordHead->p_id)->first();
		$recordData = RecordItems::where('r_id', $rid)->get(); //Record::p_id is actually Project::id

		return view('components.records.editRecord', 
			compact('recordHead', 'recordData')
		);
	}
	// ---------------------------------
	public function updateRecord(Request $request, $r_id)
	{	
		$items = array_values(array_filter($request->input('items'), function($item) {
			return !empty($item['particular']);
	  	}));

		$validated = $request->validate([
			'date_made' => 'required|date',
			'date_due' => 'required|date',
			'ref' => 'required|string|max:255',
			'user' => 'required|string|max:255',
			// 'p_id' => 'nullable|string|max:255',
			'method' => 'nullable|string|max:255',
			'type' => 'nullable|string|max:255',
			'from' => 'nullable|string|max:255',
			'to' => 'nullable|string|max:255',
			'ship' => 'nullable|string|max:255',
			'note' => 'nullable|string',
			'terms' => 'nullable|string',
			'total' => 'required|numeric',
			'tax' => 'nullable|numeric',
			'discount' => 'nullable|numeric',
			'paid' => 'nullable|numeric',
			'dues' => 'nullable|numeric',
			'items' => 'required|array',
			// 'items.*.item_id' => 'required|string',
			'items.*.particular' => 'required|string',
			'items.*.quantity' => 'required|numeric',
			'items.*.rate' => 'required|numeric',
			'items.*.total' => 'required|numeric',
		]);

		// Update the record as Record_Heads
		$recordHead = AllRecords::where('r_id', $r_id)->update([
			'date_made' => $validated['date_made'],
			'date_due' => $validated['date_due'],
			// 'r_id' => $r_id,
			'ref' => $validated['ref'],
			'user' => $validated['user'],
			// 'p_id' => $validated['p_id'] ?? null,
			'method' => $validated['method'] ?? null,
			'type' => $validated['type'] ?? null,
			'from' => $validated['from'] ?? null,
			'to' => $validated['to'] ?? null,
			'ship' => $validated['ship'] ?? null,
			'note' => $validated['note'] ?? null,
			'terms' => $validated['terms'] ?? null,
			'total' => $validated['total'],
			'tax' => $validated['tax'] ?? 0,
			'discount' => $validated['discount'] ?? 0,
			'paid' => $validated['paid'] ?? 0,
			'dues' => $validated['dues'] ?? 0,
		]);
		
		$formItems = [];
		foreach ($validated['items'] as $index => $item) {
			$formItems[] = [
			'item_id' => $index+1 . '-' . $r_id,
			'particular' => $item['particular'],
			'quantity' => $item['quantity'],
			'rate' => $item['rate'],
			'total' => $item['total'],
			];
		}
		
		$dbItems = RecordItems::where('r_id', $r_id)->orderBy('item_id', 'ASC')->get();
		$countFormItems = count($formItems);
		$countdbItems = $dbItems->count();
		
		$deleteAble = [];
		$count=1;

		switch(true){

			case($countFormItems == $countdbItems):

				foreach($formItems as $index => $item){

					if(isset($dbItems[$index]->item_id) && $item['item_id'] == $dbItems[$index]->item_id){
						$dbItems[$index]->update([
							'particular' => $item['particular'],
							'item_id' => $index+1 . '-' . $r_id,
							'quantity' => $item['quantity'],
							'rate' => $item['rate'],
							'total' => $item['total'],
						]);
					}
					else{
						// dd( $item['item_id'], $dbItems[$index]->item_id, "for Equal & this row needs to be created");
						Session::flash('Error!', 'One of the item\'s id does not match with the database\'s!');
						return back();
						
					}
				}
				break;

			case($countFormItems > $countdbItems):

				foreach($formItems as $index => $item){

					if(isset($dbItems[$index]->item_id) && $item['item_id'] == $dbItems[$index]->item_id){
						RecordItems::where('item_id', $item['item_id'])->update([
							'particular' => $item['particular'],
							'item_id' => $index+1 . '-' . $r_id,
							'quantity' => $item['quantity'],
							'rate' => $item['rate'],
							'total' => $item['total'],
						]);
					}
					else{
						$recordItem = RecordItems::create([
							'r_id' => $r_id,
							'item_id' => $index+1 . '-' . $r_id,
							'particular' => $item['particular'],
							'quantity' => $item['quantity'],
							'rate' => $item['rate'],
							'total' => $item['total'],
						]);
					}
				}
				break;

			default:{
				
				foreach($dbItems as $index => $item){
					if(isset($formItems[$index])){
						$item->update([
							'particular' => $formItems[$index]['particular'],
							'item_id' => $index+1 . '-' . $r_id,
							'quantity' => $formItems[$index]['quantity'],
							'rate' => $formItems[$index]['rate'],
							'total' => $formItems[$index]['total'],
						]);
						continue;
					}
					else{
						$deleteAble[] = $item;
						continue;
					}
				}
			}
		}
		foreach ($deleteAble as $item) {
			$item->delete();
		}

		// return response()->json(['message' => 'Record items updated successfully']);

		// if ($recordItem) {
		// 	Session::flash('Success', 'Added New Record Successfully!');
		// 	return redirect()->route('singleProject', $id);
		// } else {
		// 	Session::flash('error', ' Opps! Operation Failed.');
		// 	return redirect()->route('singleProject', $id);
		// }
		return redirect()->route('singleRecord', $r_id)->with('success', 'Record Updated Successfully!');
	}
	// ---------------------------------
	public function deleteRecord($rid)
	{
		$fetchPID = AllRecords::where('r_id', $rid)->first()->p_id;
		AllRecords::where('r_id', $rid)->delete();
		
		return redirect()->route('singleProject', $fetchPID);
	}
	// ---------------------------------
	public function makePdf($id)
	{
		$singleRecord = Record::where('id', $id)->first();
		$fetchProjectDetails = Project::where('id', $singleRecord->p_id)->first();

		view()->share([
			'singleRecord' => $singleRecord,
			'fetchProjectDetails' => $fetchProjectDetails
		]);
		// $pdf = Pdf::loadView('pdfDownload');
		// $pdf = Pdf::loadView('components.records.singleRecord', 
		$pdf = Pdf::loadView(
			'pdf/record_pdf',
			[
				'singleRecord' => $singleRecord,
				'fetchProjectDetails' => $fetchProjectDetails,
			]
		);
		$pdf->setPaper('A4', 'portrait');
		// $pdf->render(); // Render the HTML as PDF

		return $pdf->download('neutra_ai.pdf');
	}
	// ---------------------------------
	public function pdfDownload()
	{
		$singleRecord = Record::where('id', 6)->first();
		$fetchProjectDetails = Project::where('id', $singleRecord->p_id)->first();

		view()->share([
			'singleRecord' => $singleRecord,
			'fetchProjectDetails' => $fetchProjectDetails
		]);
		return view('pdfDownload');
	}
}
