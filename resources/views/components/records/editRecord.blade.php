<x-layouts.master>

<!-- error and success message display -->
	<div class="mb-4" id="singleProjectMessage">
		@if(session('success'))
		<div class="border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
			<strong class="font-bold text-center">Success!</strong>
			<span class="block sm:inline text-right">{{ session('success') }}</span>
		</div>
		@endif
		@if($errors->any())
			<ul>
				<li class="text-blue-500"><b>Record Creation Error/s:</b></li>
				@foreach ($errors->all() as $error)
				<li class="text-red-500">{{ $error }}</li>
				@endforeach
			</ul>
		@endif
	</div>
<!-- error and success message display ends -->
	
<!-- Top Buttons -->
 <div class="flex flex-j-between">
	<button onclick="window.location.href=`{{ route('singleRecord', $recordHead->r_id) }}`;" class="flex flex-j-end invoice-button bg-gray-700 hover:bg-gray-900">
		<svg class="w-6 h-6 text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
			<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
		</svg>Go Back
	</button>
	<!--  -->
	<h3 class="text-green-500">EDIT YOUR RECORD</h3>
	<!--  -->
	<div>
		<!---->
		<a href="{{ route('deleteRecord', $recordHead->r_id) }}" class="invoice-button bg-red-500 hover:bg-red-700"
		onclick="return confirm('Are you sure you want to delete this record?');">
			<i class="fas fa-trash" style="color: #ffffff;"></i>
				Delete
		</a>
	</div>

 </div>
<!--  -->
<hr class="col-span-12 my-2 h-1px ">
<!--  -->

<!-- ----------------------------------------------------------- -->

