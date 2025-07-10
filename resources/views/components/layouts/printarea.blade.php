<x-partials.header />

<div class="mt-20 mb-4 mx-6 p-4 border-2 border-gray-500 border-dashed rounded-lg">
	<!--  -->
	<!---------------- Main Body Starts ---------------->
	<section class="grid-cols-12">

		<div id="Header" class="col-span-12 grid grid-cols-12">

			<div class="leftHeader col-span-4 px-2 py-1 flex-col flex-j-center">
				<img src="{{ asset('asset/images/icons') }}/neutra_logo_black.png" alt="logo_black" class="mx-4 my-2 h-12">
				<a href="https://maps.app.goo.gl/Ju3w6RMKMUnrTiQdA">
					<p class="text-sm text-center text-gray-500">Studio Office : Flat # 304, Plot # 20, R # 62, Gulshan-2, Dhaka-1212, Bangladesh</p>
				</a>
			</div>
			<!--  -->
			<div class="dummyDiv col-span-4 flex-xy-center">

				<label class="font-medium text-gray-500 text-nowrap">Project :&nbsp; </label>
				<p class="text-2xl font-bold text-indigo-700 text-wrap">&nbsp;{{ $fetchProjectDetails->name }}</p>

			</div>
			<!--  -->
			<div class="rightHeader col-span-4 px-2 py-1 flex-col flex-j-center">

				<h2 class="uppercase text-right">{{ $singleRecord->type }}</h2>
				<!---->
				<div class="mb-1 flex-y-center flex-j-end">
					<label class="block m-2 text-sm font-medium text-gray-500 text-nowrap">Reference/No. :&nbsp;</label>
					<h5 class="text-gray-500">{{ $singleRecord->ref_id }}</h5>
					<!-- <input type="text" name="ref_id" id="ref_id" class="invoice-input" placeholder="{{ $singleRecord->ref_id }}" style="width:16rem !important" readonly> -->
				</div>
				<!---->

			</div>

		</div>
		<!------------------>
		<hr class="col-span-12 my-2 h-1px ">
		<!------------------>
		<div id="identity" class="col-span-12 grid grid-cols-12">
			@php
				$singleRecord_from = empty($singleRecord->from) ? 'N/A' : $singleRecord->from;
				$singleRecord_to = empty($singleRecord->to) ? 'N/A' : $singleRecord->to;
				$singleRecord_ship = empty($singleRecord->ship) ? 'N/A' : $singleRecord->ship;
				$singleRecord_method = empty($singleRecord->method) ? 'N/A' : $singleRecord->method;
			@endphp

			<div class="identity_1 col-span-6 px-2 grid grid-cols-12">

				<h5 class="col-span-12 mb-6 font-bold text-left">Payment Info :</h5>
				<!---->
				<div class="col-span-5">
					<b class="underline">bKash</b>
					<p class="text-blue-900"><span class="font-bold">Number : </span>01919210210</p>
					<p class="text-xs text-gray-600">(1.85% charge will be added)</p>
				</div>
				<!---->
				<div class="col-span-7">
						<b class="underline">Bank Name : Eastern Bank PLC</b>
						<p class="text-sm">Account Name : <span class="text-gray-600">KHN</span> </p>
						<p class="text-sm">A/C No : <span class="text-gray-600">1041070000311</span> </p>
						<div class="flex">
							<p class="text-sm">Branch : <span class="text-gray-600">Gulshan.</span> </p>
							<p class="mx-6 text-sm">Routing : <span class="text-gray-600">0000000</span> </p>
						</div>
				</div>

			</div>
			<!--  -->
			<div class="identity_2 col-span-3 px-2 grid grid-cols-12">

				<table class="col-span-12 bg-green-100 rounded-lg">

					<tr class="w-full">
						<td class="w-1/2 text-sm text-right font-medium text-gray-500 text-nowrap">Ship To :&nbsp;</td>
						<td class="w-1/2 text-xl text-left font-medium text-wrap">&nbsp;{{ $singleRecord_ship }}</td>
					</tr>
					<!--  -->
					<tr class="w-full">
						<td class="w-1/2 text-sm text-right font-medium text-gray-500 text-nowrap">From :&nbsp;</td>
						<td class="w-1/2 text-xl text-left font-medium text-wrap">&nbsp;{{ $singleRecord_from }}</td>
					</tr>
					<!--  -->
					<tr class="w-full">
						<td class="w-1/2 text-sm text-right font-medium text-gray-500 text-nowrap">To :&nbsp;</td>
						<td class="w-1/2 text-xl text-left font-medium text-wrap">&nbsp;{{ $singleRecord_to }}</td>
					</tr>
					<!--  -->
					
				</table>	

			</div>
			<!--  -->
			<div class="identity_3 col-span-3 px-2 grid grid-cols-12">

				<table class="col-span-12 bg-fuchsia-100 rounded-lg">

					<tr class="w-full">
						<td class="w-1/2 text-sm text-right font-medium text-gray-500 text-nowrap">Record Date : &nbsp;</td>
						<td class="w-1/2 px-2 text-lg text-left font-medium text-wrap">&nbsp;{{ $singleRecord->date_made }}</td>
					</tr>
					<!--  -->
					<tr class="w-full">
						<td class="w-1/2 text-sm text-right font-medium text-gray-500 text-nowrap">Due Date : &nbsp;</td>
						<td class="w-1/2 px-2 text-lg text-left font-medium text-wrap">&nbsp;{{ $singleRecord->date_due }}</td>
					</tr>
					<!--  -->
					<tr class="w-full">
						<td class="w-1/2 text-sm text-right font-medium text-gray-500 text-nowrap">Payment Method : &nbsp;</td>
						<td class="w-1/2 px-2 text-lg text-left font-medium text-wrap">&nbsp;{{ $singleRecord_method }}</td>
					</tr>
					<!--  -->
					
				</table>	

			</div>
			<!--  -->

		</div>
		<!------------------>
		<hr class="col-span-12 my-2 h-1px ">
		<!------------------>
		<div id="Accounts" class="col-span-12 grid grid-cols-12">

			<div class="col-span-12 grid grid-cols-12 pl-4 pr-1 py-2 bg-invoice-navy text-white text-sm rounded">
				<p class="col-span-1 text-center">SN</p>
				<p class="col-span-6 text-center">Particulars</p>
				<p class="col-span-1 text-center">Quantity</p>
				<p class="col-span-2 text-center">Rate/Unit Price</p>
				<p class="col-span-2 text-center">Amount</p>
			</div>
			@php
				$amount_1 = number_format(($singleRecord->qty_1 * $singleRecord->rate_1), 2, '.', '');
				$amount_2 = number_format(($singleRecord->qty_2 * $singleRecord->rate_2), 2, '.', '');
				$amount_3 = number_format(($singleRecord->qty_3 * $singleRecord->rate_3), 2, '.', '');
			@endphp
			<!---->
			<table class="col-span-12 my-4">

				@for ($i = 1; $i <= 3; $i++)
					@if(empty($singleRecord->{'item_'.$i}))
						@break
					@endif
					<tr class="w-full mb-2 grid grid-cols-12">
						<td class="col-span-1 text-center">{{ $i }}</td>
						<td class="col-span-6 text-center">{{ $singleRecord->{'item_'.$i} }}</td>
						<td class="col-span-1 text-center">{{ $singleRecord->{'qty_'.$i} }}</td>
						<td class="col-span-2 text-center">BDT {{ $singleRecord->{'rate_'.$i} }}</td>
						<td class="col-span-2 text-center">= BDT {{ ${'amount_'.$i} }}</td>
					</tr>
				@endfor

			</table>

		</div>
		<!------------------>
		<hr class="col-span-12 my-2 h-1px ">
		<!------------------>
		<div id="Results" class="col-span-12 grid grid-cols-12">

			<div class="LEFT mt-4 p-2 col-span-7 grid grid-cols-12  rounded-lg">

				<div class="col-span-12 mb-1">
					<label class="font-semibold">Notes :</label>
					<p class="block p-2.5 w-full text-sm text-gray-900 whitespace-pre-wrap">{{ $singleRecord->note }}</p>
				</div>
				<!--  -->
				<div class="col-span-12 mb-1">
					<label class="font-semibold">Terms & Conditions:</label>
					<p class="block p-2.5 w-full text-sm text-gray-900 whitespace-pre-wrap">{{ $singleRecord->terms }}</p>
				</div>
				<!--  -->

			</div>
			<!--  -->
			<div class="RIGHT p-2 col-span-5 grid grid-cols-5">

				<div class="dummyDiv col-span-1"></div>
				<!--  -->
				<table class="col-span-4">

					<tr class="w-full mb-2">
						<td class="w-1/2 font-semibold text-right"> Total : &nbsp;</td>
						<td class="w-1/2 text-center"><span class="px-4 py-2 font-bold bg-gray-50 border rounded-lg">&nbsp;{{ number_format($singleRecord->total, 2) }} TK</span></td>
					</tr>
					<!---->
					<tr class="w-full">
						<td class="w-1/2 py-2 font-semibold text-right"> VAT/Tax (%): &nbsp;</td>
						<td class="w-1/2 py-2 text-center"><span class="">&nbsp;{{ number_format($singleRecord->tax, 2) }} TK</span></td>
					</tr>
					<!---->
					<tr class="w-full">
						<td class="w-1/2 py-2 font-semibold text-right"> Discount : &nbsp;</td>
						<td class="w-1/2 py-2 text-center"><span class="">&nbsp;{{ number_format($singleRecord->discount, 2) }} TK</span></td>
					</tr>
					<!---->
					<tr class="w-full mt-4">
						<td class="w-1/2 py-2 font-semibold text-right"> PAID : &nbsp;</td>
						<td class="w-1/2 py-2 text-center"><span class="">&nbsp;{{ number_format($singleRecord->paid, 2) }} TK</span></td>
					</tr>
					<!---->
					<tr class="w-full mt-4">
						<td class="w-1/2 py-2 font-semibold text-right bg-invoice-navy text-white"> BALANCE DUES : &nbsp;</td>
						<td class="w-1/2 py-2 text-center font-bold text-lg"><span class="">&nbsp;{{ number_format($singleRecord->dues, 2) }} TK</span></td>
					</tr>
					<!---->

				</table>
				<!--  -->

			</div>

		</div>
		<!------------------>
		<div class="Signature mt-32 col-span-12 grid grid-cols-12">

			<div class="dummyDiv col-span-1"></div>
			<!--  -->
			<div class="col-span-2">
				<div class="w-full" style="border-top: 1px dashed black"></div>
				<p class="text-center">Authorized Signature</p>
			</div>
			<!--  -->
			<div class="dummyDiv col-span-1"></div>
			<!--  -->
			<div class="col-span-2">
				<div class="w-full" style="border-top: 1px dashed black"></div>
				<p class="text-center">Client Signature</p>
			</div>
			
			<!--  -->
			<div class="dummyDiv col-span-6"></div>

		</div>
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
	<!--  -->
</div>

<x-partials.footer />