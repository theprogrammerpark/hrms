@extends('layouts.presensi');
@section('header')
 <!-- App Header -->
 <div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="/dashboard" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Buat Izin</div>
    <div class="right"></div>
</div>
<!-- * App Header -->

@section('content')
    <div class="row" style="margin-top: 50px">
        <div class="col">
            <form action="/presensi/storeizin" method="post"  id="frmizin">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <input type="date" class="form-control" name="tgl_izin" id="tgl_izin" placeholder="Tanggal" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <select name="status" id="status" class="form-control">
                                <option value="">Pilih izin / sakit</option>
                                <option value="i">Izin</option>
                                <option value="s">Sakit</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <textarea name="keterangan" id="keterangan" cols="20" rows="10" placeholder="Keterangan" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <button class="btn btn-primary w-100">Kirim</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('myscript')
<script>
    $(document).ready(function() {

        $("#tgl_izin").change(function() {
            var tgl_izin = $(this).val();
            $.ajax({
                type:'POST',
                url:'/presensi/checkpengajuanizin' ,
                data:{
                    _token:"{{  csrf_token() }}",
                    tgl_input:tgl_izin
                },
                cache:false,
                success : function(respond) {
                   if (respond==1) {
                    Swal.fire({
                        title: 'Warning',
                        text: 'Oops tgl sudah pernah di buat',
                        icon: 'error'
                        }).then((result)=>{
                            $("#tgl_izin").val("");
                        }) ;
                   }
                }
            });
        });

        $("#frmizin").submit(function() {
            var tgl_izin = $("#tgl_izin").val();
            var status = $("#status").val();
            var keterangan = $("#keterangan").val();

            if (tgl_izin=="") {
                Swal.fire({
                title: 'Warning',
                text: 'Silahkan isi tanggal',
                icon: 'error'
                });
                return false;
            } else if ( status=="") {
                Swal.fire({
                title: 'Warning',
                text: 'Silahkan isi izin/sakit',
                icon: 'error'
                });
                return false;
            } else if ( keterangan=="") {
                Swal.fire({
                title: 'Warning',
                text: 'Silahkan isi keterangan izin/sakit',
                icon: 'error'
                });
                return false;
            }
        });

    });
</script>
@endpush


