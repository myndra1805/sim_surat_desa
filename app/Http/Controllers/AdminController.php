<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $surat = DB::table('surats');
        $users = DB::table('people')->get();
        $surat_ditolak = Surat::where('status', 'ditolak')->get();
        return view('admin.dashboard',[
            'masyarakat' => count($users),
            'surat_masuk' => count($surat->get()),
            'surat_diterima' => count($surat->where('status', 'Diterima')->get()),
            'surat_tolak' => count($surat_ditolak)
        ]);
    }

    public function masyarakat()
    {
        return view('admin.masyarakat');
    }

    public function surat()
    {
        return view('admin.surat');
    }

    public function about()
    {
        return view('about');
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'email' => ['required', 'max:255', 'email', 'string'],
            'password_lama' => ['required', 'max:255', 'min:8', 'string'],
            'id' => ['required', 'max:255', 'string'],
        ]);
        $user = User::where('id', $request->id)->first();
        if(!Hash::check($request->password_lama, $user->password)){
            return redirect('/admin/profile')->with('error', 'Password yang anda masukkan salah');
        }
        if($request->email != $user->email){
            $request->validate([
                'email' => ['unique:users']
            ]);
        }
        if($request->password_baru != null){
            $request->validate([
                'password_baru' => ['max:255', 'string', 'min:8'],
            ]);
            $user->update([
                'password' => bcrypt($request->password_baru)
            ]);
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        return redirect('/admin/profile')->with('status', 'Profile berhasil diubah');
    }
}
