<x-layouts.master>
	<h1 class="mb-2 text-5xl text-center text-red-900">Displaying All Parties</h1>
	<!-- error and success message display -->
	<x-alert-component/>
	<!-- error and success message display ends -->
	 
	<!-- ------------------- -->
	<section id="showTableArea">

		<div class="relative shadow-md sm:rounded-lg">
			<div class="flex items-center justify-end flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-2 bg-white dark:bg-gray-900">
				<!-- create project button -->
				<div class="flex">
					<!-- Modal toggle -->
					<button data-modal-target="createProjectModal" data-modal-toggle="createProjectModal" class="invoice-button bg-blue-700 hover:bg-blue-900" type="button">
						Create Party
					</button>
					<!--  -->
					<label for="table-search" class="sr-only hidden">Search</label>
					<div class="relative hidden">
						
						<div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
							<svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
								<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
							</svg>
						</div>
						<input type="text" id="table-search-users" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for users">

					</div>
				</div>
				
			</div>
			<!--  -->
			<table id="partyTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 overflow-x-auto">
				<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
					<tr class="w-full ugrid-16 text-center">
						<th scope="col" class="u-colspan-1 px-2 py-2">
							SN
						</th>
						<th scope="col" class="u-colspan-1 px-2 py-2 ">
							Image
						</th>
						<th scope="col" class="u-colspan-2 px-2 py-2 ">
							Name
						</th>
						<th scope="col" class="u-colspan-1 px-2 py-2">
							Relation
						</th>
						<th scope="col" class="u-colspan-2 px-2 py-2">
							Party ID
						</th>
						<th scope="col" class="u-colspan-2 px-2 py-2">
							Current Balance
							<br>
							Opening Balance
						</th>
						<th scope="col" class="u-colspan-2 px-2 py-2">
							Address
						</th>
						<th scope="col" class="u-colspan-3 px-2 py-2">
							Description
						</th>
						<th scope="col" class="u-colspan-2 px-2 py-2">
							Action
						</th>
					</tr>
				</thead>
				<!--  -->
				<tbody>
					@foreach($party as $index => $item)
					<tr class="w-full ugrid-16 text-center bg-white border-b border-gray-200 hover:bg-gray-50 cursor-pointer" onclick="window.location.href=`{{ route('singleProject', $item->id) }}`;">
						<td scope="col" class="u-colspan-1 px-2 py-2">
							{{ $index + 1 }}
						</td>
						<td scope="col" class="u-colspan-1 px-2 py-2">
							@if(empty($item->image))
								<div class="w-12 h-12 rounded-full bg-green-700 overflow-hidden text-wrap text-center text-xs text-gray-200 flex-xy-center">
									No Image
								</div>
							@else
								<img src="{{ asset($item->image) }}" alt="project_image" class="w-12 h-12 rounded-full">
							@endif
							
						</td>
						<td scope="col" class="u-colspan-2 px-2 py-2 ">
							{{ $item->name }}
						</td>
						<td scope="col" class="u-colspan-1 px-2 py-2">
							{{ $item->type }}
						</td>
						<td scope="col" class="u-colspan-2 px-2 py-2 text-xs">
							{{ $item->prt_id }}
						</td>
						<td scope="col" class="u-colspan-2 px-2 py-2">
							{{ $item->currentBal }}
							<br>
							{{ $item->openingBal }}
						</td>
						<td scope="col" class="u-colspan-2 px-2 py-2">
							{{ $item->address . ', ' . $item->state . ', ' . $item->country }}
						</td>
						<td scope="col" class="u-colspan-3 px-2 py-2">
							{{ Str::limit($item->description, 60, '...') }}
						</td>
						<td scope="col" class="u-colspan-2 px-2 py-2" style="display: flex; justify-content: center;">
							<!-- Modal toggle -->
							<a type="button" data-modal-target="editPartyModal" data-modal-show="editPartyModal" class="editButton invoice-button bg-green-500 hover:bg-green-900" data-projection='@json($item)' data-url="{{ route('editParty', $item->prt_id) }}" onclick="event.stopPropagation(); deleteImgID('{{ $item->id }}')">{!! \App\Helpers\Fontawesome::edit(['class' => 'w-4 h-4 text-gray-50']) !!}</a>
							<!--  -->
							<a type="button" data-modal-target="deletePartyModal" data-modal-show="deletePartyModal" class="invoice-button bg-red-500 hover:bg-red-900" onclick="event.stopPropagation(); deleteParty('{{ $item->prt_id }}');">{!! \App\Helpers\Fontawesome::trash(['class' => 'w-4 h-4 text-gray-50']) !!}</a>
						</td>
					</tr>
					@endforeach

				</tbody>
				
			</table>

		</div>

	</section>
	<!-- ------------------- -->
	<section id="editProjectModalArea">

		<!-- Edit Project Modal -->
		<div id="editPartyModal" tabindex="-1" aria-hidden="true" class="modifyModal hidden md:inset-0 h-[calc(100%-1rem)]">
			<div class="relative p-4 w-full max-w-2xl max-h-full">
				<!-- Modal content -->
				<div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">

				  	<!-- Modal header Starts -->
						<div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600 border-gray-200">
							<h3 class="text-lg font-semibold text-gray-900 dark:text-white">
								Update Existing Party
							</h3>
							<button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="editPartyModal" aria-hidden="true">
								{!! \App\Helpers\Fontawesome::close(['class' => 'w-5 h-5 text-gray-500']) !!}
								<span class="sr-only">Close modal</span>
							</button>
						</div>
				  	<!-- Modal header Ends -->

					<!-------Edit Modal body Starts------->
					<form class="p-4 md:p-5" method="POST"  id="partyForm" enctype="multipart/form-data">
						@csrf
						<div class="grid gap-4 mb-4 grid-cols-2">

							<div class="col-span-2 sm:col-span-1">
								<label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Party Name</label>
								<input type="text" name="name" id="nameEdit" class="invoice-input" placeholder="255 characters max" value="{{ old('name') }}" >
							</div>
							<!--  -->
							<div class="col-span-2 sm:col-span-1 flex-j-center">
								<img id="imageEdit" src="" alt="" class=" h-16"> &nbsp;
									<a onclick="deleteImg()">{!! \App\Helpers\Fontawesome::trash(['class' => 'w-4 h-4 text-red-500 cursor-pointer']) !!}</a>
							</div>
							<!-- -------------- -->
							<div class="col-span-2 sm:col-span-1">
								<label for="country" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Country</label>

								<select id="countryEdit" name="country" style="width: 100%; padding: 10px;"></select>

								<span id="searchError" class="text-red-500"></span>
							</div>
							<!--  -->
							<div class="col-span-2 sm:col-span-1">
								<label for="state" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">District/State/Region</label>

								<select id="stateEdit" name="state" style="width: 100%; padding: 10px;"></select>
								<span id="searchError" class="text-red-500"></span>
							</div>
							<!-- ----------------- -->
							<div class="col-span-2">
								<label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Area/Address</label>
								<input type="text" name="address" id="addressEdit" class="invoice-input" placeholder="255 characters max" value="{{ old('address') }}">
							</div>
							<!-- ----------------------- -->
							<div class="col-span-2 sm:col-span-1">
								<label for="openingBal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Opening Balance</label>

								<input type="number" name="openingBal" id="openingBalEdit" value="{{ old('openingBal') }}"class="invoice-input" placeholder="Leave 0.00 if not applicable">
							</div>
							<!--  -->
							<div class="col-span-2 sm:col-span-1">
								<label for="currentBal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Final Balance</label>

								<input type="number" name="currentBal" id="currentBalEdit" class="invoice-input" value="{{ old('currentBal') }}">
							</div>
							<!-- ----------------------- -->
							<div class="col-span-2 sm:col-span-1">
								<label for="updator" class="mb-2 block text-sm text-nowrap font-medium text-gray-900 dark:text-white">Updating by: </label>

								<input type="text" name="updator" id="updatorEdit" class="invoice-input" value="{{ Auth::user()->name }}" readonly>
							</div>
							<!--  -->
							<div class="col-span-2 sm:col-span-1">
								<label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type/Relation</label>

								<select id="typeEdit" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" value="{{ old('type') }}">
									<option value="supplier" selected>Supplier (e.g., grocery, raw material)</option>
									<option value="customer">Customer/Payee (e.g., who pays us)</option>
									<option value="employee">Employee (e.g., salary receiver)</option>
									<option value="admin">Employer/Admin (e.g., salary payer)</option>
									<option value="service">Service(e.g., utility, rent)</option>
									<option value="other">Other/Client</option>
								</select>
							</div>

							<!-- --------------------- -->
							<div class="col-span-2">
								<label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Party Description</label>

								<textarea id="descriptionEdit" name="description" rows="2" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="max 255 characters">{{ old('description') }}</textarea>
							</div>
							<!--  -->
							<div class="col-span-2">
								<label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload Party Image</label>

								<input id="imageEdit" type="file" name="image" class="text-sm text-blue-800 bg-yellow-100 rounded-lg" value="{{ old('image') }}">
							</div>
							<!--  -->

						</div>
						<div class="w-full flex justify-end">
							<button type="submit" class="invoice-button bg-green-600 hover:bg-green-800 flex-xy-center">
								{!! \App\Helpers\Fontawesome::plus(['class' => 'w-4 h-4 text-gray-50']) !!} &nbsp;Add New Party
							</button>
						</div>

						
					</form>
					<!-------Create Modal body Ends------->
				</div>
			</div>
		</div>

	</section>
	<!-- ------------------- -->
	<section id="createProjectModalArea">

		<!-- Create Project Modal -->
		<div id="createProjectModal" tabindex="-1" aria-hidden="true" class="modifyModal hidden md:inset-0 h-[calc(100%-1rem)]">
			<div class="relative p-4 w-full max-w-2xl max-h-full">
				<!-- Modal content -->
				<div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">

				  	<!-- Modal header Starts -->
						<div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600 border-gray-200">
							<h3 class="text-lg font-semibold text-gray-900 dark:text-white">
								Create New Party
							</h3>
							<button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="createProjectModal" aria-hidden="true">
								{!! \App\Helpers\Fontawesome::close(['class' => 'w-5 h-5 text-gray-500']) !!}
								<span class="sr-only">Close modal</span>
							</button>
						</div>
				  	<!-- Modal header Ends -->

					<!-------Create Modal body Starts------->
					<form class="p-4 md:p-5" action="{{ route('createParty') }}" method="POST"  id="partyForm" enctype="multipart/form-data">
						@csrf
						<div class="grid gap-4 mb-4 grid-cols-2">

							<div class="col-span-2">
								<label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Party Name</label>
								<input type="text" name="name" id="name" class="invoice-input" placeholder="255 characters max" value="{{ old('name') }}" >
							</div>
							<!-- -------------- -->
							<div class="col-span-2 sm:col-span-1">
								<label for="country" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Country</label>

								<select id="country" name="country" value="{{ old('country') }}"
									class="countryClass " style="width: 100%; padding: 10px;">
								</select>
								<span id="searchError" class="text-red-500"></span>
							</div>
							<!--  -->
							<div class="col-span-2 sm:col-span-1">
								<label for="state" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">District/State/Region</label>

								<select id="state" name="state" value="{{ old('state') }}"
									class="countryClass " style="width: 100%; padding: 10px;">
								</select>
								<span id="searchError" class="text-red-500"></span>
							</div>
							<!-- ----------------- -->
							<div class="col-span-2">
								<label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Area/Address</label>
								<input type="text" name="address" id="address" class="invoice-input" placeholder="255 characters max" value="{{ old('address') }}">
							</div>
							<!-- ----------------------- -->
							<div class="col-span-2 sm:col-span-1">
								<label for="openingBal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Opening Balance</label>

								<input type="number" name="openingBal" id="openingBal" value="{{ old('openingBal') }}"class="invoice-input" placeholder="Leave 0.00 if not applicable">
							</div>
							<!--  -->
							<div class="col-span-2 sm:col-span-1">
								<label for="currentBal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Final Balance</label>

								<input type="number" name="currentBal" id="currentBal" class="invoice-input" value="{{ old('currentBal') }}">
							</div>
							<!-- ----------------------- -->
							<div class="col-span-2 sm:col-span-1">
								<label for="user" class="mb-2 block text-sm text-nowrap font-medium text-gray-900 dark:text-white">Creating by: </label>

								<input type="text" name="user" id="user" class="invoice-input" value="{{ Auth::user()->name }}" value="{{ old('user') }}" readonly>
							</div>
							<!--  -->
							<div class="col-span-2 sm:col-span-1">
								<label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type/Relation</label>

								<select id="type" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" value="{{ old('type') }}">
									<option value="supplier" selected>Supplier (e.g., grocery, raw material)</option>
									<option value="customer">Customer/Payee (e.g., who pays us)</option>
									<option value="employee">Employee (e.g., salary receiver)</option>
									<option value="admin">Employer/Admin (e.g., salary payer)</option>
									<option value="service">Service(e.g., utility, rent)</option>
									<option value="other">Other/Client</option>
								</select>
							</div>

							<!-- --------------------- -->
							<div class="col-span-2">
								<label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Party Description</label>

								<textarea id="description" name="description" rows="2" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="max 255 characters">{{ old('description') }}</textarea>
							</div>
							<!--  -->
							<div class="col-span-2">
								<label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload Project Image</label>

								<input type="file" name="image" class="text-sm text-blue-800 bg-yellow-100 rounded-lg" value="{{ old('image') }}">
							</div>
							<!--  -->

						</div>
						<div class="w-full flex justify-end">
							<button type="submit" class="invoice-button bg-green-600 hover:bg-green-800 flex-xy-center">
								{!! \App\Helpers\Fontawesome::plus(['class' => 'w-4 h-4 text-gray-50']) !!} &nbsp;Add New Party
							</button>
						</div>

						
					</form>
					<!-------Create Modal body Ends------->
				</div>
			</div>
		</div>

	</section>
	<!-- ------------------- -->
	 <section id="deletePartyArea">

		<!-- Create Project Modal -->
		<div id="deletePartyModal" tabindex="-1" aria-hidden="true" class="modifyModal hidden md:inset-0 h-[calc(100%-1rem)]">
			<div class="relative p-4 w-full max-w-2xl max-h-full">

				<!-- Modal content -->
				<div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">

					<button type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="deletePartyModal">
						{!! \App\Helpers\Fontawesome::close(['class' => 'w-5 h-5 text-gray-500']) !!}
						<span class="sr-only">Close modal</span>
					</button>

            	<svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
					</svg>
            	
					<p class="mb-4 text-gray-500 dark:text-gray-300">Are you sure you want to delete this Party?</p>

            	<div class="flex justify-center items-center space-x-4">
						
						<button data-modal-toggle="deletePartyModal" type="button" class="invoice-button bg-green-600" >
							No, cancel
						</button>
						<button type="submit" class="invoice-button bg-red-600" onclick="deleteConfirmation(1)">
							Yes, I'm sure
						</button>

           		</div>
        		</div>
			</div>			
		</div>			

	 </section>
	<!-- ------------------- -->
	<style>
		.select2-selection {
			padding: 0px 10px !important;
			background-color: #e5e5e5;
			border: 1px solid #ccc;
			color: #333;
			font-size: 13px;
			border-radius: 8px;
		}
		.select2-selection__rendered {
			padding: 0 !important;
		}

		#partyTable thead th,
		#partyTable tbody td{
			display: inline-grid;
			align-items: center;
		}

	</style>
	<!-- ------------------- -->
	<script id="js_for_edit">
		function openEditModal(button) {
			let party = JSON.parse(button.dataset.projection);

			let editForm = document.getElementById('partyForm');
			editForm.action = button.dataset.url;

			// Populate input fields
			document.getElementById('nameEdit').value = party.name ?? '';
			document.getElementById('addressEdit').value = party.address ?? '';
			document.getElementById('openingBalEdit').value = party.openingBal ?? '';
			document.getElementById('currentBalEdit').value = party.currentBal ?? '';
			document.getElementById('descriptionEdit').value = party.description ?? '';
			document.getElementById('userEdit').value = party.user ?? '';
			document.getElementById('typeEdit').value = party.type ?? '';

			// Reset and set Country
			if (party.country) {
				$('#countryEdit').empty().append(new Option(party.country_text ?? 'Selected Country', party.country, true, true)).trigger('change');
			} else {
				$('#countryEdit').val(null).trigger('change');
			}

			// Reset and set State
			if (party.state) {
				$('#stateEdit').empty().append(new Option(party.state_text ?? 'Selected State', party.state, true, true)).trigger('change');
			} else {
				$('#stateEdit').val(null).trigger('change');
			}

			// Set Image
			if (party.image) {
				document.getElementById('imageEdit').src = "{{ asset('') }}" + party.image;
			} else {
				document.getElementById('imageEdit').alt = "No Image";
			}
		}

		// Attach click listeners
		document.querySelectorAll('[data-modal-target="editPartyModal"]').forEach(button => {
			button.addEventListener('click', function () {
				openEditModal(this);
			});
		});

		// Image delete
		let delete_img_id = null;
		function deleteImgID(x) {
			delete_img_id = x;
		}
		function deleteImg() {
			if (confirm("Do you want to delete this party image? This can't be undone!")) {
				window.location.href = `/deleteProjectImg/${delete_img_id}`;
			}
		}

		// Party delete
		let delete_ID = null;
		function deleteParty(x) {
			delete_ID = x;
		}
		function deleteConfirmation(confirmDelete) {
			if (confirmDelete == 1) {
				window.location.href = `/party/delete/${delete_ID}`;
			} else {
				window.location.href = `/party`;
			}
		}
	</script>

	<script id="ajax_for_edit">
		$(document).ready(function() {
			// Initialize Country select2
			$('#countryEdit').select2({
				placeholder: 'Select a country',
				allowClear: true,
				ajax: {
					url: "{{ route('get_country') }}",
					type: "post",
					delay: 250,
					dataType: 'json',
					data: function (params) {
						return {
							name: params.term,
							"_token": "{{ csrf_token() }}",
						};
					},
					processResults: function(data){
						return {
							results: data.results
						};
					},
					cache: true
				},
			});

			// Initialize State select2
			$('#stateEdit').select2({
				placeholder: 'Select a district/state/region',
				allowClear: true,
			});

			// When Country changes, load corresponding States
			$('#countryEdit').on('change', function () {
				let countryId = $(this).val();

				if (countryId) {
					$.ajax({
						url: "{{ route('get_state', ['id' => '__ID__']) }}".replace('__ID__', countryId),
						type: "post",
						dataType: "json",
						data: {
							country_id: countryId,
							"_token": "{{ csrf_token() }}",
						},
						success: function (data) {
							$('#stateEdit').empty();
							$('#stateEdit').append('<option value="">Select a state</option>');

							$.each(data, function (key, value) {
								$('#stateEdit').append('<option value="'+ value.id +'">'+ value.text +'</option>');
							});

							$('#stateEdit').trigger('change');
						}
					});
				} else {
					$('#stateEdit').empty().trigger('change');
				}
			});
		});
	</script>


	<script id="ajax_for_create">
		$(document).ready(function() {

			$('#country').select2({
				placeholder: 'Select a country',
				allowClear: true,
				ajax: {
					url: "{{ route('get_country') }}",
					type: "post",
					delay: 250,
					dataType: 'json',
					data: function (params) {
						return {
							name: params.term,
							"_token": "{{ csrf_token() }}",
						};
					},
					processResults: function(data){
						return {
							results: data.results
						};
					},
					cache: true
				},
			});

			$('#state').select2({
				placeholder: 'Select a district/state/region',
				allowClear: true,
			});

			$('#country').on('change', function () {
				let countryId = $(this).val(); // Now val() is just a string/id, not array

				if (countryId) { // Important: check if country selected
					$.ajax({
						url: "{{ route('get_state', ['id' => '__ID__']) }}".replace('__ID__', countryId), // Fixed URL
						type: "post",
						dataType: "json",
						data: {
							country_id: countryId, // Correct variable for country_id
							"_token": "{{ csrf_token() }}",
						},
						success: function (data) {
							$('#state').empty(); // Clear old options

							$('#state').append('<option value="">Select a state</option>');

							$.each(data, function (key, value) {
								// Use 'text' for the option display and 'id' for the value
								$('#state').append('<option value="'+ value.id +'">'+ value.text +'</option>');
							});

							// Trigger Select2 refresh
							$('#state').trigger('change');
						}
					});
				} else {
					$('#state').empty(); // If no country selected, clear states
				}
			});

		});
	</script>





</x-layouts.master>