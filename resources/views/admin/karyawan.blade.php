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
                        Data Karyawan
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
                            <h3 class="card-title">Data Karyawan</h3>
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
                                data-bs-target="#tambah-karyawan">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 5l0 14"></path>
                                    <path d="M5 12l14 0"></path>
                                </svg> Tambah Data
                            </a>
                            <form action="/karyawan" method="GET">
                                <div class="row form-group">
                                    <div class="col">
                                        <input type="text" value="{{ request('key') }}" placeholder="Nama Karyawan"
                                            class="form-control" name="key">
                                    </div>
                                    <div class="col">
                                        <select name="dep" aria-placeholder="Departemen" class="form-select"
                                            id="">
                                            <option value="">Semua Departemen</option>
                                            @foreach ($dep as $item)
                                                <option {{ request('dep') == $item->kode_dep ? 'selected' : '' }}
                                                    value="{{ $item->kode_dep }}">{{ $item->nama_dep }}</option>
                                            @endforeach
                                        </select>
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
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Departemen</th>
                                        <th>Jabatan</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($karyawan as $item)
                                        <tr>
                                            <td>{{ $loop->iteration + $karyawan->firstItem() - 1 }}</td>
                                            <td>{{ $item->nik }}</td>
                                            <td>{{ $item->nama_lengkap }}</td>
                                            <td>{{ $item->nama_dep }}</td>
                                            <td>{{ $item->jabatan }}</td>
                                            @php
                                                $path = Storage::url('uploads/karyawan/' . $item->foto);
                                            @endphp
                                            <td><img src="{{ url($path) }}" class="avatar" alt=""></td>
                                            <td>
                                                <button class="btn btn-primary btn-sm editmodal" nik={{ $item->nik }}>
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
                                                <form action="/karyawan/delete/{{ $item->nik }}" method="post">
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm hapuskaryawan">
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
                                {{ $karyawan->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="tambah-karyawan" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formKaryawan" action="/karyawan/store" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">NIK</label>
                            <input type="text" id="nik" class="form-control" name="nik"
                                placeholder="Ex: 123">
                            <small id="peringatan" class="text-danger"></small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" id="nama" class="form-control" name="nama"
                                placeholder="Ex: Sujadmi">
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="mb-3">
                                    <label class="form-label">Departemen</label>
                                    <select name="kode_dep" class="form-select" id="">
                                        @foreach ($dep as $item)
                                            <option value="{{ $item->kode_dep }}">{{ $item->nama_dep }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">Jabatan</label>
                                    <select name="jabatan" class="form-select">
                                        <option value="Staff">Staff</option>
                                        <option value="Kabid">Kabid</option>
                                        <option value="Kabag">Kabag</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input id="password" type="password" class="form-control" name="password">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">No. HP</label>
                                    <input type="text" id="nohp" class="form-control" name="nohp">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Foto</label>
                            <input type="file" class="form-control" name="foto" placeholder="Ex: Sujadmi">
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
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Karyawan</h5>
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
            $('#nik').on('keyup change', function() {
                $.ajax({
                    type: 'post',
                    url: '/karyawan/cek_nik',
                    data: {
                        _token: "{{ csrf_token() }}",
                        nik: $(this).val()
                    },
                    success: function(respon) {
                        if (respon) {
                            $('#peringatan').text('Nik Sudah Ada')
                            $('#simpan').prop("disabled", true);
                        } else {
                            $('#peringatan').text('')
                            $('#simpan').removeAttr('disabled');
                        }
                    }
                })
            });

            $('.editmodal').click(function() {
                const nik = $(this).attr('nik')
                // console.log(nik)
                $.ajax({
                    url: '/karyawan/edit',
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        nik: nik
                    },
                    cache: false,
                    success: function(respon) {
                        $('#loadform').html(respon)
                    }
                })
                $('#editmodal2').modal('show')

            })

            $('.hapuskaryawan').click(function(e) {
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

            $('#formKaryawan').submit(function() {
                nik = $('#nik').val()
                nama = $('#nama').val()
                no = $('#nohp').val()
                password = $('#password').val()

                if (nik == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Warning',
                        text: 'Nik harus diisi!'
                    }).then(() => {
                        $('#nik').focus();
                    })
                    return false;
                }

                if (nama == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Warning',
                        text: 'Nama harus diisi!'
                    }).then(() => {
                        $('#nama').focus();
                    })
                    return false;
                }

                if (no == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Warning',
                        text: 'No HP harus diisi!'
                    }).then(() => {
                        $('#nohp').focus();
                    })
                    return false;
                }

                if (password == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Warning',
                        text: 'Password harus diisi!'
                    }).then(() => {
                        $('#password').focus();
                    })
                    return false;
                }
            });
        })
    </script>
@endpush
