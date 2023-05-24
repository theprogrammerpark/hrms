@extends('layouts.presensi')
@section('content')
<style>
    .logout{
        position: absolute;
        color: white;
        font-size: 60px;
        text-decoration: none;
        right: 20px;
    }

    .logout:hover{
        color: white;
    }
</style>

<div class="section" id="user-section">
    <a href="/proseslogout" class="logout">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>
            <path d="M9 12h12l-3 -3"></path>
            <path d="M18 15l3 -3"></path>
         </svg>
    </a>
    <div id="user-detail">
        <div class="avatar">
            @if (!empty(Auth::guard('karyawan')->user()->foto))
                @php
                $path = Storage::url('uploads/profile/'.Auth::guard('karyawan')->user()->foto);
                @endphp
                <img src="{{ url($path) }}" alt="avatar" class="imaged w64 rounded" style="height: 60px">
            @else
                <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w64 rounded">
            @endif
        </div>
        <div id="user-info">
            <h2 id="user-name">{{ Auth::guard('karyawan')->user()->nama_lengkap }}</h2>
            <span id="user-role">{{ Auth::guard('karyawan')->user()->jabatan }}</span>
            <span id="user-role">- {{ Auth::guard('karyawan')->user()->kode_cabang }}</span>
        </div>
    </div>
</div>

<div class="section" id="menu-section">
    <div class="card">
        <div class="card-body text-center">
            <div class="list-menu">
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="/editprofile" class="green" style="font-size: 40px;">
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
                        <a href="/presensi/histori" class="warning" style="font-size: 40px;">
                            <ion-icon name="document-text"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Histori</span>
                    </div>
                </div>
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="/presensi/histori" class="orange" style="font-size: 40px;">
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
                                @if ($presensihariini != null)
                                    @php
                                        $path = Storage::url('uploads/absensi/'.$presensihariini->foto_in);
                                    @endphp
                                    <img src="{{ url($path) }}" alt="" class="imaged w64">
                                @else
                                 <ion-icon name="camera"></ion-icon>
                                @endif
                            </div>
                            <div class="presencedetail" style="margin-left: 10px">
                                <h4 class="presencetitle">Masuk</h4>
                                <span style="font-size: 0.8rem">{{ $presensihariini != null ? $presensihariini->jam_in : 'Belum Absen'  }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card gradasired">
                    <div class="card-body">
                        <div class="presencecontent">
                            <div class="iconpresence" >
                                @if ($presensihariini != null && $presensihariini->jam_out != null)
                                    @php
                                        $path = Storage::url('uploads/absensi/'.$presensihariini->foto_out);
                                    @endphp
                                    <img src="{{ url($path) }}" alt="" class="imaged w64" >
                                @else
                                 <ion-icon name="camera"></ion-icon>
                                @endif
                            </div>
                            <div class="presencedetail" style="margin-left: 10px">
                                <h4 class="presencetitle">Pulang</h4>
                                <span style="font-size: 0.8rem">{{ $presensihariini != null  && $presensihariini->jam_out != null  ? $presensihariini->jam_out : 'Belum Absen'}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="rekapabsensi">
        <h4>Rekap absensi bulan {{ $bulanberjalan }} {{ $tahunini }}</h4>
        <div class="row">
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center" style="padding: 10px 12px !important">
                        <span class="badge bg-danger" style="position: absolute; top:3px; right: 10px; font-size: 0.6rem; z-index: 999">{{ $rekappresensi->jmlhadir }}</span>
                        <ion-icon name="accessibility-outline" style="font-size: 1.6rem" class="text-primary"></ion-icon>
                        <br>
                        <span style="font-size: 0.7rem">Hadir</span>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center" style="padding: 10px 12px !important ">
                        <span class="badge bg-danger" style="position: absolute; top:3px; right: 10px; font-size: 0.6rem; z-index: 999">{{ $rekapizin->jmlizin }}</span>
                        <ion-icon name="newspaper-outline" style="font-size: 1.6rem" class="text-secondary"></ion-icon>
                        <br>
                        <span style="font-size: 0.7rem">Izin</span>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <span class="badge bg-danger" style="position: absolute; top:3px; right: 10px; font-size: 0.6rem; z-index: 999">{{ $rekapizin->jmlsakit }}</span>
                    <div class="card-body text-center" style="padding: 10px 12px !important">
                        <ion-icon name="medkit-outline" style="font-size: 1.6rem" class="text-warning"></ion-icon>
                        <br>
                        <span style="font-size: 0.7rem">Sakit</span>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <span class="badge bg-danger" style="position: absolute; top:3px; right: 10px; font-size: 0.6rem; z-index: 999">{{ $rekappresensi->jmlterlambat }}</span>
                    <div class="card-body text-center" style="padding: 10px 12px !important">
                        <ion-icon name="alarm-outline" style="font-size: 1.6rem" class="text-danger"></ion-icon>
                        <br>
                        <span style="font-size: 0.7rem">Telat</span>
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
                    @foreach ($historybulanini as $d)
                    @php
                        $path = Storage::url('uploads/absensi/'.$d->foto_in);
                    @endphp
                        <li>
                            <div class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="finger-print-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    <div>{{ date("d-m-Y", strtotime($d->tgl_presensi)) }}</div>
                                    <span class="badge badge-success">{{ $d->jam_in }}</span>
                                    <span class="badge badge-danger">{{ $presensihariini != null && $d->jam_out != null ?  $d->jam_out : 'Belum Absen' }}</span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="tab-pane fade" id="profile" role="tabpanel">
                <ul class="listview image-listview">
                    @foreach ($leaderboard as $d)
                    <li>
                        <div class="item">
                            <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                            <div class="in">
                                <div>
                                    <b> {{ $d->nama_lengkap }}</b> <br>
                                    <small class="text-muted">{{ $d->jabatan }}</small>
                                </div>
                                <span class="badge {{ $d->jam_in < "09:00" ? "bg-success" : "bg-danger" }}">{{ $d->jam_in }}</span>
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
