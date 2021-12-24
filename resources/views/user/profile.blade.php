<x-app-layout>
    @section('title', 'Profile')

    <div class="container">
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card">
            <form action="/user/profile" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                <div class="card-body">
                    <h3>Profile</h3>
                    <hr>
                    <div class="row">
                        <div class="my-1 col-12 col-md-6">
                            <label for="name" class="form-label">Username</label>
                            <input value="{{ $user->nama }}" name="name"
                                class="form-control @error('name') is-invalid @enderror" id="name">
                            @error('name')
                                <div id="name" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="my-1 col-12 col-md-6">
                            <label for="nik" class="form-label">NIK</label>
                            <input name="nik" disabled value="{{ $user->nik }}"
                                class="form-control @error('nik') is-invalid @enderror" id="nik">
                            @error('nik')
                                <div id="nik" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="my-1 col-12 col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" disabled value="{{ $user->email }}" name="email"
                                class="form-control @error('email') is-invalid @enderror" id="email">
                            @error('email')
                                <div id="email" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="my-1 col-12 col-md-6">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input name="tempat_lahir" value="{{ $user->tempat_lahir }}"
                                class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir">
                            @error('tempat_lahir')
                                <div id="tempat_lahir" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="my-1 col-12 col-md-6">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" value="{{ $user->tanggal_lahir }}"
                                class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir">
                            @error('tanggal_lahir')
                                <div id="tanggal_lahir" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="my-1 col-12 col-md-6">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin"
                                class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin">
                                <option></option>
                                <option @if ($user->jenis_kelamin == 'Laki-Laki') selected @endif value="Laki-Laki">Laki-Laki</option>
                                <option @if ($user->jenis_kelamin == 'Perempuan') selected @endif value="Perempuan">Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div id="jenis_kelamin" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="my-1 col-12 col-md-6">
                            <label for="agama" class="form-label">Agama</label>
                            <select name="agama" class="form-control @error('agama') is-invalid @enderror" id="agama">
                                <option></option>
                                <option @if ($user->agama == 'Islam') selected @endif value="Islam">Islam</option>
                                <option @if ($user->agama == 'Protestan') selected @endif value="Protestan">Protestan</option>
                                <option @if ($user->agama == 'Katolik') selected @endif value="Katolik">Katolik</option>
                                <option @if ($user->agama == 'Hindu') selected @endif value="Hindu">Hindu</option>
                                <option @if ($user->agama == 'Buddha') selected @endif value="Buddha">Buddha</option>
                                <option @if ($user->agama == 'Khonghucu') selected @endif value="Khonghucu">Khonghucu</option>
                            </select>
                            @error('agama')
                                <div id="agama" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="my-1 col-12 col-md-6">
                            <label for="status_perkawinan" class="form-label">Status Perkawinan</label>
                            <select name="status_perkawinan"
                                class="form-control @error('status_perkawinan') is-invalid @enderror"
                                id="status_perkawinan">
                                <option></option>
                                <option @if ($user->status_perkawinan == 'Sudah Menikah') selected @endif value="Sudah Menikah">Sudah Menikah</option>
                                <option @if ($user->status_perkawinan == 'Belum Menikah') selected @endif value="Belum Menikah">Belum Menikah</option>
                            </select>
                            @error('status_perkawinan')
                                <div id="status_perkawinan" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="my-1 col-12 align-items-center">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                                id="alamat" rows="3">{{ $user->alamat }}</textarea>
                            @error('alamat')
                                <div id="alamat" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mt-3 col-12 row">
                            <div class="my-1 col-12 col-md-6">
                                <label for="password_lama" class="form-label">Password Lama</label>
                                <input type="password" name="password_lama"
                                    class="form-control @error('password_lama') is-invalid @enderror @if(session('error')) is-invalid @endif"
                                    id="password_lama">
                                @error('password_lama')
                                    <div id="password_lama" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                @if (session('error'))
                                    <div id="password_lama" class="invalid-feedback">
                                        {{ session('error') }}
                                    </div>
                                @endif
                            </div>
                            <div class="my-1 col-12 col-md-6">
                                <label for="password_baru" class="form-label">Password Baru</label>
                                <input type="password" name="password_baru"
                                    class="form-control @error('password_baru') is-invalid @enderror" id="password_baru"
                                    aria-describedby="passwordHelp">
                                <small id="passwordHelp" class="form-text text-muted">Isi password baru jika ingin
                                    mengubah
                                    password</small>
                                @error('password_baru')
                                    <div id="password_baru" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn text-white" style="background-color:#004c3f;"
                                onMouseOver="this.style.backgroundColor='#009c86'"
                                onMouseOut="this.style.backgroundColor='#004c3f'">
                                <div class="fas fa-save"></div>
                                SAVE
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
