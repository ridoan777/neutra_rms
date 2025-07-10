<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Party;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
	public function index()
	{
		$staffs = Party::whereIn('type', ['employee', 'admin'])->get();
		
		return view('components.sidebars.attendance', compact('staffs'));
	}
	// ---------------------
   public function report()
	{
		$attendances = Attendance::all();

		return view('components.sidebars.attendanceReport', compact('attendances'));
	}
	// ---------------------
	public function create(Request $request)
	{
		$validated = $request->validate([
			'date' => 'required|date',
			'status' => 'required|array',
			'status.*.prt_id' => 'required|exists:parties,prt_id',
			'status.*.status' => 'required|in:present,late,absent,leave',
			'user' => 'required',
		]);

		foreach ($validated['status'] as $item) {
			$name = Party::where('prt_id', $item['prt_id'])->value('name');
			Attendance::create([
				'date' => $validated['date'],
				'prt_id' => $item['prt_id'],
				'name' => $name,
				'status' => $item['status'],
				'attendee' => $validated['user'],
			]);
		}

		return redirect()->back()->with('success', 'Attendance recorded successfully.');
	}
	// -----------------------
	public function show(Request $request)
	{
		 return view('attendance.show');
	}

	public function fetch(Request $request)
	{
		 $query = Attendance::with('party');

		 if ($request->filled('date')) {
			  $query->whereDate('date', $request->date);
		 }

		 $attendances = $query->get()->map(function ($attendance) {
			  return [
					'prt_id' => $attendance->prt_id,
					'name' => $attendance->name,
					'status' => $attendance->status,
					'attendee' => $attendance->attendee,
					'date' => $attendance->date,
					'party' => [
						 'image' => $attendance->party ? asset($attendance->party->image) : null,
						 'type' => $attendance->party->type ?? null,
					],
			  ];
		 });

		 return response()->json(['attendances' => $attendances]);
	}
}
