<x-app-layout>
    @section('title', 'Surat')

    <style>
        td.detail {
            cursor: pointer;
            background-size: 15px;
            background-position: center;
            background-repeat: no-repeat;
            background-image: url("{{ asset('/images/icons/plus.png') }}");
        }

        tr.shown td.detail {
            background-image: url("{{ asset('/images/icons/negative.png') }}");
            font-size: 20px;
            background-size: 15px;
            background-position: center;
            background-repeat: no-repeat;
        }

    </style>

    <div class="container py-3">
        <div class="row">
            <div class="col-12">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">Table Surat</h4>
                            <div>
                                <a href="/surat/export" class="btn text-white"
                                    style="background-color:#004c3f; width: 100%;"
                                    onMouseOver="this.style.backgroundColor='#009c86'"
                                    onMouseOut="this.style.backgroundColor='#004c3f'">Export Excell</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="overflow: auto;">
                        <table style="width: 100%;" id="table_id" class="display responsive nowrap">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Jenis Surat</th>
                                    <th>Status</th>
                                    <th>Tanggal Dikirim</th>
                                    <th>Aksi</th>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Accepted -->
    <form action="/surat/accepted" method="post" id="form-accepted">
        @csrf
        <input type="hidden" name="id" id="id-accepted">
    </form>
    <!-- /.Form Accepted -->

    <!-- Form Rejected -->
    <form action="/surat/rejected" method="post" id="form-rejected">
        @csrf
        <input type="hidden" name="id" id="id-rejected">
    </form>
    <!-- /.Form Rejected -->

    <script>
        window.addEventListener("DOMContentLoaded", event => {
            $(document).ready(function() {
                const table = $('#table_id').DataTable({
                    responsive: true,
                    processing: true,
                    serverside: true,
                    ajax: "{{ Url('/surat/read-admin') }}",
                    columns: [{
                            "data": null,
                            "sortable": false,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1
                            },
                            className: 'text-center font-weight-bold'
                        },
                        {
                            data: 'kategori',
                            name: 'kategori'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'tanggal_dikirim',
                            name: 'tanggal_dikirim'
                        },
                        {
                            data: 'aksi',
                            name: 'aksi',
                            orderable: false
                        },
                        {
                            data: 'detail',
                            name: 'detail',
                            className: 'detail',
                            orderable: false
                        },
                    ]
                });

                $('#table_id tbody').on('click', 'td.detail', function() {
                    var tr = $(this).closest('tr');
                    var row = table.row(tr);

                    if (row.child.isShown()) {
                        // This row is already open - close it
                        row.child.hide();
                        tr.removeClass('shown');
                    } else {
                        // Open this row
                        row.child(format(row.data())).show();
                        tr.addClass('shown');
                    }
                });
            });
        })

        function accepted(event) {
            Swal.fire({
                title: 'Confirm',
                text: 'Kamu ingin menyetujui permintaan ini ?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then(response => {
                if (response.isConfirmed) {
                    document.querySelector("#id-accepted").value = event.target.dataset.id
                    document.querySelector("#form-accepted").submit()
                }
            })
        }

        function rejected(event) {
            Swal.fire({
                title: 'Confirm',
                text: 'Kamu ingin menolak permintaan ini ?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then(response => {
                if (response.isConfirmed) {
                    document.querySelector("#id-rejected").value = event.target.dataset.id
                    document.querySelector("#form-rejected").submit()
                }
            })
        }

        function format(data) {
            const div = document.createElement('div')
            div.innerHTML = data.materi
            return `
             <div class="container">
              <table cellpadding="5" cellspacing="0" border="0">
                <tr>
                  <td>Nama</td>
                  <td class="text-wrap">: ${data.nama}</td>
                </tr>
                <tr>
                  <td>NIK</td>
                  <td class="text-wrap">: ${data.nik}</td>
                </tr>
                <tr>
                  <td>Tempat Lahir</td>
                  <td class="text-wrap">: ${data.tempat_lahir}</td>
                </tr>
                <tr>
                  <td>Tanggal Lahir</td>
                  <td class="text-wrap">: ${data.tanggal_lahir}</td>
                </tr>
                <tr>
                  <td>Jenis Kelamin</td>
                  <td class="text-wrap">: ${data.jenis_kelamin}</td>
                </tr>
                <tr>
                  <td>Agama</td>
                  <td class="text-wrap">: ${data.agama}</td>
                </tr>
                <tr>
                  <td>Status Perkawinan</td>
                  <td class="text-wrap">: ${data.status_perkawinan}</td>
                </tr>
                <tr>
                  <td>Alamat</td>
                  <td class="text-wrap">: ${data.alamat}</td>
                </tr>
                <tr>
                  <td class="text-wrap"><img width="100%" src="/storage/ktp/${data.ktp}" alt="KTP"></td>
                  <td class="text-wrap"><img width="100%" src="/storage/kk/${data.kk}" alt="KK"></td>
                </tr>
              </table>
             </div>`
        }
    </script>

</x-app-layout>
