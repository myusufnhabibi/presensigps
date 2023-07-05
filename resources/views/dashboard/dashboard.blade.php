@extends('layouts.main')
@section('content')
    <style>
        #logout {
            position: absolute;
            color: white;
            font-size: 40px;
            right: 20px;
            top: 20px
        }
    </style>
    <a id="logout" href="/proseslogout"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout"
            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
            stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>
            <path d="M9 12h12l-3 -3"></path>
            <path d="M18 15l3 -3"></path>
        </svg></a>
    <div class="section" id="user-section">
        <div id="user-detail">
            <div class="avatar">
                @php
                    $path = Storage::url('uploads/karyawan/' . Auth::guard()->user()->foto);
                @endphp
                @if (Auth::guard()->user()->foto != null)
                    <img src="{{ url($path) }}" alt="avatar" class="imaged w64 rounded">
                @else
                    <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w64 rounded">
                @endif
            </div>
            <div id="user-info">
                <h2 id="user-name">{{ Auth::guard('karyawan')->user()->nama_lengkap }}</h2>
                <span id="user-role">{{ Auth::guard('karyawan')->user()->jabatan }}</span>
            </div>
        </div>
    </div>

    <div class="section" id="menu-section">
        <div class="card">
            <div class="card-body text-center">
                <div class="list-menu">
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="/presensi/update-profile" class="green" style="font-size: 40px;">
                                <ion-icon name="person-sharp"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Profil</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="/presensi/izin" class="danger" style="font-size: 40px;">
                                <ion-icon name="calendar-number"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Cuti</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="/presensi/history" class="warning" style="font-size: 40px;">
                                <ion-icon name="document-text"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Histori</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="/presensi/create" class="orange" style="font-size: 40px;">
                                <ion-icon name="location"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            Lokasi
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section mt-2" id="presence-section">
        <div class="todaypresence">
            <div class="row">
                <div class="col-6">
                    <div class="card gradasigreen">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence">
                                    @if ($presensi != null)
                                        @php
                                            $path = Storage::url('uploads/absensi/' . $presensi->foto_in);
                                        @endphp
                                        <img src="{{ url($path) }}" class="imaged w64" alt="">
                                    @else
                                        <ion-icon name="camera"></ion-icon>
                                    @endif
                                </div>
                                <div class="presencedetail">
                                    <h4 class="presencetitle">Masuk</h4>
                                    <span>{{ $presensi != null ? $presensi->jam_in : 'Belum Absen' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card gradasired">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence">
                                    @if ($presensi != null && $presensi->jam_out != null)
                                        @php
                                            $path = Storage::url('uploads/absensi/' . $presensi->foto_out);
                                        @endphp
                                        <img src="{{ url($path) }}" class="imaged w64" alt="">
                                    @else
                                        <ion-icon name="camera"></ion-icon>
                                    @endif
                                </div>
                                <div class="presencedetail">
                                    <h4 class="presencetitle">Pulang</h4>
                                    <span>{{ $presensi != null && $presensi->jam_out != null ? $presensi->jam_out : 'Belum Absen' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="rekappresence">
            <h4>Rekap Presensi Bulan {{ $bulan_ini . ' ' . date('Y') }}</h4>
            <div class="row">
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 16px 12px !important">
                            <span class="badge bg-danger"
                                style="position: absolute; top: 5px; right:10px; font-size: 0.6rem; z-index:99">{{ $rekap->hadir ?? 0 }}</span>
                            <ion-icon name="accessibility-outline" style="font-size: 1.6rem" class="text-success">
                            </ion-icon>
                            <br>
                            <span style="font-size: 0.8rem; font-weight:500">Hadir</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 16px 12px !important">
                            <span class="badge bg-danger"
                                style="position: absolute; top: 5px; right:10px; font-size: 0.6rem; z-index:99">{{ $rekap->telat ?? 0 }}</span>
                            <ion-icon name="alarm-outline" style="font-size: 1.6rem" class="text-danger"></ion-icon>
                            <br>
                            <span style="font-size: 0.8rem; font-weight:500">Telat</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 16px 12px !important">
                            <span class="badge bg-danger"
                                style="position: absolute; top: 5px; right:10px; font-size: 0.6rem; z-index:99">{{ $rekapizin->ssakit ?? 0 }}</span>
                            <ion-icon name="medkit-outline" style="font-size: 1.6rem " class="text-warning"></ion-icon>
                            <br>
                            <span style="font-size: 0.8rem; font-weight:500">Sakit</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 16px 12px !important">
                            <span class="badge bg-danger"
                                style="position: absolute; top: 5px; right:10px; font-size: 0.6rem; z-index:99">{{ $rekapizin->izin ?? 0 }}</span>
                            <ion-icon name="newspaper-outline" style="font-size: 1.6rem" class="text-primary"></ion-icon>
                            <br>
                            <span style="font-size: 0.8rem; font-weight:500">Izin</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="presencetab mt-2">
            <div class="tab-pane fade show active" id="pilled" role="tabpanel">
                <ul class="nav nav-tabs style1" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                            Bulan Ini
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                            Leaderboard
                        </a>
                    </li>
                </ul>
            </div>
            <div class="tab-content mt-2" style="margin-bottom:100px;">
                <div class="tab-pane fade show active" id="home" role="tabpanel">
                    <ul class="listview image-listview">
                        @foreach ($presensi_bln_ini as $bln)
                            <li>
                                <div class="item">
                                    <div class="icon-box bg-primary">
                                        <ion-icon name="calendar-outline" role="img" class="md hydrated"
                                            aria-label="calendar outline"></ion-icon>
                                    </div>
                                    <div class="in">
                                        <div>{{ $bln->tgl_presensi }}</div>
                                        <span class="badge badge-success">{{ $bln->jam_in }}</span>
                                        <span
                                            class="badge badge-danger">{{ $bln != null && $bln->jam_out != null ? $bln->jam_out : 'Belum Absen' }}</span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel">
                    <ul class="listview image-listview">
                        @foreach ($leaderboard as $item)
                            <li>
                                <div class="item">
                                    <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                                    <div class="in">
                                        <div>
                                            <b>{{ $item->nama_lengkap }}</b>
                                            <br>
                                            <small class="text-muted">{{ $item->jabatan }}</small>
                                        </div>
                                        <span class="badge {{ $item->jam_in > '07:00' ? 'bg-danger' : 'bg-success' }}">
                                            {{ $item->jam_in }}
                                        </span>
                                    </div>
                                </div>
                            </li>
                        @endforeach

                    </ul>
                </div>

            </div>
        </div>
    </div>
@endsection
