<x-app-layout>
    @section('title', 'Masyarakat')

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
                            <h4 class="mb-0">Table Masyarakat</h4>
                        </div>
                    </div>
                    <div class="card-body" style="overflow: auto;">
                        <table style="width: 100%;" id="table_id" class="display responsive nowrap">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Username</th>
                                    <th>Email</th>
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

    <!-- Form delete -->
    <form action="/masyarakat/delete" method="post" id="form-delete">
        @csrf
        @method('delete')
        <input type="hidden" name="id" id="id-delete">
    </form>
    <!-- /.Form delete -->

    <script>
        window.addEventListener("DOMContentLoaded", event => {
            $(document).ready(function() {
                const table = $('#table_id').DataTable({
                    responsive: true,
                    processing: true,
                    serverside: true,
                    ajax: "{{ Url('/masyarakat/read') }}",
                    columns: [{
                            "data": null,
                            "sortable": false,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1
                            },
                            className: 'text-center font-weight-bold'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'email',
                            name: 'email'
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

        function destroy(event) {
            Swal.fire({
                title: 'Confirm',
                text: 'Kamu ingin menghapus data ?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then(response => {
                if (response.isConfirmed) {
                    document.querySelector("#id-delete").value = event.target.dataset.id
                    document.querySelector("#form-delete").submit()
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
