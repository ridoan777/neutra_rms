<x-layouts.master>

<!-- error and success message display -->
	<div>
		<!-- Success message display -->
		@if(session('success'))
		<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
			<strong class="font-bold text-center">Success!</strong>
			<span class="block sm:inline text-right">{{ session('success') }}</span>
		</div>
		@endif
		<!-- Success message display ends -->
		<!-- validation error display -->
		@if($errors->any())
			<ul>
				<li class="text-blue-500"><b>Record Creation Error/s:</b></li>
				@foreach ($errors->all() as $error)
				<li class="text-red-500">{{ $error }}</li>
				@endforeach
			</ul>
		@endif
		<!-- validation error display ends -->

	</div>
<!-- error and success message display ends -->


<!-- Top Buttons -->
	<div class="flex flex-j-between">
		<button onclick="window.location.href=`{{ route('project') }}`;" class="flex flex-j-end invoice-button bg-gray-700 hover:bg-gray-900">
			<svg class="w-6 h-6 text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
				<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
			</svg>Go Back
		</button>
		<!--  -->
		<button data-modal-target="createRecordModal" data-modal-toggle="createRecordModal" class="invoice-button bg-blue-700 hover:bg-blue-900" type="button"> Create Record
		</button>
	</div>
<!--  -->
	
<!---------------- Main Table Starts ---------------->
<h3 class="text-center text-blue-900 uppercase dark:text-zinc-300">Records</h3>

