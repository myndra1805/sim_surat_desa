<x-app-layout>
    @section('title', 'Buat Permintaan Surat')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h3>Permintaan Surat</h3>
                <hr>
                <form action="/surat/create" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori Surat</label>
                        <select name="kategori" class="form-control @error('kategori') is-invalid @enderror" id="kategori">
                            <option></option>
                            <option value="Surat Keterangan Tidak Mampu">Surat Keterangan Tidak Mampu</option>
                            <option value="Surat Pengantar SKCK">Pengantar SKCK</option>
                            <option value="Surat Keterangan Belum Menikah">Surat Keterangan Belum Menikah</option>
                        </select>
                        @error('kategori')
                            <div id="kategori" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input name="nama" value="{{ old('nama') }}"
                            class="form-control @error('nama') is-invalid @enderror" id="nama">
                        @error('nama')
                            <div id="nama" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input name="nik" value="{{ old('nik') }}"
                            class="form-control @error('nik') is-invalid @enderror" id="nik">
                        @error('nik')
                            <div id="nik" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                        <input name="tempat_lahir" value="{{ old('tempat_lahir') }}"
                            class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir">
                        @error('tempat_lahir')
                            <div id="tempat_lahir" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                            class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir">
                        @error('tanggal_lahir')
                            <div id="tanggal_lahir" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror"
                            id="jenis_kelamin">
                            <option></option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <div id="jenis_kelamin" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="agama" class="form-label">Agama</label>
                        <select name="agama" class="form-control @error('agama') is-invalid @enderror" id="agama">
                            <option></option>
                            <option value="Islam">Islam</option>
                            <option value="Protestan">Protestan</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Khonghucu">Khonghucu</option>
                        </select>
                        @error('agama')
                            <div id="agama" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="status_perkawinan" class="form-label">Status Perkawinan</label>
                        <select name="status_perkawinan"
                            class="form-control @error('status_perkawinan') is-invalid @enderror"
                            id="status_perkawinan">
                            <option></option>
                            <option value="Sudah Menikah">Sudah Menikah</option>
                            <option value="Belum Menikah">Belum Menikah</option>
                        </select>
                        @error('status_perkawinan')
                            <div id="status_perkawinan" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                            rows="3"></textarea>
                        @error('alamat')
                            <div id="alamat" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="ktp">Kartu Tanda Penduduk</label>
                        <input name="ktp" type="file" class="form-control-file @error('ktp') is-invalid @enderror"
                            id="ktp">
                        @error('ktp')
                            <div id="ktp" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="kk">Kartu Keluarga</label>
                        <input name="kk" type="file" class="form-control-file @error('kk') is-invalid @enderror"
                            id="kk">
                        @error('kk')
                            <div id="kk" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <button class="btn text-white" style="background-color:#004c3f;"
                            onMouseOver="this.style.backgroundColor='#009c86'"
                            onMouseOut="this.style.backgroundColor='#004c3f'">
                            <i class="fas fa-save"></i>
                            SAVE
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
