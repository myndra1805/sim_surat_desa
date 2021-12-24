<x-app-layout>
    @section('title', 'Surat')

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
                            <div>
                                <button data-toggle="modal" data-target="#modalCreateSurat" class="btn text-white"
                                    style="background-color:#004c3f; width: 100%;"
                                    onMouseOver="this.style.backgroundColor='#009c86'"
                                    onMouseOut="this.style.backgroundColor='#004c3f'">Buat Permintaan Surat</button>
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


    <!-- Modal -->
    <div class="modal fade" id="modalCreateSurat" tabindex="-1" aria-labelledby="modalCreateSuratLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/surat/create" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCreateSuratLabel">Create Permintaan Surat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori Surat</label>
                            <select name="kategori" class="form-control @error('kategori') is-invalid @enderror"
                                id="kategori">
                                <option></option>
                                <option @if(old('kategori') === 'Surat Keterangan Tidak Mampu') selected @endif value="Surat Keterangan Tidak Mampu">Surat Keterangan Tidak Mampu</option>
                                <option @if(old('kategori') === 'Surat Pengantar SKCK') selected @endif value="Surat Pengantar SKCK">Pengantar SKCK</option>
                                <option @if(old('kategori') === 'Surat Keterangan Belum Menikah') selected @endif value="Surat Keterangan Belum Menikah">Surat Keterangan Belum Menikah</option>
                            </select>
                            @error('kategori')
                                <div id="kategori" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener("DOMContentLoaded", event => {
            $(document).ready(function() {
                `@error('kategori')
                ${$('#modalCreateSurat').modal('show')}
                @enderror`
                const table = $('#table_id').DataTable({
                    responsive: true,
                    processing: true,
                    serverside: true,
                    ajax: "{{ Url('/surat/read') }}",
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
                    ]
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
    </script>

</x-app-layout>
