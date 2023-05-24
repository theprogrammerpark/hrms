<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>A4</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>
    @page { size: A4 }
    #title {
        font-family: Arial, Helvetica, sans-serif;
        font-size:18px;
        font-weight: bold;
    }

    .tabledatakaryawan {
        margin-top: 40px;
    }

    .tabledatakaryawan td {
        padding: 5px;
    }

    .tablepresensi{
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }

    .tablepresensi tr th {
        border: 1px solid;
        padding: 8px;
        background-color: #9f9d9d;
    }

    .tablepresensi tr td {
        border: 1px solid;
        padding: 5px;
    }

    .foto {
        width: 80px;
        height: 80px;
    }
  </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4">
    <?php
    function selisih($jam_masuk, $jam_keluar)
    {
        list($h, $m, $s) = explode(":", $jam_masuk);
        $dtAwal = mktime($h, $m, $s, "1", "1", "1");
        list($h, $m, $s) = explode(":", $jam_keluar);
        $dtAkhir = mktime($h, $m, $s, "1", "1", "1");
        $dtSelisih = $dtAkhir - $dtAwal;
        $totalmenit = $dtSelisih / 60;
        $jam = explode(".", $totalmenit / 60);
        $sisamenit = ($totalmenit / 60) - $jam[0];
        $sisamenit2 = $sisamenit * 60;
        $jml_jam = $jam[0];
        return $jml_jam . ":" . round($sisamenit2);
    }
    ?>
  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">

   <table style="width: 100%">
    <tr>
        <td style="width: 30px">
            <img src="{{ asset('assets/img/logo_presensi.png') }}" width="70" height="70" alt="">
        </td>
        <td>
            <span id="title">
                LAPORAN PRESENSI KARYAWAN <br>
                PERIODE {{ strtoupper($namabulan[$bulan]) }} {{ $tahun }}<br>
                PT. THE PARK<br>
            </span>
            <span> Jl. Ir. Soekarno, Dusun II, Madegondo, Kec. Grogol, Kabupaten Sukoharjo, Jawa Tengah 57552 </span>
        </td>
    </tr>
   </table>
   <table class="tabledatakaryawan">
    <tr>
        <td rowspan="6">
            @php
                $path = Storage::url('uploads/karyawan/'.$karyawan->foto);
            @endphp
            <img src="{{ $path }}" alt="" width="75" height="120">
        </td>
    </tr>
    <tr>
        <td>NIK</td>
        <td>:</td>
        <td>{{ $karyawan->nik }}</td>
    </tr>
    <tr>
        <td>Nama Karyawan</td>
        <td>:</td>
        <td>{{ $karyawan->nama_lengkap }}</td>
    </tr>
    <tr>
        <td>Jabatan</td>
        <td>:</td>
        <td>{{ $karyawan->jabatan }}</td>
    </tr>
    <tr>
        <td>Departemen</td>
        <td>:</td>
        <td>{{ $karyawan->nama_dept }}</td>
    </tr>
    <tr>
        <td>No HP</td>
        <td>:</td>
        <td>{{ $karyawan->no_hp }}</td>
    </tr>
   </table>

   <table class="tablepresensi">
    <tr>
        <th>No.</th>
        <th>Tanggal</th>
        <th>Jam Masuk</th>
        <th>Jam Pulang</th>
        <th>Keterangan</th>
        <th>Jml Jam Kerja</th>
    </tr>
    @foreach ($presensi as $d)
        @php
            $jam_terlambat = selisih('09:00:00',$d->jam_in );
        @endphp
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ date("d-m-Y"), strtotime($d->tgl_presensi) }}</td>
            <td>{{ $d->jam_in }}</td>
            <td>
                @if ($d->jam_out != null)
                    {{ $d->jam_out }}
                @else
                    Belum Absen
                @endif

            </td>
            <td>
                @if ($d->jam_in > '09:00')
                    Terlambat {{ $jam_terlambat }}
                @else
                    Tepat waktu
                @endif
            </td>
            <td>
                @if ($d->jam_out != null)
                    @php
                        $jmljamkerja = selisih($d->jam_in, $d->jam_out);
                    @endphp
                @else
                    @php
                        $jmljamkerja = 0;
                    @endphp
                @endif
                {{ $jmljamkerja }}
            </td>
        </tr>
    @endforeach
   </table>

   <table width="25%"  style="margin-top:100px;">
        <tr>
            <td colspan="2" style="text-align:center;"">Sukoharjo, {{ date('d-m-Y') }}</td>
        </tr>
        <tr>
            <td style="text-align:center; height:200px">
                <u> Ika </u> <br>
                <i><b> HRD Manager</b></i>
            </td>
            <td style="text-align:center;">
                {{-- <u> Ika </u> <br>
                <i><b> HRD Manager</b></i> --}}
            </td>
        </tr>
   </table>
</section>

</body>

</html>
