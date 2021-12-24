<x-guest-layout>
    @section('title', 'Login')
    @section('image')
        <img src="/images/login.jpg" alt="" height="100%">
    @endsection
    <div class="card">
        <form action="/login" method="post">
            @csrf
            <div class="card-body">
                <h5 class="card-title mb-3 text-center">LOGIN</h5>
                <div class="card-text">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            id="email">
                        @error('email')
                            <div id="email" class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">
                        @error('password')
                            <div id="password" class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="row mb-4">
                        <div class="col-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-6" style="text-align: right">
                            <a href="/" class="d-inline-block">Forget password ?</a>
                        </div>
                    </div>
                    <div class="text-right mx-5">
                        <button class="btn text-white" style="background-color:#004c3f; width: 100%;"
                            onMouseOver="this.style.backgroundColor='#009c86'"
                            onMouseOut="this.style.backgroundColor='#004c3f'">LOGIN</button>
                    </div>
                    <p class="text-center mt-4" style="font-size: 14px">Don't you have account ? <a
                            href="/register">Sign Up</a></p>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>