<section id="editArea">

	<!-------Create Modal body ------->
	<form class="p-4 md:p-5" id="updateRecordForm" action="{{ route('updateRecord', $recordHead->r_id) }}" method="POST">
		@csrf
		<div class="grid gap-4 mb-4 grid-cols-12">
			
			<!------- Row-1 [Date to Type] ------->
				<div class="col-span-2">
					<label for="date_made" class="block mb-2 text-sm font-medium">Record Date</label>
					<div class="relative max-w-sm">
						<input id="date_made" datepicker datepicker-format="dd-mm-yyyy" type="date" name="date_made" class="invoice-input text-sm text-black p-2.5" value="{{ \Carbon\Carbon::parse($recordHead->date_made)->format('Y-m-d') }}">
					</div>
				</div>
				<!--  -->
				<div class="col-span-2">
					<label for="date_due" class="block mb-2 text-sm font-medium">Due Date</label>
					<input id="date_due" datepicker datepicker-format="mm-dd-yyyy" type="date" name="date_due" class="invoice-input text-sm text-black w-full p-2.5" value="{{ \Carbon\Carbon::parse($recordHead->date_due)->format('Y-m-d') }}">
				</div>
				<!--  -->
				<div class="col-span-2">
					<label for="ref_id" class="block mb-2 text-sm font-medium text-gray-900">Reference</label>
					<input type="text" name="ref" id="ref_id" class="invoice-input" placeholder="64 characters max" value="{{ $recordHead->ref }}">
				</div>
				<!--  -->
				<div class="col-span-6 sm:col-span-3">
					<label for="method" class="block mb-2 text-sm font-medium text-gray-900">Payment Term</label>
					<input type="text" name="method" id="method" class="invoice-input" placeholder="Payment Method" value="{{ $recordHead->method }}">
				</div>
				<!--  -->
				<div class="col-span-6 sm:col-span-3">
					<label for="type" class="block mb-2 text-sm font-medium text-gray-900">Type</label>
					<select id="type" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
						<option value="invoice" {{ $recordHead->type == 'invoice' ? 'selected' : '' }}>INVOICE</option>
						<option value="bill" {{ $recordHead->type == 'bill' ? 'selected' : '' }}>BILL</option>
						<option value="expense" {{ $recordHead->type == 'expense' ? 'selected' : '' }}>EXPENSE</option>
						<option value="payroll" {{ $recordHead->type == 'payroll' ? 'selected' : '' }}>PAYROLL</option>
						<option value="shares" {{ $recordHead->type == 'shares' ? 'selected' : '' }}>SHARES</option>
						<option value="other" {{ $recordHead->type == 'other' ? 'selected' : '' }}>OTHERS</option>
					</select>
				</div>
			<!------- Row-1 ------->

			<!------- Row-2 [From to Ship] ------->
				<div class="col-span-12 sm:col-span-4">
					<input type="text" name="from" id="from" class="invoice-input" placeholder="From" value="{{ $recordHead->from }}">
				</div>
				<!--  -->
				<div class="col-span-12 sm:col-span-4">
					<input type="text" name="to" id="to" class="invoice-input" placeholder="Voucher to" value="{{ $recordHead->to }}">
				</div>
				<!--  -->
				<div class="col-span-12 sm:col-span-4">
					<input type="text" name="ship" id="ship" class="invoice-input" placeholder="Ship to" value="{{ $recordHead->ship }}">
				</div>
				<!--  -->
			<!------- Row-2 ------->

			<!------- Row-3 [Account Heading] ------->
			 <div class="col-span-12 ugrid-16 px-2 py-2 bg-invoice-navy text-white text-sm rounded">
				<!-- <p class="u-colspan-1 text-left pl-4">No</p> -->
				<p class="u-colspan-9 text-left">Particulars</p>
				<p class="u-colspan-2 text-center">Quantity</p>
				<p class="u-colspan-2 text-center">Rate/Unit Price</p>
				<p class="u-colspan-3 text-center">Amount</p>
			 </div>
			<!------- Row-3 ------->

			<!------- Row-4 [Account Body] ------->
			<div id="itemsContainer" class="col-span-12 ugrid-16 gap-2 items-center">
				@php
					$lastIndex = count($recordData) - 1;
				@endphp

				@foreach($recordData as $index => $recordDataKey)
				
				<div class="itemRow u-colspan-16 ugrid-16 gap-2 items-center">

					<div class="u-colspan-1 hidden">
						<input type="text" name="items[{{ $index }}][item_id]" id="id_1" class="invoice-input" value="{{ $recordDataKey->item_id }}" readonly disabled>
					</div>
					<!--  -->
					<div class="u-colspan-1 hidden">
						<p class="text-center">{{-- $index + 1 --}}</p>
					</div>
					<!--  -->
					<div class="u-colspan-9">
						<input type="text" name="items[{{ $index }}][particular]" id="item_1" class="invoice-input" placeholder="particular of item/service..." value="{{ $recordDataKey->particular }}">
					</div>
					<!--  -->
					<div class="u-colspan-2">
						<input type="number" step="0.01" name="items[{{ $index }}][quantity]" id="qty_1" class="invoice-input" placeholder="QTY" value="{{ $recordDataKey->quantity }}" oninput="updateTotal(this)">
					</div>
					<div class="u-colspan-2">
						<input type="number" step="0.01" id="rate_1" name="items[{{ $index }}][rate]" class="invoice-input" placeholder="Rate" value="{{ $recordDataKey->rate }}" oninput="updateTotal(this)">
					</div>
					<div class="u-colspan-3 flex">
						<input type="number" id="total" step="0.01" id="total_1" name="items[{{ $index }}][total]" class="invoice-input text-blue-600" value="{{ $recordDataKey->total }}" placeholder="QTY x Rate" readonly>
						<button type="button" class="p-2 text-red-500" onclick="removeRow(this)">X</button>
					</div>

				</div>
				@endforeach
			</div>
			<!------- Row-4 ------->

			<!------- Row-5 [Add Line] ------->
			 <div class="col-span-12 flex-j-end">
				<button type="button" class="invoice-button bg-green-500" onclick="addRow()">Add Line</button>
			 </div>
			<!------- Row-4-5 ------->

			<!------- Row-6 [Notes, Calculations] ------->
				<div class="LEFT mt-4 p-2 col-span-7 grid grid-cols-12 bg-green-100 rounded-lg">

				<div class="col-span-12 mb-1">
					<textarea id="note" name="note" rows="2" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="NOTES (max 460 characters)">{{ $recordHead->note }}</textarea>
				</div>
				<!--  -->
				<div class="col-span-12">
					<textarea id="terms" name="terms" rows="2" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Terms & Conditions (max 460 characters)">{{ $recordHead->terms }}</textarea>
				</div>
				<!--  -->
				<div class="col-span-12 flex-y-center">
					
					<div class="w-1/2 flex-y-center">
						<label for="user" class="text-nowrap text-sm font-medium text-gray-900">Created by :</label>
						<p>&nbsp; {{ $recordHead->user }}</p>
					</div>
					<div class="w-1/2 flex-y-center">
						<label for="p_id" class="text-nowrap text-sm font-medium text-gray-900">Updating By :</label>
						<input type="text" name="user" id="user" class="mx-2 italic text-gray-500 invoice-input-none " value="{{ Auth::user()->name }}" readonly>
					</div>
					
				</div>
				<!--  -->
				<div class="col-span-12 flex-y-center flex-x-between">

					<div class="w-1/2 flex-y-center">
						<label for="p_id" class="text-nowrap text-sm font-medium text-gray-900">Client :</label>
						<p>&nbsp; {{ $recordHead->projectInfo->partyInfo->name }}</p>
					</div>
					<div class="w-1/2 flex-y-center">
						<label for="p_id" class="text-nowrap text-sm font-medium text-gray-900">Project :</label>
						<p>&nbsp; {{ $recordHead->projectInfo->name }}</p>
					</div>

				</div>

				</div>
				<!--  -->
				<div class="RIGHT p-2 col-span-5 bg-blue-100 rounded-lg">

				<div class="mb-2 col-span-5 grid grid-cols-5 gap-2">

					<div class="px-2 col-span-3 flex-y-center flex-j-end">
						<label class="font-bold">Total :</label>
					</div>
					<div class="col-span-2 flex">
						<input type="number" step="0.01" name="total" id="final_total" class="invoice-input" placeholder="Subtotal" value="{{ $recordHead->total }}" readonly>
					</div>

				</div>
				<!--  -->
				<div class="mb-2 col-span-5 grid grid-cols-5 gap-2">

					<div class="px-2 col-span-3 flex-y-center flex-j-end">
						<label class="font-bold">VAT/Tax (%):</label>
					</div>
					<div class="col-span-2 flex">
						<input type="number" step="0.01" name="tax" id="tax" class="invoice-input bg-red-50" placeholder="Tax rate (%)" value="{{ $recordHead->tax }}">
					</div>

				</div>
				<!--  -->
				<div class="mb-2 col-span-5 grid grid-cols-5 gap-2">

					<div class="px-2 col-span-3 flex-y-center flex-j-end">
						<label class="font-bold">Discount :</label>
					</div>
					<div class="col-span-2 flex">
						<input type="number" step="0.01" name="discount" id="discount" class="invoice-input bg-red-50" placeholder="total discount" value="{{ $recordHead->discount }}">
					</div>

				</div>
				<!--  -->
				<div class="mb-2 col-span-5 grid grid-cols-5 gap-2">

					<div class="px-2 col-span-3 flex-y-center flex-j-end">
						<label class="font-bold">PAID :</label>
					</div>
					<div class="col-span-2 flex">
						<input type="number" step="0.01" name="paid" id="paid" class="invoice-input bg-red-50" placeholder="total paid" value="{{ $recordHead->paid }}">
					</div>

				</div>
				<!--  -->
				<div class="mb-2 col-span-5 grid grid-cols-6 gap-2 bg-invoice-navy text-white">

					<div class="px-2 col-span-3 flex-y-center flex-j-end">
						<label class="font-bold">BALANCE DUES :</label>
					</div>
					<div class="col-span-3 flex">
						<input type="number" step="0.01" name="dues" id="dues" class="invoice-input bg-red-50" placeholder="total dues" value="{{ $recordHead->dues }}" readonly>
					</div>

				</div>

				</div>

			<!------- Row-6, 7, 8, 9, 10, 11  ------->

		</div>

		<div class="flex-j-end">
			<button type="submit" class="invoice-button bg-indigo-600 hover:bg-blue-900">
				Update
			</button>
		</div>
	</form>


