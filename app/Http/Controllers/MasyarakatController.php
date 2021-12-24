<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasyarakatController extends Controller
{
    public function read()
    {
        $masyarakat = DB::table('users')->where('name', '<>' ,'Admin')->orderBy('id', 'desc')->get();
        foreach ($masyarakat as $i => $item) {
            $person = Person::where('id_user', $item->id)->first();
            $user = User::where('id', $item->id)->first();
            $masyarakat[$i]->nik = $person->nik;
            $masyarakat[$i]->tempat_lahir = $person->tempat_lahir;
            $masyarakat[$i]->tanggal_lahir = $person->tanggal_lahir;
            $masyarakat[$i]->jenis_kelamin = $person->jenis_kelamin;
            $masyarakat[$i]->agama = $person->agama;
            $masyarakat[$i]->status_perkawinan = $person->status_perkawinan;
            $masyarakat[$i]->alamat = $person->alamat;
            $masyarakat[$i]->ktp = $person->ktp;
            $masyarakat[$i]->kk = $person->kk;
        }
        if (request()->ajax()) {
            return datatables()->of($masyarakat)
                ->addColumn('aksi', function ($row) {
                    return "<div class='d-flex'>
                    <a href='/masyarakat/update/" . $row->id . "' class='mx-1 btn btn-success d-flex align-items-center btn-sm'>
                        <i class='fas fa-edit mr-1'></i>
                        Update
                    </a>
                    <button data-id='" . $row->id . "' class='btn d-flex align-items-center btn-sm btn-danger d-flex align-items-center justify-content-center' onclick='destroy(event)'>
                        <i class='fas fa-trash-alt mr-1'></i>
                        Delete
                    </button>
                    </div>
                    ";
                })
                ->addColumn('detail', function($row){
                    return '';
                })
                ->rawColumns(['aksi', 'detail'])
                ->make(true);
        } else {
            return abort(404);
        }
    }

    public function showUpdate($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        if(!$user){
            return abort(404);
        }
        return view('masyarakat.update', [
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'email'],
        ]);
        $user = User::where('id', $request->id)->first();
        if($request->email != $user->email){
            $request->validate([
                'email' => ['unique:users']
            ]);
        }
        if($request->password != null){
            $request->validate([
                'passwoord' => ['string', 'min:8', 'max:255']
            ]);
            $user->update([
                'passwoord' => bcrypt($request->password),
            ]);
        }
        if(!$user){
            return abort(404);
        }
        $user->update([
            'email' => $request->email,
            'name' => $request->name
        ]);

        return redirect('/admin/masyarakat')->with('status', 'Data berhasil diubah');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => ['required', 'string', 'max:255'],
        ]);
        $user = User::where('id', $request->id)->first();
        $user->delete();

        return redirect('/admin/masyarakat')->with('status', 'Data berhasil dihapus');
    }
}
