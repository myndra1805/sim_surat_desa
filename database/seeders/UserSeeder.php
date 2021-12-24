<?php

namespace Database\Seeders;

use App\Models\Person;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt(12345678)
        ]);

        // $user = User::create([
        //     'name' => 'Ari Yuhendra',
        //     'email' => 'ariyuhendra99@gmail.com',
        //     'password' => bcrypt(12345678)
        // ]);

        // Person::create([
        //     'id_user' => $user->id,
        //     'nik' => '123456789012',
        //     'tempat_lahir' => 'Pekanbaru',
        //     'tanggal_lahir' => '18-05-1999',
        //     'jenis_kelamin' => 'Laki-Laki',
        //     'agama' => 'Islam',
        //     'status_perkawinan' => 'Belum Menikah',
        //     'alamat' => 'Jln Pasir Putih',
        //     'ktp' => '123456789012.png',
        //     'kk' => '123456789012.png',
        // ]);

        $admin->assignRole('admin');
        // $user->assignRole('user');
    }
}
