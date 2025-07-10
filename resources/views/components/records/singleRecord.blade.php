<x-layouts.master>

<!-- error and success message display -->
<x-alert-component message="Record Update"/>
<!-- error and success message display ends -->
	
<!---------------- Top Buttons ---------------->
<div class="flex flex-j-between">
	<button onclick="window.location.href=`{{ route('singleProject', $recordHead->p_id ) }}`;" class="flex flex-j-end invoice-button bg-gray-700 hover:bg-gray-900">
		<svg class="w-6 h-6 text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
			<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
		</svg>Go Back
	</button>
	<!--  -->
	<div>
		<a href="{{ route('editRecord', $recordHead->r_id) }}" class="invoice-button bg-green-500 hover:bg-green-700">
			<i class="fas fa-edit" style="color: #ffffff;"></i>
				Edit
		</a>
		<!---->
		<a href="{{ route('printArea', $recordHead->id) }}" class="invoice-button bg-teal-500 hover:bg-teal-700">
			<i class="fas fa-print" style="color: #ffffff;"></i>
				Print Area
		</a>
		<!---->
		<a href="{{ route('makePdf', $recordHead->id) }}" class="invoice-button bg-fuchsia-500 hover:bg-fuchsia-700">Download PDF</a>
	</div>

</div>
<!--  -->

