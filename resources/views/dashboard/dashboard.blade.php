@extends('layouts.main')
@section('content')
    <div class="section" id="user-section">
        <div id="user-detail">
            <div class="avatar">
                <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w64 rounded">
            </div>
            <div id="user-info">
                <h2 id="user-name">Adam Abdi Al A'la</h2>
                <span id="user-role">Head of IT</span>
            </div>
        </div>
    </div>

    <div class="section" id="menu-section">
        <div class="card">
            <div class="card-body text-center">
                <div class="list-menu">
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="" class="green" style="font-size: 40px;">
                                <ion-icon name="person-sharp"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Profil</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="" class="danger" style="font-size: 40px;">
                                <ion-icon name="calendar-number"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Cuti</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="" class="warning" style="font-size: 40px;">
                                <ion-icon name="document-text"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Histori</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="" class="orange" style="font-size: 40px;">
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
                                style="position: absolute; top: 5px; right:10px; font-size: 0.6rem; z-index:99">10</span>
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
                                style="position: absolute; top: 5px; right:10px; font-size: 0.6rem; z-index:99">10</span>
                            <ion-icon name="newspaper-outline" style="font-size: 1.6rem" class="text-primary"></ion-icon>
                            <br>
                            <span style="font-size: 0.8rem; font-weight:500">Izin</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 16px 12px !important">
                            <span class="badge bg-danger"
                                style="position: absolute; top: 5px; right:10px; font-size: 0.6rem; z-index:99">10</span>
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
                                style="position: absolute; top: 5px; right:10px; font-size: 0.6rem; z-index:99">10</span>
                            <ion-icon name="alarm-outline" style="font-size: 1.6rem" class="text-danger"></ion-icon>
                            <br>
                            <span style="font-size: 0.8rem; font-weight:500">Telat</span>
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
                                        <span
                                            class="badge badge-success">{{ date('d-m-Y', strtotime($bln->tgl_presensi)) }}</span>
                                        <span
                                            class="badge badge-danger">{{ $presensi != null && $presensi->jam_out != null ? $presensi->jam_out : 'Belum Absen' }}</span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel">
                    <ul class="listview image-listview">
                        <li>
                            <div class="item">
                                <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                                <div class="in">
                                    <div>Edward Lindgren</div>
                                    <span class="text-muted">Designer</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item">
                                <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                                <div class="in">
                                    <div>Emelda Scandroot</div>
                                    <span class="badge badge-primary">3</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item">
                                <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                                <div class="in">
                                    <div>Henry Bove</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item">
                                <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                                <div class="in">
                                    <div>Henry Bove</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item">
                                <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                                <div class="in">
                                    <div>Henry Bove</div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
@endsection