<div class="grid grid-cols-12 gap-4 relative overflow-x-auto ">

	<!--------------- Lift Side Record Form --------------->
	<section id="leftProjectShow" class="col-span-3 p-2 bg-violet-200 rounded-lg flex flex-col">

		@if(empty($showInvoice->image))
			<img src="{{ asset('asset/images/app_image') }}/No_image_added.png" alt="no_image_added" class="w-full">
		@else
			<img src="{{ asset($showInvoice->image) }}" alt="project_image" class="w-full">
		@endif

		<div class="my-2 flex flex-y-center">
			<p>Project :&nbsp;</p>
			<h4 class="text-blue-900">{{ $showInvoice->name }}</h4>
		</div>
		<div class="my-2 flex flex-y-center">
			<p>PID :&nbsp;</p>
			<h4 class="text-blue-900">{{ $showInvoice->p_id }}</h4>
		</div>
		<div class="my-2 flex flex-y-center">
			<p>Party :&nbsp;</p>
			<h5 class="">{{ $partyName->name }}</h5>
		</div>
		<div class="my-2">
			<p>Description :</p>
			<p class="text-gray-400 whitespace-pre-wrap">{{ $showInvoice->description }}</p>
		</div>
		<div class="my-2 flex flex-y-center">
			<p>Created by :&nbsp;</p>
			<p class="italic">{{ $showInvoice->user }}</p>
		</div>
		<div class="my-2 flex flex-y-center">
			<p>Created at :&nbsp;</p>
			<p class="italic text-sm text-gray-500">{{ $showInvoice->created_at->format('d M \'y \\a\\t g:i A') }}</p>
		</div>
		<div class="my-2 flex flex-y-center">
			<p>Last Updated by :&nbsp;</p>
			<p class="text-gray-400">{{ $showInvoice->updater }}</p>
		</div>
		<div class="my-2 flex flex-y-center">
			<p>Last Updated at :&nbsp;</p>
			<p class="italic text-sm text-gray-500">{{ $showInvoice->updated_at->format('d M \'y \\a\\t g:i A') }}</p>
		</div>
		

	</section>
	<!--------------- Right Side Record Form --------------->
	<section id="rightProjectShow" class="col-span-9 p-2 bg-green-100 sm:rounded-lg">

		<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">

			<thead class="text-xs text-gray-300 uppercase bg-invoice-navy">
				<tr>
					<!-- <th scope="col" class="p-4">
						<div class="flex items-center">
							<input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
							<label for="checkbox-all-search" class="sr-only">checkbox</label>
						</div>
					</th> -->
					<th scope="col" class="px-1 py-2 text-center">
						SN
					</th>
					<th scope="col" class="px-6 py-2 text-center">
						Dates
					</th>
					<th scope="col" class="px-6 py-2 text-center">
						REF
					</th>
					<th scope="col" class="px-6 py-2 text-center">
						Particular
					</th>
					<th scope="col" class="px-6 py-2 text-center">
						Total & Dues
					</th>
					<th scope="col" class="px-6 py-2 text-center">
						Type
					</th>
					<th scope="col" class="px-6 py-2 text-center">
						Status
					</th>
					<th scope="col" class="px-6 py-2 text-center">
						Notes
					</th>
				</tr>
			</thead>
			<!---->
			<tbody>
				@foreach($allRecord as $allRecordValue)
				<tr class="bg-white border-b border-gray-200 hover:bg-gray-50 cursor-pointer" onclick="window.location.href=`{{ route('singleRecord', $allRecordValue->id) }}`;">
					
					<td class="w-4 px-2 py-3">
						<div class="flex flex-xy-center">
							<label for="checkbox-table-search-1" class="text-black">{{ $loop->iteration }}</label>
						</div>
					</td>
					<!--  -->
					<th scope="row" class="flex-col items-center px-1 py-1 text-gray-900 whitespace-nowrap">
						<div class="text-xs fw-200">{{ date('d-M-Y', strtotime($allRecordValue->date_made)) }}</div>
						<div class="text-xs text-wrap fw-200 text-gray-500">Due:{{ date('d-M-y', strtotime($allRecordValue->date_due)) }}</div>
					</th>
					<!--  -->
					<td class="px-2 py-1 text-center">
					{{ $allRecordValue->ref_id }}
					</td>
					<!--  -->
					<td class="px-2 py-1 text-center">
						<p>{{ \Illuminate\Support\Str::limit($allRecordValue->item_1, 24, $end='...') }}</p>
					</td>
					<!--  -->
					<td class="flex-col flex-xy-center px-2 py-1">
						<p class="font-semibold">&#x9F3; {{ $allRecordValue->total }}</p>
						<p class="text-yellow-400">&#x9F3; {{ $allRecordValue->dues }} dues</p>
					</td>
					<!--  -->
					<td class="w-36 px-1 py-1">
						@php
							if($allRecordValue->type == 'invoice'){
								$typeColor = 'text-teal-500 border-teal-500';
							}
							elseif($allRecordValue->type == 'expense'){
								$typeColor = 'text-orange-500 border-orange-500';
							}
							else{ $typeColor = 'text-green-500 border-green-500';}
						@endphp
							<p class="font-semibold capitalize text-center <?= $typeColor ?> border rounded-lg bg-gray-50">{{ $allRecordValue->type }}</p>
							<!-- <p class="font-semibold capitalize text-center text-orange-400 border border-orange-400 rounded-lg bg-gray-50">{{-- $allRecordValue->type --}}</p> -->
					</td>
					<!--  -->
					<td class="w-32 px-2 py-1">
						<div class="flex items-center">
							@php
								$todayDate = new DateTime('now');
								$date_due = new DateTime($allRecordValue->date_due);
								$dues = $allRecordValue->dues;

								$interval = $todayDate->diff($date_due);
								$remaining_days = (int)$interval->format('%r%a');
								$dueMessage = $remaining_days . " " . "day/s remaining";

									if ($dues > 0 && $remaining_days <= 3 && $remaining_days > 0 ) {
										$textColor = "text-yellow-400 font-semibold";
									}
									elseif($dues > 0 && $remaining_days > 3){
										$textColor = "text-yellow-400";
									}
									elseif($dues > 0 && $remaining_days < 0){
										$textColor = "text-red-400 font-semibold";
										$dueMessage = abs($remaining_days) . " " . "day/s overdue";
									}
									elseif($dues == 0){
										$textColor = "text-green-500 font-semibold";
										$dueMessage = "payment cleared";
									}
									else{
										$textColor = "text-yellow-400 font-semibold";
										$dueMessage = "logic error!";
									}
							@endphp
							<p class="rounded-full text-center text-xs text-wrap {{ $textColor }}">{{ $dueMessage }}</p>
						</div>
					</td>
					<!--  -->
					<td class="w-32 px-2 py-1">
						<div class="flex-col items-center">
							<p class="text-wrap text-justify">{{ \Illuminate\Support\Str::limit($allRecordValue->note, 30, $end='...') }}</p>
						</div>
					</td>
					<!--  -->

				</tr>
				@endforeach
			</tbody>

		</table>

	</section>
	<!--  -->

