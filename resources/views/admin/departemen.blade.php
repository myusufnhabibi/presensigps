@extends('layouts.admin.tabler')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Master
                    </div>
                    <h2 class="page-title">
                        Data Departemen
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Departemen</h3>
                        </div>
                        @php
                            $success = Session::get('success');
                            $danger = Session::get('danger');
                        @endphp
                        @if (Session::get('success'))
                            <div class="alert alert-success mt-2">
                                {{ $success }}
                            </div>
                        @endif
                        @if (Session::get('danger'))
                            <div class="alert alert-danger mt-2">
                                {{ $danger }}
                            </div>
                        @endif

                        <div class="card-body border-bottom py-3">
                            <a href="#" class="btn btn-twitter mb-2" data-bs-toggle="modal"
                                data-bs-target="#tambah-departemen">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 5l0 14"></path>
                                    <path d="M5 12l14 0"></path>
                                </svg> Tambah Data
                            </a>
                            <form action="/departemen" method="GET">
                                <div class="row form-group">
                                    <div class="col">
                                        <input type="text" value="{{ request('key') }}" placeholder="Nama Departemen"
                                            class="form-control" name="key">
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-search" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                                <path d="M21 21l-6 -6"></path>
                                            </svg> Cari</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Departemen</th>
                                        <th>Nama Departemen</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($departemen as $item)
                                        <tr>
                                            <td>{{ $loop->iteration + $departemen->firstItem() - 1 }}</td>
                                            <td>{{ $item->kode_dep }}</td>
                                            <td>{{ $item->nama_dep }}</td>
                                            <td>
                                                <button class="btn btn-primary btn-sm editmodal" dep={{ $item->kode_dep }}>
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-edit" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path
                                                            d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1">
                                                        </path>
                                                        <path
                                                            d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                                        </path>
                                                        <path d="M16 5l3 3"></path>
                                                    </svg>
                                                </button>
                                                <form action="/departemen/delete/{{ $item->kode_dep }}" method="post">
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm hapusdepartemen">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-trash" width="24"
                                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M4 7l16 0"></path>
                                                            <path d="M10 11l0 6"></path>
                                                            <path d="M14 11l0 6"></path>
                                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12">
                                                            </path>
                                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="container-xl mt-2">
                                {{ $departemen->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="tambah-departemen" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Departemen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formDepartemen" action="/departemen/store" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Kode Departemen</label>
                            <input type="text" id="dep" class="form-control" name="dep"
                                placeholder="Ex: KEU">
                            <small id="peringatan" class="text-danger"></small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Departemen</label>
                            <input type="text" id="nama" class="form-control" name="nama"
                                placeholder="Ex: Keuangan">
                        </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <button id="simpan" class="btn btn-primary">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->

                        Simpan
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal modal-blur fade" id="editmodal2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Departemen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="loadform">

                </div>
            </div>
        </div>
    </div>
@endsection

@push('myscript')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(function() {
            $('#dep').on('keyup change', function() {
                $.ajax({
                    type: 'post',
                    url: '/departemen/cek_dep',
                    data: {
                        _token: "{{ csrf_token() }}",
                        dep: $(this).val()
                    },
                    success: function(respon) {
                        if (respon) {
                            $('#peringatan').text('Departemen Sudah Ada')
                            $('#simpan').prop("disabled", true);
                        } else {
                            $('#peringatan').text('')
                            $('#simpan').removeAttr('disabled');
                        }
                    }
                })
            });

            $('.editmodal').click(function() {
                const dep = $(this).attr('dep')
                // console.log(nik)
                $.ajax({
                    url: '/departemen/edit',
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        dep: dep
                    },
                    cache: false,
                    success: function(respon) {
                        $('#loadform').html(respon)
                    }
                })
                $('#editmodal2').modal('show')

            })

            $('.hapusdepartemen').click(function(e) {
                e.preventDefault()
                const form = $(this).closest('form')
                Swal.fire({
                    title: 'Apakah yakin dihapus?',
                    text: "Data akan hilang secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();

                        // Swal.fire(
                        //     'Deleted!',
                        //     'Your file has been deleted.',
                        //     'success'
                        // )
                    }
                })
            })

            $('#formDepartemen').submit(function() {
                dep = $('#dep').val()
                nama = $('#nama').val()

                if (dep == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Warning',
                        text: 'Kode Departemen harus diisi!'
                    }).then(() => {
                        $('#dep').focus();
                    })
                    return false;
                }

                if (nama == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Warning',
                        text: 'Nama Departemen harus diisi!'
                    }).then(() => {
                        $('#nama').focus();
                    })
                    return false;
                }
            });
        })
    </script>
@endpush
