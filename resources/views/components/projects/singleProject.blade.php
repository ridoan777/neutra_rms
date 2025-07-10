<x-layouts.master>

	<!-- error and success message display -->
	<x-alert-component message="Single record display"/>
	<!-- error and success message display ends -->

	<!---------------- Top Buttons ---------------->
	<div class="flex flex-j-between">
		<button onclick="window.location.href=`{{ route('project') }}`;" class="flex flex-j-end invoice-button bg-gray-700 hover:bg-gray-900">
			{!! \App\Helpers\Fontawesome::arrowLeft(['class' => 'w-5 h-5 text-white']) !!} &nbsp; Go Back
		</button>
		<!--  -->
		<button data-modal-target="createRecordModal" data-modal-toggle="createRecordModal" class="invoice-button bg-blue-700 hover:bg-blue-900" type="button"> Create Record</button>
	</div>
	<!--  -->

	<!---------------- Main Table Starts ---------------->
	<h3 class="text-center text-blue-900 uppercase dark:text-zinc-300">Records</h3>

	<div class="grid grid-cols-12 gap-4 relative overflow-x-auto ">

		<!--------------- Lift Side Project Area --------------->
		<section id="leftProjectShow" class="col-span-3 p-2 bg-violet-200 rounded-lg flex flex-col">

			@if(empty($showProject->image))
			<img src="{{ asset('asset/images/app_image') }}/No_image_added.png" alt="no_image_added" class="w-full">
			@else
			<img src="{{ asset($showProject->image) }}" alt="project_image" class="w-full">
			@endif

			<div class="my-2 flex flex-y-center">
				<p>Project :&nbsp;</p>
				<h4 class="text-blue-900">{{ $showProject->name }}</h4>
			</div>
			<div class="my-2 flex flex-y-center">
				<p>PID :&nbsp;</p>
				<h4 class="text-blue-900">{{ $showProject->p_id }}</h4>
			</div>
			<div class="my-2 flex flex-y-center">
				<p>Party :&nbsp;</p>
				<h5 class="">{{ $partyName->name }}</h5>
			</div>
			<div class="my-2 flex flex-y-center">
				<p>Created by :&nbsp;</p>
				<p class="italic">{{ $showProject->user }}</p>
			</div>
			<div class="my-2 flex flex-y-center">
				<p>Created at :&nbsp;</p>
				<p class="italic text-sm text-gray-500">{{ $showProject->created_at->format('d M \'y \\a\\t g:i A') }}</p>
			</div>
			<div class="my-2 flex flex-y-center">
				<p>Last Updated by :&nbsp;</p>
				<p class="text-gray-400">{{ $showProject->updater }}</p>
			</div>
			<div class="my-2 flex flex-y-center">
				<p>Last Updated at :&nbsp;</p>
				@if($showProject->updated_at)
				<p class="italic text-sm text-gray-500">
					{{ $showProject->updated_at->format("d M 'y \\a\\t g:i A") }}
				</p>
				@else
					<p class="italic text-sm text-gray-500">Not updated yet</p>
				@endif

			</div>


		</section>
		<!--------------- Right Side Record Area --------------->
		<section id="rightRecordShow" class="col-span-9 p-2 bg-gray-50 sm:rounded-lg">

			<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">

				<thead class="text-xs text-gray-300 uppercase bg-invoice-navy">
					<tr>
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
				@if(!empty($recordHead))
				 @foreach($recordHead as $index => $headKey)	<!--record head, head key-->
					@foreach($recordData as $dataKey)<!--record data, dataKey-->
					  @if($dataKey->r_id == $headKey->r_id)

					 <tr class="bg-white border-b border-gray-200 hover:bg-gray-50 cursor-pointer" onclick="window.location.href=`{{ route('singleRecord', $headKey->r_id) }}`;">
						<b class="hidden">{{ $headKey->id }},</b>
						<td class="w-4 px-2 py-3">
							<div class="flex flex-xy-center">
								<label for="checkbox-table-search-1" class="text-black">{{-- $loop->iteration .'-'. $headKey->id --}} {{ count($recordHead) - $index }}</label>
							</div>
						</td>
						<!--  -->
						<th scope="row" class="flex-col items-center px-1 py-1 text-gray-900 whitespace-nowrap">
							<div class="text-xs fw-200">{{ date('d-M-Y', strtotime($headKey->date_made)) }}</div>
							<div class="text-xs text-wrap fw-200 text-gray-500">Due:{{ date('d-M-y', strtotime($headKey->date_due)) }}</div>
						</th>
						<!--  -->
						<td class="px-2 py-1 text-center">
							{{ $headKey->ref }}
						</td>
						<!--  -->
						<td class="px-2 py-1 text-center particular">
							@php
								//$particular = \App\Models\RecordItems::where('record_id', $headKey->id)->value('particular');
							@endphp
							<p>{{ \Illuminate\Support\Str::limit($headKey->particular, 24, $end='...') }}</p>
							<p>{{ $dataKey->particular }}</p>
							<p>{{-- $headKey->particular --}}</p>
						</td>
						<!--  -->
						<td class="flex-col flex-xy-center px-2 py-1">
							<p class="font-semibold">&#x9F3; {{ $headKey->total }}</p>
							<p class="text-yellow-400">&#x9F3; {{ $headKey->dues }} dues</p>
						</td>
						<!--  -->
						<td class="w-36 px-1 py-1">
							@php
								if($headKey->type == 'invoice'){
									$typeColor = 'text-teal-500 border-teal-500';
								}
								elseif($headKey->type == 'expense'){
									$typeColor = 'text-orange-500 border-orange-500';
								}
								else{ $typeColor = 'text-green-500 border-green-500';}
							@endphp
							<p class="font-semibold capitalize text-center <?= $typeColor ?> border rounded-lg bg-gray-50">{{ $headKey->type }}</p>
						</td>
						<!--  -->
						<td class="w-32 px-2 py-1">
							<div class="flex items-center">
								@php
									$todayDate = new DateTime('now');
									$date_due = new DateTime($headKey->date_due);
									$dues = $headKey->dues;

									$interval = $todayDate->diff($date_due);
									$remaining_days = (int)$interval->format('%r%a');
									$dueMessage = $remaining_days . " " . "day/s remaining";

									if ($dues > 0 && $remaining_days <= 3 && $remaining_days> 0 ) {
										$textColor = "text-yellow-400 font-semibold";
									}
									elseif($dues > 0 && $remaining_days > 3){
										$textColor = "text-yellow-400";
									}
									elseif($dues > 0 && $remaining_days < 0){
										$textColor="text-red-400 font-semibold" ;
										$dueMessage=abs($remaining_days) . " " . "day/s overdue" ;
									}
									elseif($dues==0){
										$textColor="text-green-500 font-semibold" ;
										$dueMessage="payment cleared" ;
									}
									else{
										$textColor="text-yellow-400 font-semibold" ;
										$dueMessage="logic error!" ;
									}
									@endphp
									<p class="rounded-full text-center text-xs text-wrap {{ $textColor }}">{{ $dueMessage }}</p>
							</div>
						</td>
						<!--  -->
						<td class="w-32 px-2 py-1">
							<div class="flex-col items-center">
								<p class="text-wrap text-justify">{{ \Illuminate\Support\Str::limit($headKey->note, 30, $end='...') }}</p>
							</div>
						</td>
						<!--  -->

					 </tr>
					 	@break
					  @endif
					@endforeach
				 @endforeach
				@endif
				</tbody>

			</table>

		</section>
		<!--  -->

	</div>

	<!---------------- Modal Starts ---------------->
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
					<form class="p-4 md:p-5" action="{{ route('makeRecord', $showProject->id) }}" method="POST" id="recordForm">
						@csrf
						<div class="grid gap-3 mb-4 grid-cols-12">

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
								<label for="ref" class="block mb-2 text-sm font-medium text-gray-900">Reference</label>
								<input type="text" name="ref" id="ref" class="invoice-input" placeholder="64 characters max">
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
						 <!------- Row-2 ------->

						 <!------- Row-3.1::Heading ------->
							<div class="col-span-12 ugrid-16 px-2 py-2 bg-invoice-navy text-white text-sm rounded">
								<p class="u-colspan-1 text-left">No</p>
								<p class="u-colspan-8 text-left">Particulars</p>
								<p class="u-colspan-2 text-center">Quantity</p>
								<p class="u-colspan-2 text-center">Rate/Unit Price</p>
								<p class="u-colspan-3 text-center">Amount</p>
							</div>
						 <!------- Row-3.1::Heading ------->

						 <!------- Row-3.2 ------->
							<div id="itemsContainer" class="col-span-12 ugrid-16 gap-2 items-center">
								<div class="itemRow u-colspan-16 ugrid-16 gap-2 items-center">

									<div class="u-colspan-1 hidden">
										<input type="text" name="items[0][item_id]" id="id_1" class="invoice-input" value="1" readonly disabled>
									</div>
									<!--  -->
									<div class="u-colspan-9">
										<input type="text" name="items[0][particular]" id="item_1" class="invoice-input" placeholder="particular of item/service...">
									</div>
									<!--  -->
									<div class="u-colspan-2">
										<input type="number" step="0.01" name="items[0][quantity]" id="qty_1" class="invoice-input" placeholder="QTY" oninput="updateTotal(this)">
									</div>
									<div class="u-colspan-2">
										<input type="number" step="0.01" id="rate_1" name="items[0][rate]" class="invoice-input" placeholder="Rate" oninput="updateTotal(this)">
									</div>
									<div class="u-colspan-3 flex">
										<input type="number" id="total" step="0.01" id="total_1" name="items[0][total]" class="invoice-input text-blue-600" placeholder="QTY x Rate" readonly>
										<button type="button" class="p-2 text-red-500" onclick="removeRow(this)">X</button>
									</div>
								</div>
							</div>
						 <!------- Row-3.2 ------->

							<!------- Row-4-5 ------->
							<div class="col-span-12 flex-j-end">
								<button type="button" class="invoice-button bg-green-500" onclick="addRow()">Add Line</button>
							</div>
							<!------- Row-4-5 ------->

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
									<input type="text" name="p_id" id="p_id" class=" w-8 ml-2 italic invoice-input-none" value="{{ $showProject->id }}" readonly>
									<p>&nbsp; {{ $showProject->name }}</p>
								</div>
								<div class="col-span-12 flex-y-center">
									<label for="p_id" class="text-nowrap text-sm font-medium text-gray-900">Client :</label>
									<p>&nbsp; {{ $partyName->name }}</p>
								</div>

							</div>
							<!--  -->
							<div class="RIGHT p-2 col-span-5 bg-blue-100 rounded-lg">

								<div class="mb-2 col-span-5 grid grid-cols-5 gap-2">

									<div class="px-2 col-span-3 flex-y-center flex-j-end">
										<label class="font-bold">Total :</label>
									</div>
									<div class="col-span-2 flex">
										<input type="number" step="0.01" name="total" id="final_total" class="invoice-input" placeholder="Subtotal" value="" readonly>
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

	<!---------------- Javascript ---------------->
	<script scoped>
		let itemCount = 1;

		function addRow() {
			let container = document.getElementById("itemsContainer");

			let newRow = document.createElement("div");
			newRow.classList.add("itemRow", "u-colspan-16", "ugrid-16", "gap-2", "items-center");
			newRow.innerHTML = `
				<!--<div class="u-colspan-1 hidden">
						<input type="text" name="items[${itemCount}][item_id]" class="invoice-input" value="${itemCount + 1}" readonly disabled>
				</div>-->
				<div class="u-colspan-9">
						<input type="text" name="items[${itemCount}][particular]" class="invoice-input" placeholder="particular of item/service...">
				</div>
				<div class="u-colspan-2">
						<input type="number" step="0.01" name="items[${itemCount}][quantity]" class="invoice-input" placeholder="QTY" oninput="updateTotal(this)">
				</div>
				<div class="u-colspan-2">
						<input type="number" step="0.01" name="items[${itemCount}][rate]" class="invoice-input" placeholder="Rate" oninput="updateTotal(this)">
				</div>
				<div class="u-colspan-3 flex">
						<input type="number" step="0.01" name="items[${itemCount}][total]" class="invoice-input text-blue-600" placeholder="QTY x Rate" readonly>
						<button type="button" class="p-2 text-red-500" onclick="removeRow(this)">X</button>
				</div>
			`;

			container.appendChild(newRow);
			itemCount++;
		}

		// ------------------------------------------
		function removeRow(button) {
			button.closest(".itemRow").remove();
			this.itemCount = this.itemCount-1;
			updateFinalTotal();
		}
		// ------------------------------------------
		document.getElementById('recordForm').addEventListener('submit', function() {
			document.getElementById('final_total').value = parseFloat(document.getElementById('final_total').value) || 0;
			document.getElementById('tax').value = parseFloat(document.getElementById('tax').value) || 0;
			document.getElementById('discount').value = parseFloat(document.getElementById('discount').value) || 0;
			document.getElementById('paid').value = parseFloat(document.getElementById('paid').value) || 0;
			document.getElementById('dues').value = parseFloat(document.getElementById('dues').value) || 0;
		});

		// ------------------------------------------
		function updateTotal(input) {
			let row = input.closest(".itemRow");
			let qty = row.querySelector("[name^='items'][name$='[quantity]']").value;
			let rate = row.querySelector("[name^='items'][name$='[rate]']").value;
			let totalField = row.querySelector("[name^='items'][name$='[total]']");

			totalField.value = (qty * rate).toFixed(2);
			updateFinalTotal();
		}
		// ------------------------------------------
		function updateFinalTotal() {
			let totalFields = document.querySelectorAll("[name^='items'][name$='[total]']");
			let finalTotal = 0;

			totalFields.forEach(field => {
				finalTotal += parseFloat(field.value) || 0;
			});

			document.getElementById("final_total").value = finalTotal.toFixed(2);
			dues();
		}
		// ------------------------------------------
		function dues() {
			// const total = parseFloat(document.getElementById('total').textContent) || 0;
			const total = parseFloat(document.getElementById('final_total').value) || 0;
			const tax = parseFloat(document.getElementById('tax').value) || 0;
			const discount = parseFloat(document.getElementById('discount').value) || 0;
			const paid = parseFloat(document.getElementById('paid').value) || 0;

			const taxable = (total * (tax / 100));

			const dues = total + taxable - discount - paid;
			document.getElementById('dues').value = dues.toFixed(2);
		}

		document.getElementById('tax').addEventListener('input', () => dues());
		document.getElementById('discount').addEventListener('input', () => dues());
		document.getElementById('paid').addEventListener('input', () => dues());

		// ------------------------------------------

		// ------------------------------------------
	</script>

</x-layouts.master>