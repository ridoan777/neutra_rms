<!-- ----------------------------- -->
<style scoped>
	.formWrapper {
		/* background: url('/asset/images/app_image/neutra_bg.jpg') no-repeat center center; */
		background: url('asset/images/app_image/login_bg.jpg') no-repeat top center;
		background-size: cover;
		position: relative;
	}

	.formWrapper::after {
		content: "";
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		z-index: 1;
		background: rgba(0, 0, 0, 0.7); /* 70% opacity */
	}

	.formWrapperChild{
		position: relative;
		z-index: 2;
	}

</style>
<!-- ----------------------------- -->
<x-partials.header/>
	<section class="formWrapper bg-gray-50">
		<div class="formWrapperChild flex-xy-center flex-col px-6 py-8 mx-auto md:h-screen lg:py-0">
			<a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
				<!-- <img class="w-64 mr-2" src="{{ asset('asset/images/icons') }}/neutra_logo.png" alt="logo"> -->
				<img class="w-64 ml-0" src="{{ asset('asset/images/icons') }}/Vendora assets (480 x 160 px).png" alt="logo">
			</a>
			<div class="formArea w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0">
				<div class="p-6 space-y-4 md:space-y-6 sm:p-8">
					<h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
						Reset your password
					</h1>
					<form class="space-y-4 md:space-y-6" action="{{ route('password.update') }}" method="POST">
						@csrf

						<input type="hidden" name="token" value="{{ $token }}">
						<div>
							<label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
							<input type="email" name="email" class="invoice-input" value="{{ old('email') }}" required>
						</div>
						<!--  -->
						<div>
							<label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
							<input type="password" name="password" class="invoice-input" value="{{ old('password') }}" required>
						</div>
						<!--  -->
						<div>
							<label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
							<input type="password" name="password_confirmation"  class="invoice-input" value="{{ old('password') }}" required>
						</div>

						<button type="submit" class="w-full invoice-button bg-invoice-navy hover:bg-blue-900">Reset Password</button>

					</form>

					<!-- validation error display -->
						@if($errors->any())
						<ul>
							@foreach ($errors->all() as $error)
							<li class="text-red-500 text-center">{{ $error }}</li>
							@endforeach
						</ul>
						@endif
					<!-- validation error display ends -->
				</div>
			</div>
		</div>
	</section>
<x-partials.footer/>
