@extends('layouts.main')
@section('header')
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">History Izin</div>
        <div class="right"></div>
    </div>
@endsection
@section('content')
    <div class="row" style="margin-top: 4rem">
        <div class="col">
            @php
                $success = Session::get('success');
                $danger = Session::get('danger');
            @endphp
            @if (Session::get('success'))
                <div class="alert alert-success mb-2">
                    {{ $success }}
                </div>
            @endif
            @if (Session::get('danger'))
                <div class="alert alert-danger mb-2">
                    {{ $danger }}
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col">
            <ul class="listview image-listview">
                @foreach ($listizin as $item)
                    <li>
                        <div class="item">
                            <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                            <div class="in">
                                <div>
                                    {{ date('d-m-Y', strtotime($item->tgl_izin)) }}<b> -
                                        ({{ $item->izin == 's' ? 'Sakit' : 'Izin' }})
                                    </b>
                                    <br>
                                    <small class="text-muted">{{ $item->keterangan }}</small>
                                </div>
                                @if ($item->status == '0')
                                    <span class="badge bg-warning">Waiting</span>
                                @elseif($item->status == '1')
                                    <span class="badge bg-success">Approval</span>
                                @else
                                    <span class="badge bg-danger">Decline</span>
                                @endif

                                </span>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="fab-button bottom-right" style="margin-bottom: 70px">
        <a href="/presensi/buatizin" class="fab">
            <ion-icon name="add-outline"></ion-icon>
        </a>
    </div>
@endsection
