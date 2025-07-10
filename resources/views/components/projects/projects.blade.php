<x-layouts.master>
	<h1 class="mb-2 text-5xl text-center text-red-900">Displaying All Projects</h1>
	<!-- error and success message display -->
	<x-alert-component/>
	<!-- error and success message display ends -->
	 
	<!-- ------------------- -->
	<section id="showTableArea">

		<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
			<div class="flex items-center justify-end flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 bg-white dark:bg-gray-900">
				<!-- create project button -->
				<div class="flex">
					<!-- Modal toggle -->
					<button data-modal-target="createProjectModal" data-modal-toggle="createProjectModal" class="invoice-button bg-blue-700 hover:bg-blue-900" type="button">
						Create Project
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
			<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
				<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
					<tr>
						<!-- <th scope="col" class="p-4">
							<div class="flex items-center">
								<input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
								<label for="checkbox-all-search" class="sr-only">checkbox</label>
							</div>
						</th> -->
						<th scope="col" class="px-6 py-3">
							SN
						</th>
						<th scope="col" class="px-6 py-3 bg-yellow-100">
							Project Name
						</th>
						<th scope="col" class="px-6 py-3">
							Project ID
						</th>
						<th scope="col" class="px-6 py-3">
							Status
						</th>
						<th scope="col" class="px-6 py-3">
							Created by
						</th>
						<th scope="col" class="px-6 py-3">
							Created at
						</th>
						<th scope="col" class="px-6 py-3">
							Action
						</th>
					</tr>
				</thead>
				<!--  -->
				<tbody>
					@foreach($projectData as $project)
					<tr class="bg-white border-b border-gray-200 hover:bg-gray-50 cursor-pointer" onclick="window.location.href=`{{ route('singleProject', $project->id) }}`;">
						
						<td class="w-4 p-4">
							<div class="flex flex-xy-center">
								<label for="checkbox-table-search-1" class="text-black">{{ $loop->iteration }}</label>
							</div>
						</td>
						<!--  -->
						<th scope="row" class="flex items-center px-3 py-3 text-gray-900  whitespace-nowrap">

							<img class="w-10 h-10 rounded-full hidden" src="/docs/images/people/profile-picture-1.jpg" alt="Jese image">
							@if(empty($project->image))
								<div class="w-12 h-12 rounded-full bg-green-700 overflow-hidden text-wrap text-center text-xs text-gray-200 flex-xy-center">
									No Image
								</div>
							@else
								<img src="{{ asset($project->image) }}" alt="project_image" class="w-12 h-12 rounded-full">
							@endif
							<!--  -->
							<div class="ps-3">
								<div class="text-base font-semibold">{{ $project->name }}</div>
								<div class="font-normal text-gray-500">{{ Str::limit($project->description, 40) }}</div>
							</div>

						</th>
						<!--  -->
						<td class="px-6 py-3">
							{{ $project->p_id }}
						</td>
						<!--  -->
						<td class="px-6 py-3">
							<div class="flex items-center">
								<div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>{{ $project->status }}
							</div>
						</td>
						<!--  -->
						<td class="px-6 py-4">
							<div class="flex items-center">
								<p>{{ $project->user }}</p>
							</div>
						</td>
						<!--  -->
						<td class="px-6 py-4">
							<div class="flex items-center">
								<p class="text-gray-400 italic">{{ $project->created_at->format('d M \'y \\a\\t g:i A') }}</p>
							</div>
						</td>
						<!--  -->
						<td class="px-6 py-4 flex-xy-center gap-4">
							<!-- Modal toggle -->
							<a type="button" class="editButton" data-modal-target="editUserModal" data-modal-show="editUserModal" data-project='@json($project)' data-url="{{ route('editProject', $project->id) }}" onclick="event.stopPropagation(); deleteImgID('{{ $project->id }}')">{!! \App\Helpers\Fontawesome::edit(['class' => 'w-4 h-4 text-green-500']) !!} </a>
							<!--  -->
							<a type="button" data-modal-target="deleteProjectModal" data-modal-show="deleteProjectModal"  onclick="event.stopPropagation(); deleteProject('{{ $project->id }}');">{!! \App\Helpers\Fontawesome::trash(['class' => 'w-4 h-4 text-red-500']) !!}</a>
						</td>


					</tr>
					@endforeach
				</tbody>
			</table>
			

		</div>

	</section>
	<!-- ------------------- -->
	<section id="editProjectModalArea">

		<!--- Edit user modal --->
			<div id="editUserModal" tabindex="-1" aria-hidden="true" class="modifyModal hidden md:inset-0 h-[calc(100%-1rem)]">
				<div class="relative w-1/2 max-w-2xl max-h-full bg-gray-50  rounded-lg shadow-xl">

					<!-- Modal content -->
					<form class="relative rounded-lg shadow-sm" id="editProjectForm" method="POST" enctype="multipart/form-data">
						@csrf
						<!-- Modal header Starts-->
							<div class="flex items-start justify-between p-4 border-b rounded-t border-gray-200">

								<h3 class="text-xl font-semibold text-gray-900 dark:text-white">
									Edit Project <span id="editModalId"></span>
								</h3>
								<!--  -->
								<div class="flex-j-center">
									<img id="modalImgPreview" src="" alt="" class="mx-6 h-16">
									<svg class="cursor-pointer text-red-500 hover:text-red-800 w-6 h-6 mb-3.5 mx-auto" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" onclick="deleteImg()">
										<path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
									</svg>

								</div>
								<!--  -->
								<button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8  inline-flex justify-center items-center" data-modal-hide="editUserModal">
									<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
										<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
									</svg>
									<span class="sr-only">Close modal</span>
								</button>

							</div>
						<!-- Modal header Ends-->

						<!-- Modal body -->
							<div class="grid gap-4 mb-4 p-6 grid-cols-2">

								<div class="col-span-2">
									<label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Project Name</label>
									<input type="text" name="name" id="editModalName" class="invoice-input">
								</div>
								<!--  -->
								<div class="col-span-2 sm:col-span-1">
									<label for="p_id" class="block mb-2 text-sm font-medium text-gray-900">PID</label>
									<input type="text" name="p_id" id="editModalPid" class="invoice-input" placeholder="min:2, max=6 characters">
								</div>
								<!--  -->
								<div class="col-span-2 sm:col-span-1">
									<label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
									<select id="editModalStatus" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
										<option value="running" selected>Running</option>
										<option value="completed">Completed</option>
										<option value="cancelled">Cancelled</option>
										<option value="halted">Halted</option>
									</select>
								</div>
								<!--  -->
								<div class="col-span-2 sm:col-span-1">

									<label for="party" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Client/Party&nbsp;<span class="hidden text-sm text-blue-400 ">(please re-select party)</span></label>

										<select id="party" name="party" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
											<option value="" selected>Select Party</option>
											@foreach($dropdownData as $value)
												<option value="{{ $value->id }}">{{ $value->name }}</option>
											@endforeach
										</select>

								</div>
								<!--  -->
								<div class="col-span-2 sm:col-span-1 grid grid-cols-2">
									<div class="col-span-2 flex-y-center">
										<label for="user" class="block text-sm font-medium text-gray-900 dark:text-white">Created by : &nbsp;</label>
										<p id="editModalUser" class="italic text-gray-600"></p>
									</div>
									<!--  -->
									<div class="col-span-2 flex-y-center">
										<label for="user" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Editing by : &nbsp;</label>
										<input type="text" name="updated_by" class="border-gray-200 rounded-lg italic" value="{{ Auth::user()->name }}" readonly>
									</div>
								</div>

								<!--  -->
								<div class="col-span-2">
									<label for="description" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Project Description</label>
									<textarea id="editModalDescription" name="description" rows="2" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>
								</div>
								<!--  -->
								<div class="col-span-2 grid grid-cols-2 flex-y-center">

									<label for="image" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Change Project Image</label>
									<div class="col-span-2 flex-j-between">

										<input type="file" id="editModalImg" name="image" class="text-sm text-blue-800 bg-yellow-100 rounded-lg">

										<button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Update Project</button>

									</div>

								</div>
								<!--  -->
								
							</div>
						<!-- Modal footer -->
						<div class="flex items-center space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
							
						</div>
					</form>

				</div>
			</div>
		<!--- Edit user modal --->

	</section>
	<!-- ------------------- -->
	<section id="createProjectModalArea">

		<!-- Create Project Modal -->
		<div id="createProjectModal" tabindex="-1" aria-hidden="true" class="modifyModal hidden md:inset-0 h-[calc(100%-1rem)]">
			<div class="relative p-4 w-full max-w-2xl max-h-full">
				<!-- Modal content -->
				<div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">

				  	<!-- Modal header Starts -->
						<div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
							<h3 class="text-lg font-semibold text-gray-900 dark:text-white">
								Create New Project
							</h3>
							<button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="createProjectModal">
								<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
									<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
								</svg>
								<span class="sr-only">Close modal</span>
							</button>
						</div>
				  	<!-- Modal header Ends -->

					<!-------Create Modal body Starts------->
					<form class="p-4 md:p-5" action="{{ route('makeProject') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="grid gap-4 mb-4 grid-cols-2">

							<div class="col-span-2">
								<label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Project Name</label>
								<input type="text" name="name" id="name" class="invoice-input" placeholder="255 characters max">
							</div>
							<!--  -->
							<div class="col-span-2 sm:col-span-1">
								<label for="p_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">PID</label>
								<input type="text" name="p_id" id="p_id" class="invoice-input" placeholder="min:2, max=6 characters">
							</div>
							<!--  -->
							<div class="col-span-2 sm:col-span-1">
								<label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
								<select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
									<option value="running" selected>Running</option>
									<option value="completed">Completed</option>
									<option value="cancelled">Cancelled</option>
									<option value="halted">Halted</option>
								</select>
							</div>
							<!--  -->
							<div class="col-span-2 sm:col-span-1">
								<label for="party" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Client/Party</label>
								<select id="party" name="party" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
									@foreach($dropdownData as $value)
										<option value="{{ $value->id }}">{{ $value->name }}</option>
									@endforeach
								</select>
							</div>
							<!--  -->
							<div class="col-span-2 sm:col-span-1">
								<label for="user" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Created by</label>
								<input type="text" name="user" id="user" class="invoice-input" value="{{ Auth::user()->name }}" readonly>
							</div>

							<!--  -->
							<div class="col-span-2">
								<label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Project Description</label>
								<textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="max 255 characters"></textarea>
							</div>
							<!--  -->
							<div class="col-span-2">
								<label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload Project Image</label>
								<input type="file" name="image" class="text-sm text-blue-800 bg-yellow-100 rounded-lg">
							</div>
							<!--  -->

						</div>
						<button type="submit" class="invoice-button bg-green-700 flex">
							<svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
							</svg>
							Add New Project
						</button>
						
					</form>
					<!-------Create Modal body Ends------->
				</div>
			</div>
		</div>

	</section>
	<!-- ------------------- -->
	 <section id="deleteProjectArea">

		<!-- Create Project Modal -->
		<div id="deleteProjectModal" tabindex="-1" aria-hidden="true" class="modifyModal hidden md:inset-0 h-[calc(100%-1rem)]">
			<div class="relative p-4 w-full max-w-2xl max-h-full">

				<!-- Modal content -->
				<div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">

					<button type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="deleteProjectModal">
						<svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
						<span class="sr-only">Close modal</span>
					</button>

            	<svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
					</svg>
            	
					<p class="mb-4 text-gray-500 dark:text-gray-300">Are you sure you want to delete this Project?</p>

            	<div class="flex justify-center items-center space-x-4">
						
						<button data-modal-toggle="deleteProjectModal" type="button" class="invoice-button bg-green-600" >
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
	<script>
		// document.querySelectorAll('.clickable-row').forEach(row => {
		// 	row.addEventListener('click', function() {
		// 		window.location.href = this.dataset.href;
		// 	});
		// });
		// ------------------------
		function openEditModal(button) {
			let project = JSON.parse(button.dataset.project); // Parse JSON data

			// tweak form route
			let editForm = document.getElementById('editProjectForm');
				editForm.action = button.dataset.url; 
	
			// tweak party
			var partyData = @json($dropdownData);

			let partyName = "";
			let partyID = "";

			partyData.forEach(party => {
				if (party.id == project.party) {
					// partyName = party.name;
					partyID = party.id;
				}
			});
			document.getElementById('party').value = partyID;

			// document.getElementById('editModalId').innerHTML = project.id;
			document.getElementById('editModalName').value = project.name;
			document.getElementById('editModalPid').value = project.p_id;
			document.getElementById('editModalStatus').value = project.status;
			document.getElementById('editModalUser').innerHTML = project.user;
			document.getElementById('editModalDescription').value = project.description;

			if(project.image != null){
				document.getElementById('modalImgPreview').src = project.image;
			}
			else{
				document.getElementById('modalImgPreview').alt = "No Project Image";
			}

			// Show modal
			// document.getElementById('editModal').classList.remove('hidden');
		}

		// Attaching event listener to edit buttons
		document.querySelectorAll('.editButton').forEach(button => {
			button.addEventListener('click', function() {
				openEditModal(this);
			});
		});

		// ------------------------
		let delete_img_id = null;

		function deleteImgID(x){
			delete_img_id = x;
		}

		function deleteImg(){
			alert("Do You Wanna Delete This Project Image? This Can't Be Undone!");
			window.location.href = `/deleteProjectImg/${delete_img_id}`;
		}
		
		// ------------------------
		let delete_id = null;
		function deleteProject(x){
			delete_ID = x;
		}

		function deleteConfirmation(x){
			const deleteID = delete_ID;
			if(x == 1){
				console.log("deleteID = ", deleteID);
				window.location.href = `/deleteProject/${deleteID}`;
			}
			else{
				console.log("deleteID = ", deleteID, " delete aborted");
				window.location.href = `/project`;
			}
		}

		// function deleteProject()


	</script>


</x-layouts.master>