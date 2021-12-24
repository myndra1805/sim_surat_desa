<x-app-layout>
    @section('title', 'Dashboard')

    <style>
        #icon-info {
            display: flex;
            align-items: center;
            position: relative;
        }

        #icon-info::after {
            height: 0;
            width: 0;
            content: "";
            display: block;
            border-top: 12px solid transparent;
            border-bottom: 12px solid transparent;
            border-left: 12px solid #004c3f;
            position: absolute;
            right: -10px;
        }

    </style>

    <div class="container">
        <div class="card" style="border: 1px solid #004c3f">
            <div class="d-flex align-items-center">
                <div class="pr-4 p-3" id="icon-info" style="height: 100%; background-color: #004c3f;">
                    <i class="fas fa-info fa-3x text-white"></i>
                </div>
                <div class="p-3">
                    <h5 class="mb-0">Selamat Datang</h5>
                    <p class="mb-0">Hai {{ Auth::user()->name }}, anda login menggunakan email
                        {{ Auth::user()->email }} dengan hak akses sebagai Masyarakat</p>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
