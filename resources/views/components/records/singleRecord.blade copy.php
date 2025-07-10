<x-layouts.master>

<!-- error and success message display -->
	<div>
		<!-- Success message display -->
		@if(session('success'))
		<div class=" border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
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
	<button onclick="window.location.href=`{{ route('singleProject', $singleRecord->p_id) }}`;" class="flex flex-j-end invoice-button bg-gray-700 hover:bg-gray-900">
		<svg class="w-6 h-6 text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
			<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
		</svg>Go Back
	</button>
	<!--  -->
	<div>
		<a href="{{ route('editRecord', $singleRecord->id) }}" class="invoice-button bg-green-500 hover:bg-green-700">
			<i class="fas fa-edit" style="color: #ffffff;"></i>
				Edit
		</a>
		<!---->
		<a href="{{ route('printArea', $singleRecord->id) }}" class="invoice-button bg-teal-500 hover:bg-teal-700">
			<i class="fas fa-print" style="color: #ffffff;"></i>
				Print Area
		</a>
		<!---->
		<a href="{{ route('makePdf', $singleRecord->id) }}" class="invoice-button bg-fuchsia-500 hover:bg-fuchsia-700">Download PDF</a>
	</div>

</div>
<!--  -->


<!---------------- Main Body Starts ---------------->
<section class="grid-cols-12">

	<div id="Header" class="col-span-12 grid grid-cols-12">

		<div class="leftHeader px-2 py-1 col-span-3 flex-col flex-j-center ">
			<img src="{{ asset('asset/images/icons') }}/neutra_logo_black.png" alt="logo_black" class="mx-4 my-2 h-12">
			<a href="https://maps.app.goo.gl/Ju3w6RMKMUnrTiQdA"><p class="text-sm text-center text-gray-500">Studio Office : Flat # 304, Plot # 20, R # 62, Gulshan-2, Dhaka-1212, Bangladesh</p></a>
		</div>
		<!--  -->
		<div class="dummyDiv col-span-1 "></div>
		<!--  -->
		<div class="dummyDiv col-span-4 ">
			<h5 class="font-bold text-center">Payment Info</h5>
			<p>bKash : <span class="text-blue-900">01919210210</span> <span class="text-xs text-gray-600">(1.85% charge will be added)</span> </p>
			<b>Bank Name : Eastern Bank PLC</b>
			<p class="text-sm">Account Name : <span class="text-gray-600">KHN</span> </p>
			<p class="text-sm">A/C No : <span class="text-gray-600">1041070000311</span> </p>
			<div class="flex">
				<p class="text-sm">Branch : <span class="text-gray-600">Gulshan.</span> </p>
				<p class="mx-6 text-sm">Routing : <span class="text-gray-600">0000000</span> </p>
			</div>
		</div>
		<!--  -->
		<div class="rightHeader px-2 py-1 col-span-4 flex-col flex-j-center ">

			<h2 class="uppercase text-right">{{ $singleRecord->type }}</h2>
			<!---->
			<div class="mb-1 flex-y-center flex-j-end">
				<label class="block m-2 text-sm font-medium text-gray-500 text-nowrap">Reference/No. :&nbsp;</label>
				<input type="text" name="ref_id" id="ref_id" class="invoice-input" placeholder="{{ $singleRecord->ref_id }}" style="width:16rem !important" readonly>
			</div>
			<!---->

		</div>

	</div>
	<!------------------>
	<hr class="col-span-12 my-2 h-1px ">
	<!------------------>
	<div id="Identity" class="col-span-12 grid grid-cols-12">

		<div class="leftIdentity col-span-7 px-2 grid grid-cols-12 ">

			<div class="col-span-6 mb-1 flex-y-center flex-j-start ">
				<label class="text-sm font-medium text-gray-500 text-nowrap">PID :&nbsp; </label>
				<p>({{ $fetchProjectDetails->p_id }})&nbsp; &nbsp; </p>
				<label class="text-sm font-medium text-gray-500 text-nowrap">Project :&nbsp; </label>
				<h5>{{ $fetchProjectDetails->name }}</h5>
			</div>
			<!---->
			<div class="col-span-6 mb-1 flex-y-center flex-j-end ">
				<label class="text-sm font-medium text-gray-500 text-nowrap">From :&nbsp;</label>
				<input type="text" name="ref_id" id="ref_id" class="invoice-input" placeholder="{{ $singleRecord->from }}" style="width:16rem !important" readonly>
			</div>
			<!---->
			<div class="col-span-6 mb-1 flex-y-center flex-j-end ">
				<label class="text-sm font-medium text-gray-500 text-nowrap">To :&nbsp;</label>
				<input type="text" name="ref_id" id="ref_id" class="invoice-input" placeholder="{{ $singleRecord->to }}" style="width:16rem !important" readonly>
			</div>
			<!---->
			<div class="col-span-6 mb-1 flex-y-center flex-j-end ">
				<label class="text-sm font-medium text-gray-500 text-nowrap">Ship To :&nbsp;</label>
				<input type="text" name="ref_id" id="ref_id" class="invoice-input" placeholder="{{ $singleRecord->ship }}" style="width:16rem !important" readonly>
			</div>
			<!---->


		</div>
		<!--  -->
		<div class="dummyDiv col-span-1"></div>
		<!--  -->
		<div class="rightIdentity col-span-4 grid grid-cols-12 px-2 py-1 flex-col flex-j-center">

			<!---->
			<div class="col-span-12 mb-1 flex-y-center flex-j-end ">
				<label class="text-sm font-medium text-gray-500 text-nowrap">Record Date :&nbsp;</label>
				<input type="text" name="date_made" id="date_made" class="invoice-input text-black" placeholder="{{ $singleRecord->date_made }}" style="width:16rem !important" readonly>
			</div>
			<!---->
			<div class="col-span-12 mb-1 flex-y-center flex-j-end ">
				<label class="text-sm font-medium text-gray-500 text-nowrap">Due Date :&nbsp;</label>
				<input type="text" name="date_due" id="date_due" class="invoice-input" placeholder="{{ $singleRecord->date_due }}" style="width:16rem !important" readonly>
			</div>
			<!---->
			<div class="col-span-12 mb-1 flex-y-center flex-j-end ">
				<label class="text-sm font-medium text-gray-500 text-nowrap">Payment Method :&nbsp;</label>
				<input type="text" name="date_due" id="date_due" class="invoice-input" placeholder="{{ $singleRecord->method }}" style="width:16rem !important" readonly>
			</div>
			<!---->

		</div>

	</div>
	<!------------------>
	<hr class="col-span-12 my-2 h-1px ">
	<!------------------>
	<div id="Accounts" class="col-span-12 grid grid-cols-12">

		<div class="col-span-12 grid grid-cols-12 pl-4 pr-1 py-2 bg-invoice-navy text-white text-sm rounded">
			<p class="col-span-7 text-center">Particulars</p>
			<p class="col-span-1 text-center">Quantity</p>
			<p class="col-span-2 text-center">Rate/Unit Price</p>
			<p class="col-span-2 text-center">Amount</p>
		</div>
			@php
				$amount_1 = number_format(($singleRecord->qty_1 + $singleRecord->rate_1), 2, '.', '');
				$amount_2 = number_format(($singleRecord->qty_2 + $singleRecord->rate_2), 2, '.', '');
				$amount_3 = number_format(($singleRecord->qty_3 + $singleRecord->rate_3), 2, '.', '');
			
			@endphp
		<!-- row-1 -->
		<div class="my-2 col-span-12 grid grid-cols-12 gap-2">

			<div class="col-span-7">
				<input type="text" name="item_1" id="item_1" class="invoice-input" placeholder="{{ $singleRecord->item_1 }}" readonly>
			</div>
			<!--  -->
			<div class="col-span-1">
				<input type="number" step="0.01" name="qty_1" id="qty_1" class="invoice-input" placeholder="{{ $singleRecord->qty_1 }}" readonly>
			</div>
			<div class="col-span-2">
				<input type="number" step="0.01" id="rate_1" name="rate_1" class="invoice-input" placeholder="{{ $singleRecord->rate_1 }}" readonly >
			</div>
			<div class="col-span-2 flex-xy-center">
				<b>=&nbsp;&nbsp;&nbsp;</b>
				<b id="amount_1" class="text-blue-600">{{ $amount_1 }}</b>
			</div>

		</div>
		<!-- row-2 -->
		<div class="mb-2 col-span-12 grid grid-cols-12 gap-2">

			<div class="col-span-7">
				<input type="text" name="item_2" id="item_2" class="invoice-input" placeholder="{{ $singleRecord->item_2 }}" readonly>
			</div>
			<!--  -->
			<div class="col-span-1">
				<input type="number" step="0.01" name="qty_2" id="qty_2" class="invoice-input" placeholder="{{ $singleRecord->qty_2 }}" readonly>
			</div>
			<div class="col-span-2">
				<input type="number" name="rate_2" step="0.01" id="rate_2" class="invoice-input" placeholder="{{ $singleRecord->rate_2 }}" readonly>
			</div>
			<div class="col-span-2 flex-xy-center">
				<b>=&nbsp;&nbsp;&nbsp;</b>
				<b id="amount_2" class="text-blue-600">{{ $amount_2 }}</b>
			</div>

		</div>
		<!-- row-3 -->
		<div class="mb-2 col-span-12 grid grid-cols-12 gap-2">

			<div class="col-span-7">
				<input type="text" name="item_3" id="item_3" class="invoice-input" placeholder="{{ $singleRecord->item_3 }}" readonly>
			</div>
			<!--  -->
			<div class="col-span-1">
				<input type="number" step="0.01" name="qty_3" id="qty_3" class="invoice-input" placeholder="{{ $singleRecord->qty_3 }}" readonly>
			</div>
			<div class="col-span-2">
				<input type="number" name="rate_3" step="0.01" id="rate_3" class="invoice-input" placeholder="{{ $singleRecord->rate_3 }}" readonly>
			</div>
			<div class="col-span-2 flex-xy-center">
				<b>=&nbsp;&nbsp;&nbsp;</b>
				<b id="amount_2" class="text-blue-600">{{ $amount_3 }}</b>
			</div>

		</div>

	</div>
	<!------------------>
	<div id="results" class="col-span-12 grid grid-cols-12">

		<div class="LEFT mt-4 p-2 col-span-7 grid grid-cols-12  rounded-lg">

			<div class="col-span-12 mb-1">
				<label>Notes :</label>
				<textarea id="note" name="note" rows="2" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="{{ $singleRecord->note }}" readonly></textarea>
			</div>
			<!--  -->
			<div class="col-span-12">
				<label>Terms & Conditions:</label>
				<textarea id="terms" name="terms" rows="2" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="{{ $singleRecord->terms }}" readonly></textarea>
			</div>
			<!--  -->
			<div class="col-span-12 flex-y-center">
				<label for="user" class="text-nowrap text-sm font-medium text-gray-900">Created by :</label>
				<input type="text" name="user" id="user" class="mx-2 italic text-gray-500 invoice-input-none " placeholder="{{ $singleRecord->user }}" readonly>

			</div>

		</div>
		<!--  -->
		<div class="RIGHT p-2 col-span-5  rounded-lg">

			<div class="mb-2 col-span-5 grid grid-cols-5 gap-2">

				<div class="px-2 col-span-3 flex-y-center flex-j-end">
					<label class="font-bold">Total :</label>
				</div>
				<div class="col-span-2 flex">
					<input type="number" step="0.01" name="total" id="total" class="invoice-input" placeholder="{{ $singleRecord->total }}" readonly>
				</div>

			</div>
			<!--  -->
			<div class="mb-2 col-span-5 grid grid-cols-5 gap-2">

				<div class="px-2 col-span-3 flex-y-center flex-j-end">
					<label class="font-bold">Tax (%):</label>
				</div>
				<div class="col-span-2 flex">
					<input type="number" step="0.01" name="tax" id="tax" class="invoice-input " placeholder="{{ $singleRecord->tax }}" readonly>
				</div>

			</div>
			<!--  -->
			<div class="mb-2 col-span-5 grid grid-cols-5 gap-2">

				<div class="px-2 col-span-3 flex-y-center flex-j-end">
					<label class="font-bold">Discount :</label>
				</div>
				<div class="col-span-2 flex">
					<input type="number" step="0.01" name="discount" id="discount" class="invoice-input " placeholder="{{ $singleRecord->discount }}" readonly>
				</div>

			</div>
			<!--  -->
			<div class="mb-2 col-span-5 grid grid-cols-5 gap-2">

				<div class="px-2 col-span-3 flex-y-center flex-j-end">
					<label class="font-bold">PAID :</label>
				</div>
				<div class="col-span-2 flex">
					<input type="number" step="0.01" name="paid" id="paid" class="invoice-input " placeholder="{{ $singleRecord->paid }}" disabled>
				</div>

			</div>
			<!--  -->
			<div class="mb-2 col-span-5 grid grid-cols-6 gap-2 bg-invoice-navy text-white">

				<div class="px-2 col-span-3 flex-y-center flex-j-end">
					<label class="font-bold">BALANCE DUES :</label>
				</div>
				<div class="col-span-3 flex">
					<input type="number" step="0.01" name="dues" id="dues" class="invoice-input " placeholder="{{ $singleRecord->dues }}" disabled>
				</div>

			</div>

		</div>

	</div>
	
	<!--  -->

	<!------------------>

</section>
<!---------------- Main Body Ends ---------------->
<style>
	input::placeholder,
	textarea::placeholder { 
		font-size: 15px;
		color: #404955;
		text-align: center;
	}
</style>


<!-- <script>
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
</script> -->


</x-layouts.master>