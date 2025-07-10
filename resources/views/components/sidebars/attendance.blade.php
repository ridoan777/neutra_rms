<x-layouts.master>
	<h1 class="mb-2 text-5xl text-center text-red-900">Attendance</h1>
	<div class="w-full flex justify-end">
		<a href="{{ route('attendance.report') }}" type="submit" class="invoice-button bg-blue-400 hover:bg-green-800 flex-xy-center">
			&nbsp;Report
		</a>
	</div>
	<!-- error and success message display -->
	<x-alert-component/>
	<!-- error and success message display ends -->
	 
	<!-- ------------------- -->
	<section id="showTableArea">

		<div class="relative overflow-x-auto shadow-md sm:rounded-lg">

			<form action="{{ route('attendance.create') }}" method="POST">
        		@csrf
			
		  <!--  -->
		  <div class="w-full flex justify-between">
				<div class="w-1/3 p-2 mb-4">
						<label for="date" class="block font-semibold mb-1">Date:</label>
						<input type="date" id="date" name="date" class="border p-2 w-1/2" required>
				</div>
				<!--  -->
				<div>
					<button type="submit" class="invoice-button bg-green-600 hover:bg-green-800 flex-xy-center">
						&nbsp;Save Attendance
					</button>
				</div>
			</div>
		  <!--  -->
			<table id="attendanceTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 overflow-x-auto">
				<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
					<tr class="w-full grid grid-cols-12 text-center">
						<th scope="col" class="col-span-1 px-2 py-2">
							SN
						</th>
						<th scope="col" class="col-span-1 px-2 py-2">
							Image
						</th>
						<th scope="col" class="col-span-2 px-2 py-2">
							Name
						</th>
						<th scope="col" class="col-span-1 px-2 py-2">
							Role
						</th>
						<th scope="col" class="col-span-2 px-2 py-2">
							Staff ID
						</th>
						<th scope="col" class="col-span-3 px-2 py-2">
							Status
						</th>
						<th scope="col" class="col-span-2 px-2 py-2">
							Attendee
						</th>
					</tr>
				</thead>
				<!--  -->
				<tbody class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
					@foreach($staffs as $index => $item)
					<tr class="w-full grid grid-cols-12 text-center bg-white border-b border-gray-200 hover:bg-gray-50 cursor-pointer">
						<td scope="col" class="col-span-1 px-2 py-2">
							{{ $index+1}}
						</td>
						<td scope="col" class="col-span-1 px-2 py-2">
							@if(empty($item->image))
								<div class="w-12 h-12 rounded-full bg-green-700 overflow-hidden text-wrap text-center text-xs text-gray-200 flex-xy-center">
									No Image
								</div>
							@else
								<img src="{{ asset($item->image) }}" alt="project_image" class="w-12 h-12 rounded-full">
							@endif
						</td>
						<td scope="col" class="col-span-2 px-2 py-2">
							{{ $item->name }}
						</th>
						<td scope="col" class="col-span-1 px-2 py-2">
							{{ $item->type }}
						</th>
						<td scope="col" class="col-span-2 px-2 py-2">
							{{ $item->prt_id }}
							<input type="hidden" name="status[{{ $index }}][prt_id]" value="{{ $item->prt_id }}">
						</th>
						<td scope="col" class="col-span-3 px-2 py-2">

							<select name="status[{{ $index }}][status]" class="w-1/2 mx-auto text-center p-1 rounded bg-purple-400 cursor-pointer focus:border-0">
								<option value="present" selected>Present</option>
								<option value="late">Late</option>
								<option value="absent">Absent</option>
								<option value="leave">Leave</option>
							</select>

						</th>
						<td scope="col" class="col-span-2 px-2 py-2">
							{{ Auth::user()->name }}
							<input type="hidden" name="user" value="{{ Auth::user()->name }}">
						</th>
					</tr>
					@endforeach
				</tbody>
				<!--  -->
			</table>
			</form>
			

		</div>

	</section>

	<style>
		#attendanceTable tbody tr td{
			display: grid;
			align-items: center;
		}
	</style>
	
</x-layouts.master>