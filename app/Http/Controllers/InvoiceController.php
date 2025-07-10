<?/*php

namespace App\Http\Controllers;

use App\Models\Allitems;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
	public function invoice(){

		$showInvoice = Allitems::get();
		$dropdownData = User::all();

		return view('components.projects.invoice', [
			'dropdownData' => $dropdownData, 
			'showInvoice'=> $showInvoice
		]);
	}
	// ---------------------------------
	public function create(Request $request){

		$validated = $request->validate([
			'date_made' => 'required|date',
			'date_due' => 'required|date',
			'ref_id' => 'required|string|max:255',
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
			'items.*.description' => 'required|string',
			'items.*.quantity' => 'required|numeric|min:1',
			'items.*.rate' => 'required|numeric|min:0',
			'items.*.total' => 'required|numeric|min:0',
		]);

			// Create the invoice record in Allitems
		$allitems = Allitems::create([
			'date_made' => $validated['date_made'],
			'date_due' => $validated['date_due'],
			'ref_id' => $validated['ref_id'],
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

			// Loop through the validated items and create Invoice records
		foreach ($validated['items'] as $item) {
			Invoice::create([
					'record_id' => $allitems->id,
					'description' => $item['description'],
					'quantity' => $item['quantity'],
					'rate' => $item['rate'],
					'total' => $item['total'],
			]);
		}

		// return redirect()->route('invoice')->with('success', 'Invoice created successfully!');
	}
	// ---------------------------------
}
