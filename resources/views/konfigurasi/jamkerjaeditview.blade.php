<form action="/konfigurasi/jamkerja/{{ $jamkerja->kode_jamkerja }}/update"
    id="frmjamkerjaedit" name="frmjamkerjaedit" method="POST">
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
                <input type="text" readonly value="{{ $jamkerja->kode_jamkerja  }}" id="kode_jamkerja" name="kode_jamkerja" class="form-control" placeholder="kode jam kerja">
              </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-hour-10" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                        <path d="M12 12l-3 -2"></path>
                        <path d="M12 7v5"></path>
                     </svg>
                </span>
                <input type="text" value="{{ $jamkerja->nama_jamkerja  }}" id="nama_jamkerja" name="nama_jamkerja" class="form-control" placeholder="Nama Jam Kerja">
              </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alarm-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M16 6.072a8 8 0 1 1 -11.995 7.213l-.005 -.285l.005 -.285a8 8 0 0 1 11.995 -6.643zm-4 2.928a1 1 0 0 0 -1 1v3l.007 .117a1 1 0 0 0 .993 .883h2l.117 -.007a1 1 0 0 0 .883 -.993l-.007 -.117a1 1 0 0 0 -.993 -.883h-1v-2l-.007 -.117a1 1 0 0 0 -.993 -.883z" stroke-width="0" fill="currentColor"></path>
                        <path d="M6.412 3.191a1 1 0 0 1 1.273 1.539l-.097 .08l-2.75 2a1 1 0 0 1 -1.273 -1.54l.097 -.08l2.75 -2z" stroke-width="0" fill="currentColor"></path>
                        <path d="M16.191 3.412a1 1 0 0 1 1.291 -.288l.106 .067l2.75 2a1 1 0 0 1 -1.07 1.685l-.106 -.067l-2.75 -2a1 1 0 0 1 -.22 -1.397z" stroke-width="0" fill="currentColor"></path>
                     </svg>
                </span>
                <input type="text" value="{{ $jamkerja->awal_jammasuk  }}" id="awal_jammasuk" name="awal_jammasuk" class="form-control" placeholder="Awal Jam Masuk">
              </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M17 3.34a10 10 0 1 1 -14.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 14.995 -8.336zm-5 2.66a1 1 0 0 0 -.993 .883l-.007 .117v5l.009 .131a1 1 0 0 0 .197 .477l.087 .1l3 3l.094 .082a1 1 0 0 0 1.226 0l.094 -.083l.083 -.094a1 1 0 0 0 0 -1.226l-.083 -.094l-2.707 -2.708v-4.585l-.007 -.117a1 1 0 0 0 -.993 -.883z" stroke-width="0" fill="currentColor"></path>
                     </svg>
                </span>
                <input type="text" value="{{  $jamkerja->jam_masuk   }}" id="jam_masuk" name="jam_masuk" class="form-control" placeholder="Jam Masuk">
              </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-hourglass-high" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M6.5 7h11"></path>
                        <path d="M6 20v-2a6 6 0 1 1 12 0v2a1 1 0 0 1 -1 1h-10a1 1 0 0 1 -1 -1z"></path>
                        <path d="M6 4v2a6 6 0 1 0 12 0v-2a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1z"></path>
                     </svg>
                </span>
                <input type="text" value="{{  $jamkerja->akhir_jammasuk   }}" id="akhir_jammasuk" name="akhir_jammasuk" class="form-control" placeholder="Akhir Jam Masuk">
              </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home-stats" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M19 13v-1h2l-9 -9l-9 9h2v7a2 2 0 0 0 2 2h2.5"></path>
                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2"></path>
                        <path d="M13 22l3 -3l2 2l4 -4"></path>
                        <path d="M19 17h3v3"></path>
                     </svg>
                </span>
                <input type="text" value="{{  $jamkerja->jam_pulang  }}" id="jam_pulang" name="jam_pulang" class="form-control" placeholder="Jam Pulang">
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
    $("#frmjamkerjaedit").submit(function () {
            var kode_cabang = $("#frmjamkerjaedit").find("#kode_jamkerja").val();
            var nama_cabang = $("#frmjamkerjaedit").find("#nama_jamkerja").val();
            var lokasi_kantor = $("#frmjamkerjaedit").find("#awal_jammasuk").val();
            var radius = $("#frmjamkerjaedit").find("#jam_masuk").val();
            var radius = $("#frmjamkerjaedit").find("#akhir_jammasuk").val();
            var radius = $("#frmjamkerjaedit").find("#jam_pulang").val();

            if (kode_jamkerja=="") {
                Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: 'Kode jam kerja harus di isi!'
                }).then(()=>{
                    $("#kode_jamkerja").focus();
                });

                return false;
            } else if (nama_jamkerja=="") {
                Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: 'Nama jam kerja harus di isi!'
                }).then(()=>{
                    $("#nama_jamkerja").focus();
                });

                return false;
            } else if (awal_jammasuk=="") {
                Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: 'Awal jam masuk harus di isi!'
                }).then(()=>{
                    $("#awal_jammasuk").focus();
                });

                return false;
            } else if (jam_masuk=="") {
                Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: 'Jam Masuk harus di isi!'
                }).then(()=>{
                    $("#jam_masuk").focus();
                });

                return false;
            } else if (akhir_jammasuk=="") {
                Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: 'Akhir jam masuk harus di isi!'
                }).then(()=>{
                    $("#akhir_jammasuk").focus();
                });

                return false;
            } else if (jam_pulang=="") {
                Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: 'Jam pulang harus di isi!'
                }).then(()=>{
                    $("#jam_pulang").focus();
                });

                return false;
            }
        });
 });

</script>
