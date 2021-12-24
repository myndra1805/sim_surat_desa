<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Surat Keterangan Tidak Mampu</title>
    <link rel="shortcut icon" href="/images/logo.png" type="image/x-icon">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</head>

<body>
    <header style="text-align: center">
        <h3 style="margin: 0;">
            PEMERINTAH KOTA ADMINISTRASI JAKARTA TIMUR
        </h3>
        <h3 style="margin: 0;">
            KECAMATAN KRAMAT JATI
        </h3>
        <h3 style="margin: 0;">
            KANTOR KELURAHAN CILILITAN
        </h3>
    </header>

    <div>
        <hr style="height: 5px; background-color: black; border: 1px solid black">
        <hr style="height: 1px; background-color: black; border: 1px solid black">
    </div>

    <section>
        <p style="font-weight: bold">
            Jalan Mayjen Sutoyo 2, Cililitan, Kec. Kramat Jati, Jakarta Timur<br>
            Telepon : 021-89832375<br>
            SURAT KETERANGAN TIDAK MAMPU<br>
            Nomor : 034/II/SKTM/2021
        </p>
    </section>

    <section>
        <p>
            Saya yang bertanda tangan di bawah ini selaku Ketua RT 09, RW 03, Kel. Cililitan, Kec. Kramat Jati, Kota Jakarta Timur  menyatakan bahwa :
        </p>
    </section>

    <section>
        <table>
            <tr>
                <td>Nama</td>
                <td>: {{$user->nama}}</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>: {{$user->nik}}</td>
            </tr>
            <tr>
                <td>Tempat, tanggal lahir</td>
                <td>: {{$user->tempat_lahir}}, {{$user->tanggal_lahir}}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>: {{$user->jenis_kelamin}}</td>
            </tr>
            <tr>
                <td>Status Perkawinan</td>
                <td>: {{$user->status_perkawinan}}</td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>: {{$user->agama}}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: {{$user->alamat}}</td>
            </tr>
        </table>
    </section>

    <section>
        <p>
            Orang tersebut benar-benar warga RT09 dan bertempat tinggal di alamat yang telah disebutkan. 
        </p>
        <p>
            Berdasarkan data dan fakta yang telah saya kumpulkan bahwa orang yang bersangkutan termasuk dalam golongan warga yang kurang mampu.
        </p>
        <p>
            Demikian surat keterangan ini saya buat dengan sebenar-benarnya berdasarkan fakta yang ada serta sesuai dengan permohonan orang yang bersangkutan. 
        </p>
        <p>
            Semoga surat ini dapat dipergunakan sebagaimana mestinya. Atas perhatiannya saya ucapkan terima kasih.
        </p>
    </section>

    <section>
        <p>
            Jakarta, 16 Februari 2021
            {{asset('storage/ktp/' . $user->ktp)}}
        </p>
        <img src="{{ public_path("storage/ktp/".$user->ktp) }}" alt="" style="width: 150px; height: 150px;">
        <p>
            Hormat saya,
            Junaedi
        </p>
    </section>
</body>

</html>
