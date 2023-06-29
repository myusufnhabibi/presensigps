@extends('layouts.main')
@section('header')
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">History Presensi</div>
        <div class="right"></div>
    </div>
@endsection
@section('content')
    <div class="row" style="margin-top: 4rem">
        <div class="col">
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <select name="bulan" id="bulan" class="form-control">
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ date('m') * 1 == $i ? 'selected' : '' }}>
                                {{ $bulans[$i] }}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <select name="tahun" id="tahun" class="form-control">

                        @for ($i = 2020; $i <= date('Y'); $i++)
                            <option value="{{ $i }}" {{ date('Y') == $i ? 'selected' : '' }}>{{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="form-group boxed">
                <div class="input-wrapper">
                    <button id="cari" class="btn btn-primary btn-block">
                        <ion-icon name="search-outline"></ion-icon>
                        Cari
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col" id="listnya"></div>
    </div>
@endsection

@push('myscript')
    <script>
        $(function() {
            $('#cari').on('click', function() {
                const bulan = $('#bulan').val()
                const tahun = $('#tahun').val()
                $.ajax({
                    type: 'POST',
                    url: '/presensi/proses-history',
                    data: {
                        _token: "{{ csrf_token() }}",
                        bulan: bulan,
                        tahun: tahun
                    },
                    cache: false,
                    success: function(respon) {
                        $('#listnya').html(respon)
                    }

                })
            })
        })
    </script>
@endpush
