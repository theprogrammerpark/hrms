@extends('layouts.admin.tabler');
@section('content')

<div class="page-header d-print-none">
    <div class="container-xl">
    <div class="row g-2 align-items-center">
        <div class="col">
        <!-- Page pre-title -->
        <div class="page-pretitle">
            Monitoring
        </div>
        <h2 class="page-title">
            Presensi
        </h2>
        </div>
    </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="input-icon mb-3">
                                        <span class="input-icon-addon">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z"></path>
                                                <path d="M16 3v4"></path>
                                                <path d="M8 3v4"></path>
                                                <path d="M4 11h16"></path>
                                                <path d="M11 15h1"></path>
                                                <path d="M12 15v3"></path>
                                             </svg>
                                        </span>
                                        <input type="date" class="form-control" name="tanggal" id="tanggal" value="{{ date("Y-m-d") }}" placeholder="Tanggal Presensi" autocomplete="off">
                                      </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No. </th>
                                            <th>NIK</th>
                                            <th>Nama Karyawan</th>
                                            <th>Departemen</th>
                                            <th>Jam Masuk</th>
                                            <th>Foto Hadir</th>
                                            <th>Jam Pulang</th>
                                            <th>Foto Pulang</th>
                                            <th>Keterangan</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="loadpresensi"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Edit --}}
<div class="modal modal-blur fade" id="modal-tampilkanpeta" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Lokasi Presensi User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="loadmap">

        </div>
      </div>
    </div>
  </div>
@endsection

@push('myscript')
<script>
    $(function(){
        $("#tanggal").change(function(){
            loadpresensi();
        });


        function loadpresensi(params) {
            var tanggal = $("#tanggal").val();
            $.ajax({
                type:'POST',
                url : '/getpresensi',
                data :{
                    _token :"{{ csrf_token() }}",
                    tanggal : tanggal
                },
                cache : false,
                success : function(respond){
                    $("#loadpresensi").html(respond)
                }
            });
        };



    });
</script>
@endpush
