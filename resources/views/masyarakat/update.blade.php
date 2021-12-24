<x-app-layout>
    @section('title', 'Update Masyarakat')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h3>Update Masyarakat</h3>
                <hr>
                <form action="/masyarakat/update" method="post">
                    @csrf
                    @method('put')
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <div class="mb-3">
                        <label for="name" class="form-label">Username</label>
                        <input name="name" value="{{ $user->name }}"
                            class="form-control @error('name') is-invalid @enderror" id="name">
                        @error('name')
                            <div id="name" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" value="{{ $user->email }}" name="email"
                            class="form-control @error('email') is-invalid @enderror" id="email">
                        @error('email')
                            <div id="email" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" value="" name="password"
                            class="form-control @error('password') is-invalid @enderror" id="password"
                            aria-describedby="passwordHelp">
                        <small id="passwordHelp" class="form-text">Isi password jika ingin mengubah
                            password</small>
                        @error('password')
                            <div id="password" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div>
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
