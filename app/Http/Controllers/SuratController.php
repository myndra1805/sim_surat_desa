<?php

namespace App\Http\Controllers;

use App\Exports\SuratExport;
use App\Models\Person;
use App\Models\Surat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PDF;
use Maatwebsite\Excel\Facades\Excel;

class SuratController extends Controller
{
    public function read()
    {
        $surat = DB::table('surats')->orderBy('id', 'desc')->get();
        if (request()->ajax()) {
            return datatables()->of($surat)
                ->addColumn('aksi', function ($row) {
                    if($row->status === 'Diterima'){
                        return "<div class='d-flex'>
                            <a href='/surat/download-surat/" . $row->id . "' class='mx-1 btn btn-success d-flex align-items-center btn-sm'>
                                <i class='fas fa-download mr-1'></i>
                                Download
                            </a>
                            </div>";
                    }
                    return '';
                })
                ->addColumn('status', function($row){
                    if($row->status === 'Ditolak'){
                        return "<span class='badge badge-pill badge-danger'>Ditolak</span>";
                    }else if($row->status === 'Diterima'){
                        return "<span class='badge badge-pill badge-success'>Diterima</span>";
                    }
                    return "<span class='badge badge-pill badge-primary'>Sedang Diproses</span>";
                })
                ->addColumn('tanggal_dikirim', function($row){
                    $waktu = explode(" ", $row->created_at);
                    $waktu = explode("-", $waktu[0]);
                    return $waktu[2] . "-" . $waktu[1] . "-" . $waktu[0];
                })
                ->rawColumns(['aksi', 'status', 'tanggal_dikirim'])
                ->make(true);
        } else {
            return abort(404);
        }
    }

    public function readAdmin()
    {
        $surat = DB::table('surats')->orderBy('id', 'desc')->get();
        foreach ($surat as $i => $item) {
            $person = Person::where('id_user', $item->id_user)->first();
            $user = User::where('id', $item->id_user)->first();
            $surat[$i]->nama = $user->name;
            $surat[$i]->nik = $person->nik;
            $surat[$i]->tempat_lahir = $person->tempat_lahir;
            $surat[$i]->tanggal_lahir = $person->tanggal_lahir;
            $surat[$i]->jenis_kelamin = $person->jenis_kelamin;
            $surat[$i]->agama = $person->agama;
            $surat[$i]->status_perkawinan = $person->status_perkawinan;
            $surat[$i]->alamat = $person->alamat;
            $surat[$i]->ktp = $person->ktp;
            $surat[$i]->kk = $person->kk;
        }
        if (request()->ajax()) {
            return datatables()->of($surat)
                ->addColumn('aksi', function ($row) {
                    if($row->status != 'Diterima' && $row->status != 'Ditolak'){
                        return "<div class='d-flex'>
                            <button data-id='" . $row->id . "' onclick='accepted(event)' class='mx-1 btn btn-success d-flex align-items-center btn-sm'>
                                <i class='fas fa-check-circle mr-1'></i>
                                Accepted
                            </button>
                            <button onclick='rejected(event)'  data-id='" . $row->id . "' class='mx-1 btn btn-danger d-flex align-items-center btn-sm'>
                                <i class='fas fa-times-circle mr-1'></i>
                                Rejected
                            </button>
                            </div>";
                    }
                    return '';
                })
                ->addColumn('status', function($row){
                    if($row->status === 'Ditolak'){
                        return "<span class='badge badge-pill badge-danger'>Ditolak</span>";
                    }else if($row->status === 'Diterima'){
                        return "<span class='badge badge-pill badge-success'>Diterima</span>";
                    }
                    return "<span class='badge badge-pill badge-primary'>Sedang Diproses</span>";
                })
                ->addColumn('tanggal_dikirim', function($row){
                    $waktu = explode(" ", $row->created_at);
                    $waktu = explode("-", $waktu[0]);
                    return $waktu[2] . "-" . $waktu[1] . "-" . $waktu[0];
                })
                ->addColumn('detail', function($row){
                    return '';
                })
                ->rawColumns(['aksi', 'status', 'tanggal_dikirim'])
                ->make(true);
        } else {
            return abort(404);
        }
    }

    public function showCreate()
    {
        return view('surat.create');
    }

    public function create(Request $request)
    {
        $request->validate([
            'kategori' => ['required', 'max:255', 'string'],
        ]);

        Surat::create([
            'kategori' => $request->kategori,
            'status' => false,
            'id_user' => Auth::user()->id
        ]);

        return redirect('/user/surat')->with('status', 'Permintaan surat berhasil di kirim');
    }

    public function accepted(Request $request)
    {
        $request->validate([
            'id' => ['required', 'max:255'],
        ]);
        $surat = Surat::where('id', $request->id)->first();
        if(!$surat){
            return redirect('/admin/surat');
        }
        $surat->update([
            'status' => 'Diterima'
        ]);
        return redirect('/admin/surat')->with('status', 'Permintaan surat berhasil disetujui');
    }

    public function rejected(Request $request)
    {
        $request->validate([
            'id' => ['required', 'max:255'],
        ]);
        $surat = Surat::where('id', $request->id)->first();
        if(!$surat){
            return redirect('/admin/surat');
        }
        $surat->update([
            'status' => 'Ditolak'
        ]);
        return redirect('/admin/surat')->with('status', 'Permintaan surat berhasil ditolak');
    }

    public function downloadSurat($id)
    {
        $surat = Surat::where('id', $id)->first();
        $person = Person::where('id_user', $surat->id_user)->first();
        $user = User::where('id', $surat->id_user)->first();
        $surat->nama = $user->name;
        $surat->nik = $person->nik;
        $surat->tempat_lahir = $person->tempat_lahir;
        $surat->tanggal_lahir = $person->tanggal_lahir;
        $surat->jenis_kelamin = $person->jenis_kelamin;
        $surat->agama = $person->agama;
        $surat->status_perkawinan = $person->status_perkawinan;
        $surat->alamat = $person->alamat;
        $surat->ktp = $person->ktp;
        $surat->kk = $person->kk;
        if(!$surat){
            return abort(404);
        }
        $pdf = '';
        if($surat->kategori == 'Surat Keterangan Tidak Mampu'){
            $pdf = PDF::loadview('pdf.sktm',['user' => $surat])->setOptions(['defaultFont' => 'sans-serif']);;
        } else if($surat->kategori == 'Surat Pengantar SKCK'){
            $pdf = PDF::loadview('pdf.skck',['user' => $surat])->setOptions(['defaultFont' => 'sans-serif']);;
        } else if($surat->kategori == 'Surat Keterangan Belum Menikah'){
            $pdf = PDF::loadview('pdf.skbm',['user' => $surat])->setOptions(['defaultFont' => 'sans-serif']);;
        }
        return $pdf->download('surat.pdf');
    }

    public function export()
    {
        return Excel::download(new SuratExport, 'surat.xlsx');
    }
}
