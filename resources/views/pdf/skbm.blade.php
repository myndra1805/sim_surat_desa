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
            SURAT KETERANGAN BERKELAKUAN BAIK<br>
            Nomor : 55 /xxxx /SLB/ SKBB/VI/ 2021
        </p>
    </section>

    <section>
        <p>
            Keuchik Gampong Seuleumbah Kecamatan Jeumpa Kabupaten Bireuen, dengan ini menerangkan bahwa :
        </p>
    </section>

    <section>
        <table>
            <tr>
                <td>Nama</td>
                <td>: {{ $user->nama }}</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>: {{ $user->nik }}</td>
            </tr>
            <tr>
                <td>Tempat, tanggal lahir</td>
                <td>: {{ $user->tempat_lahir }}, {{ $user->tanggal_lahir }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>: {{ $user->jenis_kelamin }}</td>
            </tr>
            <tr>
                <td>Status Perkawinan</td>
                <td>: {{ $user->status_perkawinan }}</td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>: {{ $user->agama }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: {{ $user->alamat }}</td>
            </tr>
        </table>
    </section>

    <section>
        <p>
            Benar yang tersebut namanya di atas adalah penduduk Gampong Seuleumbah, Kecamatan Jeumpa, Kabupaten Bireuen. Berdasarkan catatan yang ada serta sepengetahuan kami yang bersangkutan Belum Pernah Menikah.
        </p>
        <p>
            Surat Keterangan ini diberikan kepada yang bersangkutan untuk Kelengkapan administrasi.
        </p>
        <p>
            Demikian surat keterangan ini dikeluarkan dengan sebenarnya untuk dapat dipergunakan
            seperlunya.
        </p>
    </section>

    <section>
        <p>
          Seuleumbah, 22 Juni 2021<br>
          Keuchik Seuleumbah
        </p>
        <img src="{{ public_path('storage/ktp/' . $user->ktp) }}" alt="" style="width: 150px; height: 150px;">
        <p>
            Junaedi
        </p>
    </section>
</body>

</html>
