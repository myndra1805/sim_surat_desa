<x-guest-layout>
    @section('title', 'Register')
    @section('image')
        <img src="/images/register.jpg" alt="" height="100%">
    @endsection
    <div class="card">
        <form action="/register" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <h5 class="card-title mb-3 text-center">Register</h5>
                <div class="card-text">
                    <div class="row">
                        <div class="mb-3 col-12 col-md-6">
                            <label for="name" class="form-label">Username</label>
                            <input name="name" class="form-control @error('name') is-invalid @enderror" id="name">
                            @error('name')
                                <div id="name" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label for="nik" class="form-label">NIK</label>
                            <input name="nik" value="{{ old('nik') }}"
                                class="form-control @error('nik') is-invalid @enderror" id="nik">
                            @error('nik')
                                <div id="nik" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input name="tempat_lahir" value="{{ old('tempat_lahir') }}"
                                class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir">
                            @error('tempat_lahir')
                                <div id="tempat_lahir" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                                class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir">
                            @error('tanggal_lahir')
                                <div id="tanggal_lahir" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin"
                                class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin">
                                <option></option>
                                <option @if(old('jenis_kelamin') == 'Laki-Laki') selected @endif value="Laki-Laki">Laki-Laki</option>
                                <option @if(old('jenis_kelamin') == 'Perempuan') selected @endif value="Perempuan">Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div id="jenis_kelamin" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label for="agama" class="form-label">Agama</label>
                            <select name="agama" class="form-control @error('agama') is-invalid @enderror" id="agama">
                                <option></option>
                                <option @if(old('agama') == 'Islam') selected @endif value="Islam">Islam</option>
                                <option @if(old('agama') == 'Protestan') selected @endif value="Protestan">Protestan</option>
                                <option @if(old('agama') == 'Katolik') selected @endif value="Katolik">Katolik</option>
                                <option @if(old('agama') == 'Hindu') selected @endif value="Hindu">Hindu</option>
                                <option @if(old('agama') == 'Buddha') selected @endif value="Buddha">Buddha</option>
                                <option @if(old('agama') == 'Khonghucu') selected @endif value="Khonghucu">Khonghucu</option>
                            </select>
                            @error('agama')
                                <div id="agama" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label for="status_perkawinan" class="form-label">Status Perkawinan</label>
                            <select name="status_perkawinan"
                                class="form-control @error('status_perkawinan') is-invalid @enderror"
                                id="status_perkawinan">
                                <option></option>
                                <option @if(old('status_perkawinan') == 'Sudah Menikah') selected @endif value="Sudah Menikah">Sudah Menikah</option>
                                <option @if(old('status_perkawinan') == 'Belum Menikah') selected @endif value="Belum Menikah">Belum Menikah</option>
                            </select>
                            @error('status_perkawinan')
                                <div id="status_perkawinan" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" value="{{old('email')}}" name="email" class="form-control @error('email') is-invalid @enderror"
                                id="email">
                            @error('email')
                                <div id="email" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" id="password">
                            @error('password')
                                <div id="password" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation"
                                class="form-control @error('password') is-invalid @enderror" id="password_confirmation">
                            @error('password')
                                <div id="password" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12 row">
                            <div class="mb-3 col-12 col-md-6 align-items-center">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                                    id="alamat" rows="3"></textarea>
                                @error('alamat')
                                    <div id="alamat" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-12 col-md-6 row">
                                <div class="form-group mb-3 col-12">
                                    <label for="ktp">Kartu Tanda Penduduk</label>
                                    <input name="ktp" type="file" class="form-control-file @error('ktp') is-invalid @enderror"
                                        id="ktp">
                                    @error('ktp')
                                        <div id="ktp" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-12">
                                    <label for="kk">Kartu Keluarga</label>
                                    <input name="kk" type="file" class="form-control-file @error('kk') is-invalid @enderror"
                                        id="kk">
                                    @error('kk')
                                        <div id="kk" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right mx-5">
                        <button class="btn text-white" style="background-color:#004c3f; width: 100%;"
                            onMouseOver="this.style.backgroundColor='#009c86'"
                            onMouseOut="this.style.backgroundColor='#004c3f'">REGISTER</button>
                    </div>
                    <p class="text-center mt-4" style="font-size: 14px">I already have an account <a href="/">Sign
                            In</a></p>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>
