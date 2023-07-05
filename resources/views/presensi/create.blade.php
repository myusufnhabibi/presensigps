@extends('layouts.main')
@section('header')
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Absen</div>
        <div class="right"></div>
    </div>
@endsection
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<style>
    .webcam-wraper,
    .webcam-wraper video {
        display: inline-block;
        width: 100% !important;
        height: auto !important;
        margin: auto;
        border-radius: 15px;

    }

    #map {
        height: 180px;
    }
</style>
@section('content')
    <div class="row" style='margin-top: 70px'>
        <div class="col">
            <div class="webcam-wraper"></div>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col">
            @if ($cek > 0)
                <button id="absen" class="btn btn-warning btn-block">
                    <ion-icon name="camera-outline" role="img" class="md hydrated">
                    </ion-icon> Absen Pulang
                </button>
            @else
                <button id="absen" class="btn btn-primary btn-block">
                    <ion-icon name="camera-outline" role="img" class="md hydrated">
                    </ion-icon> Absen Masuk
                </button>
            @endif

        </div>
    </div>
    <div class="row mt-1">
        <div class="col">
            <div id="map"></div>
        </div>
    </div>
    <input type="hidden" id="lokasi">
@endsection
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@push('myscript')
    <script>
        Webcam.set({
            width: 480,
            height: 320,
            image_format: 'jpeg',
            jpeg_quality: 90
        })

        Webcam.attach('.webcam-wraper')

        var lokasi = document.getElementById('lokasi');
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successCallback, ErrorCallback);
        }

        function successCallback(posisi) {
            lokasi.value = posisi.coords.latitude + "," + posisi.coords.longitude;
            var map = L.map('map').setView([posisi.coords.latitude, posisi.coords.longitude], 13);
            var pos = '{{ $lokasi->lokasi }}'
            tkp = pos.split(',')
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
            var marker = L.marker([posisi.coords.latitude, posisi.coords.longitude]).addTo(map);
            var circle = L.circle([tkp[0], tkp[1]], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
                radius: '{{ $lokasi->radius }}'
            }).addTo(map);
        }

        function ErrorCallback() {

        }

        $('#absen').click(function(e) {
            e.preventDefault()
            Webcam.snap(function(uri) {
                image = uri
            })
            var tkp = $('#lokasi').val()
            $.ajax({
                type: 'POST',
                url: '/presensi/store',
                data: {
                    _token: "{{ csrf_token() }}",
                    image: image,
                    tkp: tkp
                },
                cache: false,
                success: function(response) {
                    const pesan = response.split("|")
                    if (pesan[0] == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Informasi',
                            text: pesan[1]
                        })
                        setTimeout(() => {
                            location.href = '/dashboard';
                        }, 3000);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: pesan[1]
                        })
                    }
                }
            })
        });
    </script>
@endpush
