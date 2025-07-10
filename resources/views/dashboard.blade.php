<x-layouts.master>
	
	<!-- <h1 class="text-5xl text-center text-red-900">Welcome to Neutra RMS</h1>
	<h3 class="text-lg text-center">Neutra AI Record Management System</h3> -->
	<h1 class="text-5xl text-center text-red-900">Welcome to Vendora ERP</h1>
	<h3 class="text-lg text-center">A Record Management System</h3>


	<!-- Tracks -->
	 <section class="my-10 flex flex-wrap justify-evenly">

		<div class="card w-48 p-2 text-center rounded-lg cursor-pointer bg-green-300 hover:bg-green-500">
			<h1>{{ $customers }} </h1>
			<h6>Major Customers</h6>
		</div>
		<!--  -->
		<div class="card w-48 p-2 text-center rounded-lg cursor-pointer bg-purple-300 hover:bg-purple-700">
			<h1>{{ $suppliers }} </h1>
			<h6>Supliers</h6>
		</div>
		<!--  -->
		<div class="card w-48 p-2 text-center rounded-lg cursor-pointer bg-orange-300 hover:bg-orange-700">
			<h1>{{ $admins }} </h1>
			<h6>Stocks</h6>
		</div>
		<!--  -->
		<div class="card w-48 p-2 text-center rounded-lg cursor-pointer bg-yellow-300 hover:bg-yellow-500">
			<h1>{{ $employees }} </h1>
			<h6>Employees</h6>
		</div>
		<!--  -->

	 </section>
	<!-- Tracks -->

	<!-- Accounts -->
	 <section class="my-10 flex flex-wrap justify-evenly">

		<div class="card w-56 p-2 text-center rounded-lg cursor-pointer bg-green-300 hover:bg-green-500">
			<h4 class="text-blue-900">{{ $invoiceAmnt }} </h4>
			<h6>Invoice Opened</h6>
		</div>
		<!--  -->
		<div class="card w-56 p-2 text-center rounded-lg cursor-pointer bg-purple-300 hover:bg-purple-500">
			<h4 class="text-green-900">{{ $receivedAmnt }} </h4>
			<h6>Payment Received</h6>
		</div>
		<!--  -->
		<div class="card w-56 p-2 text-center rounded-lg cursor-pointer bg-orange-300 hover:bg-orange-500">
			<h4 class="text-green-900">{{ $taxedAmnt }} </h4>
			<h6>Total Taxed</h6>
		</div>
		<!--  -->
		<div class="card w-56 p-2 text-center rounded-lg cursor-pointer bg-red-300 hover:bg-red-500">
			<h4 class="text-green-900">{{ $expenseAmnt }} </h4>
			<h6>Total Spent</h6>
		</div>
		<!--  -->

	 </section>
	<!-- Accounts -->


</x-layouts.master>