<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Download Record</title>
	<link href='https://fonts.googleapis.com/css?family=Barlow&subset=latin-ext' rel='stylesheet'>
	<link rel="stylesheet" href="/public/css/record_pdf.css">
</head>
	<style>
		@page { margin: 0px !important; padding: 0px !important;}
		@font-face{
			font-family: "Cedarville Cursive";
			src:  url("fonts/CedarvilleCursive-Regular.ttf") format("truetype");
			font-weight: 400;
			font-style: normal;
		}
		/* this page strictly uses custom made css classes only for pdf pages. Flowbite classes won't work here. */
	</style>

<body>
	<!---------------- Main Body Starts ---------------->
	<section class="my-40p px-4">

		
		<div class="HEADER w-full">

			<table class="w-full">

				<tr class="w-full text-gray-500">
				  <td class="w-33 text-center">
					<img src="/public/asset/images/icons/neutra_logo_black.png" alt="logo_black" class="imgStyle">
				  </td>
				  <td class=""></td>
				  <td class="w-33 recordType text-navy">{{ $singleRecord->type }}</td>
				  <!-- <td class="w-33">
					<b class="recordType text-navy">invoice</b>
				  </td> -->
				</tr>
				<!--  -->
				<tr class="w-full">
				  <td class="w-33 officeAddress" style="padding: 16px 0px 0px 0px;">Studio Office : Flat # 304, Plot # 20, R # 62, Gulshan-2, Dhaka-1212, Bangladesh</td>
				  <td class=""></td>
				  <td class="w-33">
						<p class="font-14 identityRight">Reference/No :&nbsp;<b class="font-18 border">{{ $singleRecord->ref_id }}</b></p>
				  </td>
				</tr>

			 </table>

		</div>
		<!------------------>
		<div class="hr-line"></div>
		<!------------------>
		<div class="IDENTITY w-full">

			<table class="w-full">

				<tr class="w-full">
					<td class="w-40">
						<p class="identityLeft">PID :&nbsp;<b class="font-16 border">{{ $fetchProjectDetails->p_id }}</b>&nbsp; Project :&nbsp;<b class="font-16 border">{{ $fetchProjectDetails->name }}</b></p>
					</td>
					 <td class="w-30">
						<p class="identityRight">From :&nbsp;<b class="font-16">{{ $singleRecord->from }}</b></p>
					 </td>
					 <td class="w-30">
						<p class="identityRight">Record Date :&nbsp;<b class="font-16 italic text-orange">{{ $singleRecord->date_made }}</b></p>
					 </td>
				</tr>
				<!--  -->
				<tr class="w-full">
					<td rowspan="2">
						<p class="identityRight">To :&nbsp;<b class="font-16">{{ $singleRecord->to }}</b></p>
					</td>
					<td rowspan="2">
						<p class="identityRight">Ship To :&nbsp;<b class="font-16">{{ $singleRecord->ship ?? 'N/A' }}</b></p>
					</td>
					<td class="text-right">
						<p class="identityRight">Due Date :&nbsp;<b class="font-16 italic text-orange">{{ $singleRecord->date_due }}</b></p>
					</td>
				</tr>
				<!--  -->
				<tr class="w-full">
					<!-- <td>3,1</td> rowspanned -->
					<!-- <td>3,2</td> rowspanned -->
					<td>
						<p class="identityRight">Payement Method :&nbsp;<b class="font-16">{{ $singleRecord->method }}</b></p>
					</td>
				</tr>

		  </table>
		  
		</div>
		<!------------------>
		<!-- <div class="hr-line"></div> -->
		<!------------------>
		<div class=" ACCOUNT-HEAD accountHeader">

			<table class="w-full">
				<tr class="w-full text-center">
					<td class="w-5">SN |</td>
					<td class="w-55">| Particulars |</td>
					<td class="w-10">| Quantity |</td>
					<td class="w-15">| Rate/Unit Price |</td>
					<td class="w-15">| Amount |</td>
				</tr>
			</table>

		</div>
		<!------------------>
		<div class=" ACCOUNT" style="width: 98%; margin: 0px auto;">

			@php
				$amount_1 = number_format(($singleRecord->qty_1 + $singleRecord->rate_1), 2, '.', '');
				$amount_2 = number_format(($singleRecord->qty_2 + $singleRecord->rate_2), 2, '.', '');
				$amount_3 = number_format(($singleRecord->qty_3 + $singleRecord->rate_3), 2, '.', '');
			@endphp
			<table class="w-full">
				<tr class="w-full text-center border">
					<td class="w-5 text-navy fw-bolder">1</td>
					<td class="w-55">{{ $singleRecord->item_1 }}</td>
					<td class="w-10">{{ $singleRecord->qty_1 }}</td>
					<td class="w-15">BDT {{ $singleRecord->rate_1 }}</td>
					<td class="w-15">BDT {{ $amount_1}}</td>
				</tr>
				@for ($i = 2; $i <= 3; $i++)
					@if(empty($singleRecord->{'item_'.$i}))
						@break
					@endif
					<tr class="w-full text-center">
						<td class="w-5 fw-bolder text-navy">{{ $i }}</td>
						<td class="w-55">{{ $singleRecord->{'item_'.$i} }}</td>
						<td class="w-10">{{ $singleRecord->{'qty_'.$i} }}</td>
						<td class="w-15">BDT {{ $singleRecord->{'rate_'.$i} }}</td>
						<td class="w-15">BDT {{ ${'amount_'.$i} }}</td>
					</tr>
				@endfor
			</table>

		</div>
		<!------------------>
		<div class="hr-dash" style="margin:48px 0px 0px 50%; width: 50% !important;"></div>
		<!------------------>
		<div class=" RESULTS" style="width: 98%; margin: 0px auto;">

			<table>
				<tr class="w-full text-center">

					<td style="min-width: 420px; max-width: 420px;">

						<div class="w-full text-left">
							<b>Notes: </b>
							<p style="width: 75%; padding:8px; border: 1px dashed #6B7280;">{{ $singleRecord->note }}</p>
						</div>
						<div class="w-full text-left" style="margin-top: 10px;">
							<p><b>Terms & Conditions: </b></p>
							<li style="margin-left: 16px;">{{ $singleRecord->terms }}</li>
						</div>

					</td>
					<!--  -->
					<td" style="width: 200px;">
						<p class="text-right font-16"><b>Total :</b></p>
						<p class="text-right font-14">
							<b>Tax (%) :</b>
						</p>
						<p class="text-right font-14"><b>Discount  :</b></p>
						<p class="text-right font-16"><b>PAID  :</b></p>
						<p class="text-right w-full" style="padding:8px 4px; background-color: #132144; color: white"><b>Balance Dues (Tk):</b></p>
					</td>
					<!--  -->
					<td style="width: 150px;">
						<p class="text-navy fw-bolder">{{ $singleRecord->total }}</p>
						<p class="text-red font-14">+ {{ $singleRecord->tax }}</p>
						<p class="text-green font-14">- {{ $singleRecord->discount }}</p>
						<p class="italic font-16">- {{ $singleRecord->paid }}</p>
						<p class="font-18 fw-bolder text-navy" style="padding:8px 4px;">{{ $singleRecord->dues }}</p>
					</td>
				</tr>
			</table>

		</div>
		<!------------------>
		<table class="SIGNATURE w-full my-100p">
			<tr class="w-full">
				<td class="dummyDiv w-10"></td>
				<td class="w-20 overline">
					<p>Signature</p>
				</td>
				<td class="dummyDiv w-10"></td>
				<td class="w-20 overline">
					<p>Client</p>
				</td>
				<td class="dummyDiv w-40"></td>
			</tr>
		</table>
		<!------------------>

	</section>
	<!---------------- Main Body Ends ---------------->
</body>

</html>

