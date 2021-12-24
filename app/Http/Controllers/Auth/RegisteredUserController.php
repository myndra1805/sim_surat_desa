<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Person;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Storage;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'tempat_lahir' => ['required', 'max:255', 'string'],
            'tanggal_lahir' => ['required', 'max:255', 'string'],
            'jenis_kelamin' => ['required', 'max:255', 'string'],
            'agama' => ['required', 'max:255', 'string'],
            'status_perkawinan' => ['required', 'max:255', 'string'],
            'alamat' => ['required', 'max:255', 'string'],
            'ktp' => ['required', 'mimes:jpg,jpeg,png', 'max:5048'],
            'kk' => ['required', 'mimes:jpg,jpeg,png', 'max:5048'],
            'nik' => ['required', 'size:12', 'string', 'unique:people,nik'],
        ]);

        $fileKTP = $request->file('ktp');
        $nameFileKTP = str_replace(' ', '-', strtolower($request->nik)) . "." . $fileKTP->getClientOriginalExtension();
        Storage::putFileAs('public/ktp', $fileKTP, $nameFileKTP);

        $fileKK = $request->file('kk');
        $nameFileKK = str_replace(' ', '-', strtolower($request->nik)) . "." . $fileKK->getClientOriginalExtension();
        Storage::putFileAs('public/kk', $fileKK, $nameFileKK);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Person::create([
            'id_user' => $user->id,
            'nik' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'status_perkawinan' => $request->status_perkawinan,
            'alamat' => $request->alamat,
            'ktp' => $nameFileKTP,
            'kk' => $nameFileKK,
        ]);

        $user->assignRole('user');

        event(new Registered($user));

        Auth::login($user);
        return redirect('/user/dashboard');
    }
}
