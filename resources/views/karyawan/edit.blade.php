<form action="/karyawan/{{ $karyawan->nik }}/update" id="frmkaryawan" name="frmkaryawan" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-barcode" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M4 7v-1a2 2 0 0 1 2 -2h2"></path>
                        <path d="M4 17v1a2 2 0 0 0 2 2h2"></path>
                        <path d="M16 4h2a2 2 0 0 1 2 2v1"></path>
                        <path d="M16 20h2a2 2 0 0 0 2 -2v-1"></path>
                        <path d="M5 11h1v2h-1z"></path>
                        <path d="M10 11l0 2"></path>
                        <path d="M14 11h1v2h-1z"></path>
                        <path d="M19 11l0 2"></path>
                     </svg>
                </span>
                <input type="text" readonly value="{{ $karyawan->nik }}" id="nik" name="nik" class="form-control" placeholder="NIK">
              </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                     </svg>
                </span>
                <input type="text" value="{{ $karyawan->nama_lengkap  }}" id="nama_langkap" name="nama_langkap" class="form-control" placeholder="Nama Lengkap">
              </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-armchair-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M5 10v-4a3 3 0 0 1 3 -3h8a3 3 0 0 1 3 3v4"></path>
                        <path d="M16 15v-2a3 3 0 1 1 3 3v3h-14v-3a3 3 0 1 1 3 -3v2"></path>
                        <path d="M8 12h8"></path>
                        <path d="M7 19v2"></path>
                        <path d="M17 19v2"></path>
                     </svg>
                </span>
                <input type="text" value="{{ $karyawan->jabatan }}" id="jabatan" name="jabatan" class="form-control" placeholder="Jabatan">
              </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-mobile" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M6 5a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2v-14z"></path>
                        <path d="M11 4h2"></path>
                        <path d="M12 17v.01"></path>
                     </svg>
                </span>
                <input type="text" value="{{ $karyawan->no_hp }}" id="nohp" name="nohp" class="form-control" placeholder="No HP">
              </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
                <select name="kode_dept" id="kode_dept"  class="form-select" placeholder="Pilih departemen"">
                    <option value="">Pilih Departemen</option>
                    @foreach ($department as $d)
                        <option {{ $karyawan->kode_dept == $d->kode_dept ? 'selected' : '' }} value="{{ $d->kode_dept }}">{{ $d->nama_dept }}</option>
                    @endforeach

                </select>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
                <select name="kode_cabang" id="kode_cabang"  class="form-select" placeholder="Pilih Cabang"">
                    <option value="">Pilih Cabang</option>
                    @foreach ($cabang as $d)
                        <option {{ $karyawan->kode_cabang == $d->kode_cabang ? 'selected' : '' }} value="{{ $d->kode_cabang }}">{{ $d->nama_cabang }}</option>
                    @endforeach

                </select>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
            <div class="form-group">
                <input type="file" name="foto" class="form-control">
                <input type="hidden" name="old_foto" value="{{ $karyawan->foto }}">
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
            <div class="form-group">
                <button class="btn btn-primary w-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-send" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M10 14l11 -11"></path>
                        <path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5"></path>
                     </svg>
                    Simpan
                </button>
            </div>
        </div>
    </div>
</form>