</div>

<!-- modal -->
<section id="createRecordModalArea">

	<!-- Main modal -->
	<div id="createRecordModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
		<div class="relative p-4 w-4/5 max-h-full">
			<!-- Modal content -->
			<div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
				<!-- Modal header -->
				<div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
					<h3 class="font-semibold text-gray-900">
						Create New Record
					</h3>
					<button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="createRecordModal">
						<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
							<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
						</svg>
						<span class="sr-only">Close modal</span>
					</button>
				</div>

				<!-------Create Modal body ------->
				<form class="p-4 md:p-5" action="{{ route('makeRecord', $showInvoice->id) }}" method="POST">
					@csrf
					<div class="grid gap-4 mb-4 grid-cols-12">
						
						<!------- Row-1 ------->
							<div class="col-span-2">
								<label for="date_made" class="block mb-2 text-sm font-medium">Record Date</label>
								<div class="relative max-w-sm">
									<input id="date_made" datepicker datepicker-format="mm-dd-yyyy" type="date" name="date_made" class="invoice-input text-sm text-black p-2.5">
								</div>
							</div>
							<!--  -->
							<div class="col-span-2">
								<label for="date_due" class="block mb-2 text-sm font-medium">Due Date</label>
								<input id="date_due" datepicker datepicker-format="mm-dd-yyyy" type="date" name="date_due" class="invoice-input text-sm text-black w-full p-2.5">
							</div>
							<!--  -->
							<div class="col-span-2">
								<label for="ref_id" class="block mb-2 text-sm font-medium text-gray-900">Reference</label>
								<input type="text" name="ref_id" id="ref_id" class="invoice-input" placeholder="64 characters max">
							</div>
							<!--  -->
							<div class="col-span-6 sm:col-span-3">
								<label for="method" class="block mb-2 text-sm font-medium text-gray-900">Payment Term</label>
								<input type="text" name="method" id="method" class="invoice-input" placeholder="Payment Method">
							</div>
							<!--  -->
							<div class="col-span-6 sm:col-span-3">
								<label for="type" class="block mb-2 text-sm font-medium text-gray-900">Type</label>
								<select id="type" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
									<option value="invoice" selected>INVOICE</option>
									<option value="bill">BILL</option>
									<option value="expense">EXPENSE</option>
									<option value="payroll">PAYROLL</option>
									<option value="shares">SHARES</option>
									<option value="other">OTHERS</option>
								</select>
							</div>
						<!------- Row-1 ------->

						<!------- Row-2 ------->
							<div class="col-span-12 sm:col-span-4">
								<input type="text" name="from" id="from" class="invoice-input" placeholder="From">
							</div>
							<!--  -->
							<div class="col-span-12 sm:col-span-4">
								<input type="text" name="to" id="to" class="invoice-input" placeholder="Voucher to">
							</div>
							<!--  -->
							<div class="col-span-12 sm:col-span-4">
								<input type="text" name="ship" id="ship" class="invoice-input" placeholder="Ship to">
							</div>
							<!--  -->
						<!------- Row-2 ------->

						<!------- Row-3.1 ------->
							<div class="col-span-12 grid grid-cols-12 pl-4 pr-1 py-2 bg-invoice-navy text-white text-sm rounded">
								<p class="col-span-7 text-left">Particulars</p>
								<p class="col-span-1 text-center">Quantity</p>
								<p class="col-span-2 text-center">Rate/Unit Price</p>
								<p class="col-span-2 text-center">Amount</p>
							</div>
						<!------- Row-3.2 ------->
							<div class="col-span-7">
								<input type="text" name="item_1" id="item_1" class="invoice-input" placeholder="Set-1 : Description of item/service...">
							</div>
							<!--  -->
							<div class="col-span-1">
								<input type="number" step="0.01" name="qty_1" id="qty_1" class="invoice-input" placeholder="QTY">
							</div>
							<div class="col-span-2">
								<input type="number" step="0.01" id="rate_1" name="rate_1" class="invoice-input" placeholder="Rate">
							</div>
							<div class="col-span-2">
								<b id="amount_1" class="text-blue-600"></b>
							</div>
						<!------- Row-3.2 ------->

						<!------- Row-4 ------->
							<div class="col-span-7">
								<input type="text" name="item_2" id="item_2" class="invoice-input" placeholder="Set-2 : Description of item/service...">
							</div>
							<!--  -->
							<div class="col-span-1">
								<input type="number" step="0.01" name="qty_2" id="qty_2" class="invoice-input" placeholder="QTY">
							</div>
							<div class="col-span-2">
								<input type="number" name="rate_2" step="0.01" id="rate_2" class="invoice-input" placeholder="Rate">
							</div>
							<div class="col-span-2 p-2">
								<b id="amount_2" class="pt-4 text-blue-600"></b>
							</div>
						<!------- Row-4 ------->

						<!------- Row-5 ------->
							<div class="col-span-7">
								<input type="text" name="item_3" id="item_3" class="invoice-input" placeholder="Set-3 : Description of item/service...">
							</div>
							<!--  -->
							<div class="col-span-1">
								<input type="number" step="0.01" name="qty_3" id="qty_3" class="invoice-input" placeholder="QTY">
							</div>
							<div class="col-span-2">
								<input type="number" step="0.01" name="rate_3" id="rate_3" class="invoice-input" placeholder="Rate">
							</div>
							<div class="col-span-2 p-2">
								<b id="amount_3" class="pt-4 text-blue-600"></b>
							</div>
						<!------- Row-5 ------->

						<!------- Row-6, 7, 8, 9, 10, 11 ------->
							<div class="LEFT mt-4 p-2 col-span-7 grid grid-cols-12 bg-green-100 rounded-lg">

								<div class="col-span-12 mb-1">
									<textarea id="note" name="note" rows="2" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="NOTES (max 460 characters)"></textarea>
								</div>
								<!--  -->
								<div class="col-span-12">
									<textarea id="terms" name="terms" rows="2" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Terms & Conditions (max 460 characters)"></textarea>
								</div>
								<!--  -->
								<div class="col-span-12 flex-y-center">
									<label for="user" class="text-nowrap text-sm font-medium text-gray-900">Creating by :</label>
									<input type="text" name="user" id="user" class="mx-2 italic text-gray-500 invoice-input-none " value="{{ Auth::user()->name }}" readonly>

									<label for="p_id" class="text-nowrap text-sm font-medium text-gray-900">Project :</label>
									<input type="text" name="p_id" id="p_id" class="hidden w-8 ml-2 italic invoice-input-none" value="{{ $showInvoice->id }}" readonly>
									<p>&nbsp; {{ $showInvoice->name }}</p>
									

								</div>
								
							</div>
							<!--  -->
							<div class="RIGHT p-2 col-span-5 bg-blue-100 rounded-lg">

								<div class="mb-2 col-span-5 grid grid-cols-5 gap-2">

									<div class="px-2 col-span-3 flex-y-center flex-j-end">
										<label class="font-bold">Total :</label>
									</div>
									<div class="col-span-2 flex">
										<input type="number" step="0.01" name="total" id="total" class="invoice-input" placeholder="Subtotal" value="" readonly>
									</div>

								</div>
								<!--  -->
								<div class="mb-2 col-span-5 grid grid-cols-5 gap-2">

									<div class="px-2 col-span-3 flex-y-center flex-j-end">
										<label class="font-bold">VAT/Tax (%):</label>
									</div>
									<div class="col-span-2 flex">
										<input type="number" step="0.01" name="tax" id="tax" class="invoice-input bg-red-50" placeholder="Tax rate (%)" value="">
									</div>

								</div>
								<!--  -->
								<div class="mb-2 col-span-5 grid grid-cols-5 gap-2">

									<div class="px-2 col-span-3 flex-y-center flex-j-end">
										<label class="font-bold">Discount :</label>
									</div>
									<div class="col-span-2 flex">
										<input type="number" step="0.01" name="discount" id="discount" class="invoice-input bg-red-50" placeholder="total discount" value="">
									</div>

								</div>
								<!--  -->
								<div class="mb-2 col-span-5 grid grid-cols-5 gap-2">

									<div class="px-2 col-span-3 flex-y-center flex-j-end">
										<label class="font-bold">PAID :</label>
									</div>
									<div class="col-span-2 flex">
										<input type="number" step="0.01" name="paid" id="paid" class="invoice-input bg-red-50" placeholder="total paid" value="">
									</div>

								</div>
								<!--  -->
								<div class="mb-2 col-span-5 grid grid-cols-6 gap-2 bg-invoice-navy text-white">

									<div class="px-2 col-span-3 flex-y-center flex-j-end">
										<label class="font-bold">BALANCE DUES :</label>
									</div>
									<div class="col-span-3 flex">
										<input type="number" step="0.01" name="dues" id="dues" class="invoice-input bg-red-50" placeholder="total dues" value="" readonly>
									</div>

								</div>

							</div>
							
						<!------- Row-6, 7, 8, 9, 10, 11  ------->

					</div>
					<button type="submit" class="invoice-button bg-green-500 hover:bg-green-700  flex">
						Add New Record
					</button>
				</form>

			</div>
		</div>
	</div>

