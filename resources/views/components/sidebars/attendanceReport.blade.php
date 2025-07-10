<x-layouts.master>
    <h1 class="mb-2 text-5xl text-center text-red-900">Attendance Reports</h1>
    <!-- error and success message display -->
    <x-alert-component/>
    <!-- error and success message display ends -->
    <!-- ------------------- -->
    <section id="showTableArea">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="w-full flex justify-between">
                <div class="w-1/3 p-2 mb-4">
                    <label for="date" class="block font-semibold mb-1">Filter by Date:</label>
                    <input type="date" id="date" name="date" class="border p-2 w-1/2" value="{{ request('date') }}">
                </div>
            </div>
            <table id="attendanceTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 overflow-x-auto">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="w-full grid grid-cols-12 text-center">
                        <th scope="col" class="col-span-1 px-2 py-2">SN</th>
                        <th scope="col" class="col-span-1 px-2 py-2">Image</th>
                        <th scope="col" class="col-span-2 px-2 py-2">Name</th>
                        <th scope="col" class="col-span-1 px-2 py-2">Role</th>
                        <th scope="col" class="col-span-2 px-2 py-2">Staff ID</th>
                        <th scope="col" class="col-span-1 px-2 py-2">Date</th>
                        <th scope="col" class="col-span-2 px-2 py-2">Status</th>
                        <th scope="col" class="col-span-2 px-2 py-2">Attendee</th>
                    </tr>
                </thead>
                <tbody id="attendanceBody" class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <!-- Attendance data will be populated via JavaScript -->
                    <tr>
                        <td colspan="12" class="text-center py-4">Loading records...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
    <style>
        #attendanceTable tbody tr td {
            display: grid;
            align-items: center;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dateInput = document.getElementById('date');
            
            // Set default date to today if not provided
            if (!dateInput.value) {
                const today = new Date();
                const formattedDate = today.toISOString().split('T')[0];
                dateInput.value = formattedDate;
            }
            
            // Initial fetch with the date value
            fetchAttendanceData(dateInput.value);
            
            // Add event listener for date changes
            dateInput.addEventListener('change', function() {
                fetchAttendanceData(this.value);
            });
        });
        
        function fetchAttendanceData(date) {
            const tbody = document.getElementById('attendanceBody');
            tbody.innerHTML = '<tr><td colspan="12" class="text-center py-4">Loading records...</td></tr>';
            
            fetch(`/attendance/fetch?date=${date}`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                tbody.innerHTML = '';
                
                if (data.attendances.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="12" class="text-center py-4">No records found for this date</td></tr>';
                    return;
                }
                
                data.attendances.forEach((attendance, index) => {
                    const imageHtml = attendance.party.image
                        ? `<img src="${attendance.party.image}" alt="staff_image" class="w-12 h-12 rounded-full">`
                        : `<div class="w-12 h-12 rounded-full bg-green-700 overflow-hidden text-wrap text-center text-xs text-gray-200 flex items-center justify-center">No Image</div>`;
                        const formattedDate = attendance.date ? formatDate(attendance.date) : 'N/A';
                    
                     // Set status color classes
                     let statusClasses = '';
                     switch(attendance.status.toLowerCase()) {
                        case 'present':
                           statusClasses = 'col-span-1 border text-center border-green-500 text-green-500 rounded px-2 py-1';
                           break;
                        case 'absent':
                           statusClasses = 'col-span-1 border text-center border-red-500 text-red-500 rounded px-2 py-1';
                           break;
                        case 'late':
                           statusClasses = 'col-span-1 border text-center border-orange-300 text-orange-300 rounded px-2 py-1';
                           break;
                        case 'leave':
                           statusClasses = 'col-span-1 border text-center border-purple-500 text-purple-500 rounded px-2 py-1';
                           break;
                        default:
                           statusClasses = 'col-span-1 border text-center border-gray-500 text-gray-500 rounded px-2 py-1';
                     }
                     
                    const row = `
                        <tr class="w-full grid grid-cols-12 text-center bg-white border-b border-gray-200 hover:bg-gray-50 cursor-pointer">
                            <td scope="col" class="col-span-1 px-2 py-2">${index + 1}</td>
                            <td scope="col" class="col-span-1 px-2 py-2">${imageHtml}</td>
                            <td scope="col" class="col-span-2 px-2 py-2">${attendance.name}</td>
                            <td scope="col" class="col-span-1 px-2 py-2">${attendance.party.type || 'N/A'}</td>
                            <td scope="col" class="col-span-2 px-2 py-2">${attendance.prt_id}</td>
                            <td scope="col" class="col-span-1 px-2 py-2">${formattedDate}</td>
                            <td scope="col" class="col-span-2 px-2 py-2">
                              <span class="${statusClasses}">${attendance.status}</span>
                           </td>
                            <td scope="col" class="col-span-2 px-2 py-2">${attendance.attendee}</td>
                        </tr>`;
                    
                    tbody.insertAdjacentHTML('beforeend', row);
                });
            })
            .catch(error => {
                console.error('Error fetching attendance:', error);
                tbody.innerHTML = '<tr><td colspan="12" class="text-center py-4">Error loading records: ' + error.message + '</td></tr>';
            });
        }

         function formatDate(dateString) {
            const date = new Date(dateString);
            const day = date.getDate().toString().padStart(2, '0');
            const month = (date.getMonth() + 1).toString().padStart(2, '0');
            const year = date.getFullYear();
            return `${day}-${month}-${year}`;
         }
    </script>
</x-layouts.master>