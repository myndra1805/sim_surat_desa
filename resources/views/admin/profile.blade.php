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
            <form action="/admin/profile" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                <div class="card-body">
                    <h3>Profile</h3>
                    <hr>
                    <div class="row">
                        <div class="my-3 col-12 col-md-6">
                            <label for="name" class="form-label">Username</label>
                            <input value="{{ Auth::user()->name }}" name="name"
                                class="form-control @error('name') is-invalid @enderror" id="name">
                            @error('name')
                                <div id="name" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="my-3 col-12 col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input value="{{ Auth::user()->email }}" name="email" value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror" id="email">
                            @error('email')
                                <div id="email" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="my-3 col-12 col-md-6">
                            <label for="password_lama" class="form-label">Password Lama</label>
                            <input type="password" name="password_lama"
                                class="form-control @error('password_lama') is-invalid @enderror  @if(session('error')) is-invalid @endif" id="password_lama">
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
                        <div class="my-3 col-12 col-md-6">
                            <label for="password_baru" class="form-label">Password Baru</label>
                            <input type="password" name="password_baru"
                                class="form-control @error('password_baru') is-invalid @enderror" id="password_baru"
                                aria-describedby="passwordHelp">
                            <small id="passwordHelp" class="form-text text-muted">Isi password baru jika ingin mengubah
                                password</small>
                            @error('password_baru')
                                <div id="password_baru" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <button class="btn text-white" style="background-color:#004c3f;"
                            onMouseOver="this.style.backgroundColor='#009c86'"
                            onMouseOut="this.style.backgroundColor='#004c3f'">
                            <div class="fas fa-save"></div>
                            SAVE
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