</section>

<script>
	document.addEventListener('DOMContentLoaded', function () {
		// Function to calculate amount for a specific set
		function calculateAmount(setNumber) {
				const qtyInput = document.getElementById(`qty_${setNumber}`);
				const rateInput = document.getElementById(`rate_${setNumber}`);
				const amountDisplay = document.getElementById(`amount_${setNumber}`);

				const qty = parseFloat(qtyInput.value) || 0;
				const rate = parseFloat(rateInput.value) || 0;

				const amount = qty * rate;
				amountDisplay.textContent = amount.toFixed(2); // Display amount with 2 decimal places

				updateTotal();
		}

		// Function to update the total input
		function updateTotal() {
		const amount1 = parseFloat(document.getElementById('amount_1').textContent) || 0;
		const amount2 = parseFloat(document.getElementById('amount_2').textContent) || 0;
		const amount3 = parseFloat(document.getElementById('amount_3').textContent) || 0;
		const total = amount1 + amount2 + amount3;

		// Set the total value in the input field
		document.getElementById('total').value = total.toFixed(2);
			dues(total);

	}

		function dues(total){
			// const total = parseFloat(document.getElementById('total').textContent) || 0;
			const tax = parseFloat(document.getElementById('tax').value) || 0;
			const discount = parseFloat(document.getElementById('discount').value) || 0;
			const paid = parseFloat(document.getElementById('paid').value) || 0;

			const taxable = total * (tax/100);

			const dues = total + taxable - discount - paid;

			document.getElementById('dues').value = dues.toFixed(2);

		}
		// Attaching event listeners for each set
		for (let i = 1; i <= 3; i++) {
			document.getElementById(`qty_${i}`).addEventListener('input', () => calculateAmount(i));
			document.getElementById(`rate_${i}`).addEventListener('input', () => calculateAmount(i));
		}

		document.getElementById('tax').addEventListener('input', () => dues(parseFloat(document.getElementById('total').value) || 0));
		document.getElementById('discount').addEventListener('input', () => dues(parseFloat(document.getElementById('total').value) || 0));
		document.getElementById('paid').addEventListener('input', () => dues(parseFloat(document.getElementById('total').value) || 0));


	});
</script>


</x-layouts.master>