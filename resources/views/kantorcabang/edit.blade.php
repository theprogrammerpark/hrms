<form action="/kantorcabang/{{ $kantorcabang->kode_cabang }}/update" id="frmkantorcabangedit" name="frmkantorcabangedit" method="POST">
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
                <input type="text" readonly value="{{ $kantorcabang->kode_cabang }}" id="kode_cabang" name="kode_cabang" class="form-control" placeholder="Kode Cabang">
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
                <input type="text" value="{{ $kantorcabang->nama_cabang  }}" id="nama_cabang" name="nama_cabang" class="form-control" placeholder="Nama Cabang">
              </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home-link" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M20.085 11.085l-8.085 -8.085l-9 9h2v7a2 2 0 0 0 2 2h4.5"></path>
                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 1.807 1.143"></path>
                        <path d="M21 21m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                        <path d="M21 16m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                        <path d="M16 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                        <path d="M21 16l-5 3l5 2"></path>
                     </svg>
                </span>
                <input type="text" value="{{ $kantorcabang->alamat_cabang  }}" id="alamat_cabang" name="alamat_cabang" class="form-control" placeholder="Alamat Cabang">
              </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-google-maps" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 9.5m-2.5 0a2.5 2.5 0 1 0 5 0a2.5 2.5 0 1 0 -5 0"></path>
                        <path d="M6.428 12.494l7.314 -9.252"></path>
                        <path d="M10.002 7.935l-2.937 -2.545"></path>
                        <path d="M17.693 6.593l-8.336 9.979"></path>
                        <path d="M17.591 6.376c.472 .907 .715 1.914 .709 2.935a7.263 7.263 0 0 1 -.72 3.18a19.085 19.085 0 0 1 -2.089 3c-.784 .933 -1.49 1.93 -2.11 2.98c-.314 .62 -.568 1.27 -.757 1.938c-.121 .36 -.277 .591 -.622 .591c-.315 0 -.463 -.136 -.626 -.593a10.595 10.595 0 0 0 -.779 -1.978a18.18 18.18 0 0 0 -1.423 -2.091c-.877 -1.184 -2.179 -2.535 -2.853 -4.071a7.077 7.077 0 0 1 -.621 -2.967a6.226 6.226 0 0 1 1.476 -4.055a6.25 6.25 0 0 1 4.811 -2.245a6.462 6.462 0 0 1 1.918 .284a6.255 6.255 0 0 1 3.686 3.092z"></path>
                     </svg>
                </span>
                <input type="text" value="{{ $kantorcabang->lokasi_kantor  }}" id="lokasi_kantor" name="lokasi_kantor" class="form-control" placeholder="Lakasi Koordinat Cabang">
              </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-radar" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M21 12h-8a1 1 0 1 0 -1 1v8a9 9 0 0 0 9 -9"></path>
                        <path d="M16 9a5 5 0 1 0 -7 7"></path>
                        <path d="M20.486 9a9 9 0 1 0 -11.482 11.495"></path>
                     </svg>
                </span>
                <input type="text" value="{{ $kantorcabang->radius  }}" id="radius" name="radius" class="form-control" placeholder="Radius">
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
<script>
 $(function () {
    $("#frmkantorcabangedit").submit(function () {
            var kode_cabang = $("#frmkantorcabangedit").find("#kode_cabang").val();
            var nama_cabang = $("#frmkantorcabangedit").find("#nama_cabang").val();
            var lokasi_kantor = $("#frmkantorcabangedit").find("#lokasi_kantor").val();
            var radius = $("#frmkantorcabangedit").find("#radius").val();

            if (kode_cabang=="") {
                Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: 'Kode cabang harus di isi!'
                }).then(()=>{
                    $("#kode_cabang").focus();
                });

                return false;
            } else if (nama_cabang=="") {
                Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: 'Nama harus di isi!'
                }).then(()=>{
                    $("#nama_cabang").focus();
                });

                return false;
            } else if (lokasi_kantor=="") {
                Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: 'Lokasi harus di isi!'
                }).then(()=>{
                    $("#lokasi_kantor").focus();
                });

                return false;
            } else if (radius=="") {
                Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: 'Radius harus di isi!'
                }).then(()=>{
                    $("#radius").focus();
                });

                return false;
            }
        });
 });

</script>
