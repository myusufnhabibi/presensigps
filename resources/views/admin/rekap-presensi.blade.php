@extends('layouts.admin.tabler')
@section('content')
    <!-- Page header -->

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Laporan
                    </div>
                    <h2 class="page-title">
                        Rekap Presensi
                    </h2>
                </div>

            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Keyword</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <select class="form-select" id="bulan">
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ date('m') * 1 == $i ? 'selected' : '' }}>
                                            {{ $bulans[$i] }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <select name="tahun" id="tahun" class="form-select">
                                    @for ($i = 2020; $i <= date('Y'); $i++)
                                        <option value="{{ $i }}" {{ date('Y') == $i ? 'selected' : '' }}>
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <button id="cari" class="btn btn-primary">Cari</button>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col" id="loadtable">


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        $(function() {
            $('#cari').on('click', function() {
                const bulan = $('#bulan').val()
                const tahun = $('#tahun').val()
                // console.log(tgl)
                $.ajax({
                    type: 'post',
                    url: '/getRekap',
                    cache: false,
                    data: {
                        _token: '{{ csrf_token() }}',
                        bulan: bulan,
                        tahun: tahun
                    },
                    success: function(respon) {
                        $('#loadtable').html(respon)
                    }
                })
            })
        })
    </script>
@endpush
