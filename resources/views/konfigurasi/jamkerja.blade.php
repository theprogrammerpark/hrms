@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Konfigurasi Jam Kerja
                </h2>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
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
                                <a href="#" class="btn btn-primary" id="btnTambah">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M12 5l0 14"></path>
                                        <path d="M5 12l14 0"></path>
                                     </svg>
                                    Tambah Data
                                </a>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12">
                                <form action="/konfigurasi/jamkerja" method="GET">
                                    <div class="row"">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" name="nama_jamkerja" class="form-control"
                                                value="{{ Request('nama_jamkerja') }}" placeholder="Nama Jam Kerja">
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                                        <path d="M21 21l-6 -6"></path>
                                                    </svg>
                                                    Cari
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode </th>
                                            <th>Nama Jam Kerja</th>
                                            <th>Awal Jam Masuk</th>
                                            <th>Jam Masuk</th>
                                            <th>Akhir Jam Masuk</th>
                                            <th>Jam Pulang</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jamkerja as $d )
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $d->kode_jamkerja }}</td>
                                                <td>{{ $d->nama_jamkerja  }}</td>
                                                <td>{{ $d->awal_jammasuk  }}</td>
                                                <td>{{ $d->jam_masuk  }}</td>
                                                <td>{{ $d->akhir_jammasuk  }}</td>
                                                <td>{{ $d->jam_pulang  }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <form action="">
                                                            <a href="#" class="btn btn-success btn-sm edit" kode_jamkerja={{ $d->kode_jamkerja}}>
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="32" height="32" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                                    <path d="M16 5l3 3"></path>
                                                                 </svg>
                                                            </a>
                                                        </form>

                                                        <form method="POST" action="/konfigurasi/jamkerja/{{ $d->kode_jamkerja }}/delete" style="margin-left:5px">
                                                            @csrf
                                                            <a class="btn btn-danger btn-sm delete-confirm">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <path d="M4 7l16 0"></path>
                                                                    <path d="M10 11l0 6"></path>
                                                                    <path d="M14 11l0 6"></path>
                                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                                 </svg>
                                                            </a>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- modal new  --}}
<div class="modal modal-blur fade" id="modal-input-jamkerja" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Data Jam Kerja</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/konfigurasi/jamkerja/store" id="frmjamkerja" name="frmjamkerja" method="POST">
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
                            <input type="text" value="" id="kode_jamkerja" name="kode_jamkerja" class="form-control" placeholder="kode jam kerja">
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
                            <input type="text" value="" id="nama_jamkerja" name="nama_jamkerja" class="form-control" placeholder="Nama Jam Kerja">
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
                            <input type="text" value="" id="awal_jammasuk" name="awal_jammasuk" class="form-control" placeholder="Awal Jam Masuk">
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
                            <input type="text" value="" id="jam_masuk" name="jam_masuk" class="form-control" placeholder="Jam Masuk">
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
                            <input type="text" value="" id="akhir_jammasuk" name="akhir_jammasuk" class="form-control" placeholder="Akhir Jam Masuk">
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
                            <input type="text" value="" id="jam_pulang" name="jam_pulang" class="form-control" placeholder="Jam Pulang">
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
        </div>
      </div>
    </div>
  </div>
</div>

 {{-- Modal Edit --}}
 <div class="modal modal-blur fade" id="modal-edit-jamkerja" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Data Jam Kerja</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="loadeditform">

        </div>
    </div>
</div>

@endsection

@push('myscript')
<script>
     $(function () {
        $("#btnTambah").click(function () {
            $("#modal-input-jamkerja").modal("show");
        });

        $("#frmjamkerja").submit(function () {
            var kode_jamkerja = $("#kode_jamkerja").val();
            var nama_jamkerja = $("#nama_jamkerja").val();
            var awal_jammasuk = $("#awal_jammasuk").val();
            var jam_masuk = $("#jam_masuk").val();
            var akhir_jammasuk = $("#akhir_jammasuk").val();
            var jam_pulang = $("#jam_pulang").val();

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

        $(".edit").click(function () {
            var kode_jamkerja = $(this).attr('kode_jamkerja');
            $.ajax({
                type :'POST',
                url : 'jamkerja/edit',
                cache :false,
                data : {
                    _token :"{{ csrf_token() }}",
                    kode_jamkerja :kode_jamkerja
                },
                success : function (response) {
                    $("#loadeditform").html(response);
                }
            });

            $("#modal-edit-jamkerja").modal("show");
        });

        $(".delete-confirm").click(function(e) {
            var form = $(this).closest('form');

            e.preventDefault();
            Swal.fire({
            title: 'Hapus data ?',

            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                );
                 form.submit();
            }
            })
        });
    });
</script>
@endpush
