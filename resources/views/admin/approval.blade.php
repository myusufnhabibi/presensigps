@extends('layouts.admin.tabler')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Approval
                    </div>
                    <h2 class="page-title">
                        Pengajuan Izin
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
                            <h3 class="card-title">Data Pengajuan Izin</h3>
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
                            <form action="/approval" method="GET">
                                <div class="row form-group">
                                    <div class="col">
                                        <div class="input-icon">
                                            <span class="input-icon-addon">
                                                <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-calendar" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path
                                                        d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z">
                                                    </path>
                                                    <path d="M16 3v4"></path>
                                                    <path d="M8 3v4"></path>
                                                    <path d="M4 11h16"></path>
                                                    <path d="M11 15h1"></path>
                                                    <path d="M12 15v3"></path>
                                                </svg>
                                            </span>
                                            <input type="date" value="{{ request('tgl_mulai') }}"
                                                placeholder="Tanggal Mulai" class="form-control" name="tgl_mulai">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="input-icon">
                                            <span class="input-icon-addon">
                                                <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-calendar" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path
                                                        d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z">
                                                    </path>
                                                    <path d="M16 3v4"></path>
                                                    <path d="M8 3v4"></path>
                                                    <path d="M4 11h16"></path>
                                                    <path d="M11 15h1"></path>
                                                    <path d="M12 15v3"></path>
                                                </svg>
                                            </span>
                                            <input type="date" value="{{ request('tgl_selesai') }}"
                                                placeholder="Tanggal Selesai" class="form-control" name="tgl_selesai">
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group mt-2">
                                    <div class="col">
                                        <div class="input-icon">
                                            <span class="input-icon-addon">
                                                <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-user-check" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4"></path>
                                                    <path d="M15 19l2 2l4 -4"></path>
                                                </svg>
                                            </span>
                                            <input type="text" value="{{ request('key') }}" placeholder="Nama Karyawan"
                                                class="form-control" name="key">
                                        </div>
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
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
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
                                        <th>Tanggal Izin</th>
                                        <th>Keterangan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($izin as $item)
                                        <tr>
                                            <td>{{ $loop->iteration + $izin->firstItem() - 1 }}</td>
                                            <td>{{ $item->nik }}</td>
                                            <td>{{ $item->nama_lengkap }}</td>
                                            <td>{{ $item->nama_dep }}</td>
                                            <td>{{ $item->tgl_izin }}</td>
                                            <td>{{ $item->keterangan }}</td>
                                            <td>
                                                @if ($item->status == '0')
                                                    <span class="badge bg-warning">Pending</span>
                                                @elseif ($item->status == '1')
                                                    <span class="badge bg-success">Accept</span>
                                                @else
                                                    <span class="badge bg-danger">Decline</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->status == '0')
                                                    <button class="btn btn-primary btn-sm editmodal"
                                                        id={{ $item->id }}>
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
                                                @else
                                                    <form action="/approval/destroy/{{ $item->id }}" method="post">
                                                        @csrf
                                                        <button class="btn btn-danger btn-sm batalkan mt-1">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="icon icon-tabler icon-tabler-trash" width="24"
                                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                                stroke="currentColor" fill="none"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                                </path>
                                                                <path d="M4 7l16 0"></path>
                                                                <path d="M10 11l0 6"></path>
                                                                <path d="M14 11l0 6"></path>
                                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12">
                                                                </path>
                                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                            </svg>
                                                            Batalkan
                                                        </button>
                                                    </form>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="container-xl mt-2">
                                {{ $izin->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="editmodal2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Pengajuan</h5>
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
            $('.editmodal').click(function() {
                const id = $(this).attr('id')
                // console.log(id)
                $.ajax({
                    url: '/approval/edit',
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    cache: false,
                    success: function(respon) {
                        $('#loadform').html(respon)
                    }
                })
                $('#editmodal2').modal('show')

            })

            $('.batalkan').click(function(e) {
                e.preventDefault()
                const form = $(this).closest('form')
                Swal.fire({
                    title: 'Apakah yakin dibatalkan?',
                    text: "Data akan menjadi pending!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Batalkan'
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
        })
    </script>
@endpush
