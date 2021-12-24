<?php

namespace App\Exports;

use App\Models\Person;
use App\Models\Surat;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class SuratExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $surat = Surat::where('status', 'Diterima')->get();

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
        return $surat;
    }
}
