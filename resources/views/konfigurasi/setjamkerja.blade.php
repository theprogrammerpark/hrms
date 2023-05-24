@extends('layouts.admin.tabler');
@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
    <div class="row g-2 align-items-center">
        <div class="col">
        <!-- Page pre-title -->
        <div class="page-pretitle">
            Konfigurasi
        </div>
        <h2 class="page-title">
            Set Jam Kerja
        </h2>
        </div>
    </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                @if (Session::get('success'))
                    <div class="alert alert-success">
                       {{ Session::get('success') }}
                    </div>
                @endif
                @if (Session::get('warning'))
                    <div class="alert alert-warning">
                        {{ Session::get('warning') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <tr>
                        <th>NIK</th>
                        <td>{{ $nik }}</td>
                    </tr>
                    <tr>
                        <th>Nama Karyawan</th>
                        <td>{{ $karyawan->nama_lengkap }}</td>
                    </tr>
                    {{-- <tr>
                        <th>hari</th>
                        <td>{{  $karyawan->senin }}</td>
                    </tr> --}}
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-6">

                <form action="/konfigurasi/jamkerja/{{ $nik }}/jadwalkerja" method="POST">
                    @csrf
                    <table class="table">
                        <thead>
                            <td>Hari</td>
                            <td>Jam Kerja</td>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Senin</th>
                                <td>
                                    <select name="kode_jamkerja1" id="kode_jamkerja1" class="form-select">
                                    <option value="">Pilih Jam Kerja</option>
                                    @foreach ($jamkerja as $d)
                                        <option {{ $karyawan->senin == $d->kode_jamkerja ? 'selected' : '' }} value="{{ $d->kode_jamkerja }}">{{  $d->nama_jamkerja }}</option>
                                    @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Selasa</th>
                                <td>
                                    <select name="kode_jamkerja2" id="kode_jamkerja2" class="form-select">
                                        <option value="">Pilih Jam Kerja</option>
                                        @foreach ($jamkerja as $d)
                                            <option {{ $karyawan->selasa == $d->kode_jamkerja ? 'selected' : '' }} value="{{ $d->kode_jamkerja }}">{{  $d->nama_jamkerja }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Rabu</th>
                                <td>
                                    <select name="kode_jamkerja3" id="kode_jamkerja3" class="form-select">
                                        <option value="">Pilih Jam Kerja</option>
                                        @foreach ($jamkerja as $d)
                                            <option {{ $karyawan->rabu == $d->kode_jamkerja ? 'selected' : '' }} value="{{ $d->kode_jamkerja }}">{{  $d->nama_jamkerja }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Kamis</th>
                                <td>
                                    <select name="kode_jamkerja4" id="kode_jamkerja4" class="form-select">
                                        <option value="">Pilih Jam Kerja</option>
                                        @foreach ($jamkerja as $d)
                                            <option {{ $karyawan->kamis == $d->kode_jamkerja ? 'selected' : '' }} value="{{ $d->kode_jamkerja }}">{{  $d->nama_jamkerja }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Jumat</th>
                                <td>
                                    <select name="kode_jamkerja5" id="kode_jamkerja5" class="form-select">
                                        <option value="">Pilih Jam Kerja</option>
                                        @foreach ($jamkerja as $d)
                                            <option {{ $karyawan->jumat == $d->kode_jamkerja ? 'selected' : '' }} value="{{ $d->kode_jamkerja }}">{{  $d->nama_jamkerja }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Sabtu</th>
                                <td>
                                    <select name="kode_jamkerja6" id="kode_jamkerja6" class="form-select">
                                    <option value="">Pilih Jam Kerja</option>
                                    @foreach ($jamkerja as $d)
                                        <option {{ $karyawan->sabtu == $d->kode_jamkerja ? 'selected' : '' }} value="{{ $d->kode_jamkerja }}">{{  $d->nama_jamkerja }}</option>
                                    @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>minggu</th>
                                <td>
                                    <select name="kode_jamkerja7" id="kode_jamkerja7" class="form-select">
                                    <option value="">Pilih Jam Kerja</option>
                                    @foreach ($jamkerja as $d)
                                        <option {{ $karyawan->minggu == $d->kode_jamkerja ? 'selected' : '' }} value="{{ $d->kode_jamkerja }}">{{  $d->nama_jamkerja }}</option>
                                    @endforeach
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-primary w-100" type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
