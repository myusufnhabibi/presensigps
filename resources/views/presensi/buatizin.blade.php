@extends('layouts.main')
@section('header')
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Form Izin</div>
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
                <div class="alert alert-success">
                    {{ $success }}
                </div>
            @endif
            @if (Session::get('danger'))
                <div class="alert alert-danger">
                    {{ $danger }}
                </div>
            @endif
        </div>
    </div>
    <form action="/presensi/proses-buatizin" method="POST">
        @csrf
        <div class="col">
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <input type="date" required class="form-control" name="tgl" autocomplete="off">
                </div>
            </div>
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <select name="izin" required class="form-control">
                        <option value="s">Sakit</option>
                        <option value="i">Izin</option>
                    </select>
                </div>
            </div>
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <textarea name="ket" class="form-control" id="" cols="30" rows="5"></textarea>
                </div>
            </div>
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <button type="submit" class="btn btn-primary btn-block">
                        <ion-icon name="save-outline"></ion-icon>
                        Buat Izin
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