<!---------------- Main Table Starts ---------------->
<section class="grid-cols-12">

	<div id="Header" class="col-span-12 grid grid-cols-12">

		<div class="leftHeader px-2 py-1 col-span-3 flex-col flex-j-center ">
			<img src="{{ asset('asset/images/icons') }}/Logo_long-Vendora_1500x500.png" alt="logo_black" class="mx-4 my-2 h-12">
			<a href="https://maps.app.goo.gl/Ju3w6RMKMUnrTiQdA"><p class="text-sm text-center text-gray-500">Studio Office : Flat # 304, Plot # 20, R # 62, Gulshan-2, Dhaka-1212, Bangladesh</p></a>
		</div>
		<!--  -->
		<div class="dummyDiv col-span-1 "></div>
		<!--  -->
		<div class="dummyDiv col-span-4 ">
			<h5 class="font-bold ">Payment Info</h5>
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
		<div class="rightHeader px-2 py-1 col-span-4 flex-col flex-j-center">

			<h2 class="uppercase text-right">{{ $recordHead->type }}</h2>
			<!---->
			<div class="mb-1 flex-y-center flex-j-center">
				<label class="block m-2 text-sm font-medium text-gray-500 text-nowrap">Record No. :&nbsp;</label>
				<!-- <input type="text" name="ref" id="ref" class="invoice-input" placeholder="{{ $recordHead->r_id }}" style="width:16rem !important" readonly> -->
				<p>{{ $recordHead->r_id }}</p>
			</div>
			<!---->
			<div class="mb-1 flex-y-center flex-j-end">
				<label class="block m-2 text-sm font-medium text-gray-500 text-nowrap">Reference/No. :&nbsp;</label>
				<input type="text" name="ref" id="ref" class="invoice-input" placeholder="{{ $recordHead->ref }}" style="width:16rem !important" readonly>
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
				<p>{{ $recordHead->p_id }}&nbsp; &nbsp; </p>
				<label class="text-sm font-medium text-gray-500 text-nowrap">Project :&nbsp; </label>
				<h5>{{ $fetchProjectDetails->name }}</h5>
			</div>
			<!---->
			<div class="col-span-6 mb-1 flex-y-center flex-j-end ">
				<label class="text-sm font-medium text-gray-500 text-nowrap">From :&nbsp;</label>
				<input type="text" name="ref" id="ref" class="invoice-input" placeholder="{{ $recordHead->from }}" style="width:16rem !important" readonly>
			</div>
			<!---->
			<div class="col-span-6 mb-1 flex-y-center flex-j-end ">
				<label class="text-sm font-medium text-gray-500 text-nowrap">To :&nbsp;</label>
				<input type="text" name="ref" id="ref" class="invoice-input" placeholder="{{ $recordHead->to }}" style="width:16rem !important" readonly>
			</div>
			<!---->
			<div class="col-span-6 mb-1 flex-y-center flex-j-end ">
				<label class="text-sm font-medium text-gray-500 text-nowrap">Ship To :&nbsp;</label>
				<input type="text" name="ref" id="ref" class="invoice-input" placeholder="{{ $recordHead->ship }}" style="width:16rem !important" readonly>
			</div>
			<!---->

		</div>
		<!--  -->
		<div class="dummyDiv col-span-1"></div>
		<!--  -->
		<div class="rightIdentity col-span-4 grid grid-cols-12 px-2 py-1 flex-col flex-j-center">

			<!---->
			@php
				$dateMade = Carbon\Carbon::parse($recordHead->date_made)->format('d-M-Y');
				$dueDate = Carbon\Carbon::parse($recordHead->date_due)->format('d-M-Y');
			@endphp
			<div class="col-span-12 mb-1 flex-y-center flex-j-end ">
				<label class="text-sm font-medium text-gray-500 text-nowrap">Record Date :&nbsp;</label>
				<input type="text" name="date_made" id="date_made" class="invoice-input text-black" placeholder="{{ $dateMade }}" style="width:16rem !important" readonly>
			</div>
			<!---->

			<div class="col-span-12 mb-1 flex-y-center flex-j-end ">
				<label class="text-sm font-medium text-gray-500 text-nowrap">Due Date :&nbsp;</label>
				<input type="text" name="date_due" id="date_due" class="invoice-input" placeholder="{{ $dueDate  }}" style="width:16rem !important" readonly>
			</div>
			<!---->
			<div class="col-span-12 mb-1 flex-y-center flex-j-end ">
				<label class="text-sm font-medium text-gray-500 text-nowrap">Payment Method :&nbsp;</label>
				<input type="text" name="date_due" id="date_due" class="invoice-input" placeholder="{{ $recordHead->method }}" style="width:16rem !important" readonly>
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
		<!-- row-1 -->
		@foreach($recordData as $recordData)
			<div class="my-1 col-span-12 grid grid-cols-12 gap-2">

				<div class="col-span-7">
					<input type="text" name="particular" id="particular" class="invoice-input" placeholder="{{ $recordData->particular }}" readonly>
				</div>
				<!--  -->
				<div class="col-span-1">
					<input type="number" step="0.01" name="quantity" id="quantity" class="invoice-input" placeholder="{{ number_format($recordData->quantity) }}" readonly>
				</div>
				<div class="col-span-2">
					<input type="number" step="0.01" id="rate" name="rate" class="invoice-input" placeholder="&#2547; {{ number_format($recordData->rate, 2) }}" readonly >
				</div>
				<div class="col-span-2 flex-xy-center">
					<b>=&nbsp;&nbsp;&nbsp;</b>
					<b id="amount_1" class="text-blue-600">&#2547; {{ number_format($recordData->total, 2) }}
					</b>
				</div>

			</div>
		@endforeach
		<!-- row-2 -->

	</div>
	<!------------------>
	<div id="results" class="col-span-12 grid grid-cols-12">

		<div class="LEFT mt-4 p-2 col-span-7 grid grid-cols-12  rounded-lg">

			<div class="col-span-12 mb-1">
				<label>Notes :</label>
				<textarea id="note" name="note" rows="2" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="{{ $recordHead->note }}" readonly></textarea>
			</div>
			<!--  -->
			<div class="col-span-12">
				<label>Terms & Conditions:</label>
				<textarea id="terms" name="terms" rows="2" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="{{ $recordHead->terms }}" readonly></textarea>
			</div>
			<!--  -->
			<div class="col-span-12 flex-y-center">
				<label for="user" class="text-nowrap text-sm font-medium text-gray-900">Created by :</label>
				<input type="text" name="user" id="user" class="mx-2 italic text-gray-500 invoice-input-none " placeholder="{{ $recordHead->user }}" readonly>

			</div>

		</div>
		<!--  -->
		<div class="RIGHT p-2 col-span-5  rounded-lg">

			<div class="mb-2 col-span-5 grid grid-cols-5 gap-2">

				<div class="px-2 col-span-3 flex-y-center flex-j-end">
					<label class="font-bold">Total :</label>
				</div>
				<div class="col-span-2 flex">
					<input type="number" step="0.01" name="total" id="total" class="invoice-input" placeholder="&#2547; {{ number_format($recordHead->total, 2) }}" readonly>
				</div>

			</div>
			<!--  -->
			<div class="mb-2 col-span-5 grid grid-cols-5 gap-2">

				<div class="px-2 col-span-3 flex-y-center flex-j-end">
					<label class="font-bold">Tax (%):</label>
				</div>
				<div class="col-span-2 flex">
					<input type="number"  name="tax" id="tax" class="invoice-input " placeholder="{{ $recordHead->tax }} %" readonly>
				</div>

			</div>
			<!--  -->
			<div class="mb-2 col-span-5 grid grid-cols-5 gap-2">

				<div class="px-2 col-span-3 flex-y-center flex-j-end">
					<label class="font-bold">Discount :</label>
				</div>
				<div class="col-span-2 flex">
					<input type="number" step="0.01" name="discount" id="discount" class="invoice-input " placeholder="&#2547; {{ number_format($recordHead->discount, 2) }}" readonly>
				</div>

			</div>
			<!--  -->
			<div class="mb-2 col-span-5 grid grid-cols-5 gap-2">

				<div class="px-2 col-span-3 flex-y-center flex-j-end">
					<label class="font-bold">PAID :</label>
				</div>
				<div class="col-span-2 flex">
					<input type="number" step="0.01" name="paid" id="paid" class="invoice-input " placeholder="&#2547; {{ number_format($recordHead->paid, 2) }}" disabled>
				</div>

			</div>
			<!--  -->
			<div class="mb-2 col-span-5 grid grid-cols-6 gap-2 bg-invoice-navy text-white">

				<div class="px-2 col-span-3 flex-y-center flex-j-end">
					<label class="font-bold">BALANCE DUES :</label>
				</div>
				<div class="col-span-3 flex">
					<input type="number" step="0.01" name="dues" id="dues" class="invoice-input " placeholder="&#2547; {{ number_format($recordHead->dues, 2) }}" disabled>
				</div>

			</div>

		</div>

	</div>

</section>
<!---------------- Javascript ---------------->
<style>
	input::placeholder,
	textarea::placeholder { 
		font-size: 15px;
		color: #404955;
		text-align: center;
	}
</style>

</x-layouts.master>