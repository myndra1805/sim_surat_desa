<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PagesController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function surat()
    {
        return view('user.surat');
    }

    public function profile()
    {
        $user = Auth::user();
        $person = Person::where('id_user', $user->id)->first();
        $person->nama = $user->name;
        $person->email = $user->email;
        return view('user.profile', [
            'user' => $person
        ]);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'password_lama' => ['required', 'max:255', 'min:8', 'string'],
            'id' => ['required', 'max:255', 'string'],
            'tempat_lahir' => ['required', 'max:255', 'string'],
            'tanggal_lahir' => ['required', 'max:255', 'string'],
            'jenis_kelamin' => ['required', 'max:255', 'string'],
            'agama' => ['required', 'max:255', 'string'],
            'status_perkawinan' => ['required', 'max:255', 'string'],
            'alamat' => ['required', 'max:255', 'string'],
        ]);
        $user = User::where('id', $request->id)->first();
        $person = Person::where('id_user', $request->id)->first();
        if (!Hash::check($request->password_lama, $user->password)) {
            return redirect('/user/profile')->with('error', 'Password yang anda masukkan salah');
        }
        if ($request->password_baru != null) {
            $request->validate([
                'password_baru' => ['max:255', 'string', 'min:8'],
            ]);
            $user->update([
                'password' => bcrypt($request->password_baru)
            ]);
        }
        $user->update([
            'name' => $request->name,
        ]);
        $person->update([
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'status_perkawinan' => $request->status_perkawinan,
            'alamat' => $request->alamat,
        ]);

        return redirect('/user/profile')->with('status', 'Profile berhasil diubah');
    }
}
