<div class="w-1/3 my-2 transition-opacity duration-1000 opacity-100" id="messageArea">
	@if(session('success'))
	<div class="bg-green-700 text-white px-4 py-3 rounded relative" role="alert">
		<strong class="font-bold text-center">Success!</strong>
		<span class="block sm:inline">{{ session('success') }}</span>
	</div>
	@endif
	@if($errors->any())
	<ul class="bg-red-500 text-white px-4 py-3 rounded relative">
		<li><b>Error/s:</b></li>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
	@endif
</div>

<style>
	#messageArea {
		max-height: 200px; /* Initial height guess */
		overflow: hidden;
		transition: opacity 1s ease, max-height 1s ease;
	}
</style>

<script>
	setTimeout(function() {
		const msg = document.getElementById('messageArea');
		if (msg) {
			setTimeout(() => {
					msg.classList.replace('opacity-100', 'opacity-0');
					msg.style.maxHeight = '0px'; // smoothly collapse height
			}, 10); 
			setTimeout(() => {
					msg.style.display = 'none';
			}, 1100); // after transition done
		}
	}, 10000);
</script>

