<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Impor facade Validator
use App\Models\User; // Impor model User
use Illuminate\Support\Facades\Hash; // Impor facade Hash

class ProfileController extends Controller
{
    public function registerForm()
    {
        return view('posts.register');
    }

    public function register(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $validator->validate();

        $user = User::create([
            "name" => $data["nama"],
            "email" => $data["email"],
            "password" => Hash::make($data['password'])
        ]);

        // Hapus auth()->login($user); untuk mencegah login otomatis setelah register
        return redirect()->route("login")->with('success', 'Registration successful. Please login.');
    }

    public function loginform()
    {
        return view("posts.login");
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route("login");
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        $validator = Validator::make($credentials, [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $validator->validate();

        if (auth()->attempt($credentials, $remember)) {
            return redirect()->intended('/home');
        }

        return redirect()->back()
            ->withErrors(['email' => ' The provided credentials do not match our records.'])
            ->withInput();
    }
}
