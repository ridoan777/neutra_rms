<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
	public function showRegister()
	{
		return view('components.auth.register');
	}
	// ----------------
	public function showLogin()
	{
		return view('components.auth.login');
	}
	// ----------------
	public function register(Request $request)
	{
		$validated = $request->validate([
			'name' => 'required|string|max:255',
			'email' => 'required|email|unique:users',
			'password' => 'required|string|min:4|confirmed' //use 1234
		]);

		$user = User::create($validated);

		Auth::login($user);
		return redirect()->route('dashboard');

	}
	// ----------------
	public function login(Request $request)
	{
		$validated = $request->validate([
			'email' => 'required|email',
			'password' => 'required|string' //use 1234
		]);

		if(Auth::attempt($validated)){
			$request->session()->regenerate();

			return redirect()->route('dashboard');
		}
		throw ValidationException::withMessages([
			'credentials' => 'Sorry, incorrect credentials'
		]); //sends back to the login page with some messages

	}
	// ----------------
	public function logout(Request $request)
	{
		Auth::logout(); //will clear user data from session but products, whishlist items, etc.

		$request->session()->invalidate(); //to clear remaining session data
		$request->session()->regenerateToken(); //generates csrf token. Anything submitted with previous tokens will be rejected.

		return view('components.auth.login');
	}
	// ----------------
}