</section>



<!-- ----------------------------------------------------------- -->
<style>
	input::placeholder,
	textarea::placeholder { 
		font-size: 15px;
		color: #40495590;
		text-align: center;
	}
	input{
		text-align: center;
	}
</style>
<!---------------- Javascript ---------------->
<script scoped>
	let itemCount = {{ $lastIndex + 1 }};

	function addRow() {
		let container = document.getElementById("itemsContainer");

		let newRow = document.createElement("div");
		newRow.classList.add("itemRow", "u-colspan-16", "ugrid-16", "gap-2", "items-center");
		newRow.innerHTML = `
			<div class="u-colspan-1 hidden">
				<input type="text" name="items[{{ $index }}][item_id]" id="id_1" class="invoice-input" value="{{ $recordDataKey->item_id }}" readonly disabled>
			</div>
			<!--  -->
			<div class="u-colspan-1 hidden">
				<p class="text-center">${itemCount + 1}</p>
			</div>
			<!--  -->
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
		// Reindex the remaining rows
		let rows = document.querySelectorAll("#itemsContainer .itemRow");
		rows.forEach((row, index) => {
			// Update name attributes with correct index
			row.querySelectorAll('input').forEach(input => {
					input.name = input.name.replace(/\[(\d+)\]/, `[${index}]`);
			});
		});
		itemCount = rows.length;
		updateFinalTotal();
	}
	// ------------------------------------------
	document.getElementById('updateRecordForm').addEventListener('submit', function() {
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
	setTimeout(function(){
		document.getElementById('editRecordMessage').style.display='none';
	},10000);
	// ------------------------------------------
</script>

</x-layouts.master>