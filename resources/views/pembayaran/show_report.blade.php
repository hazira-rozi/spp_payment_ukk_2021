@extends('layouts.cetak')

@section('content')




<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">


        <!-- Begin Page Content -->
        <div class="container-fluid">


            @if ($data_pembayaran !=null)
            <div class="row">

                <!-- Area Chart -->
                <div class="col-xl-12 col-lg-12 p5">
                <h1 class="h1 mb-4 text-gray-800 justify-content-start">Laporan Pembayaran Tahun </h1>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th class="text-center">Nama Siswa</th>
                                <th class="text-center">Tahun SPP</th>
                                <th class="text-center">Tanggal Bayar</th>
                                <th class="text-center">Bulan dibayar</th>
                                <th class="text-center">Tahun dibayar</th>
                                <th class="text-center">Jumlah Pembayaran</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($data_pembayaran as $pembayaran)
                            <tr>
                                <td>{{ ++$i }}</td>

                                @foreach($data_siswa as $siswa)
                                @if($pembayaran->nisn == $siswa->nisn)
                                <td>{{$siswa->nama}}</td>
                                @endif
                                @endforeach

                                @foreach($data_spp as $spp)
                                @if($pembayaran->id_spp == $spp->id)
                                <td>{{$spp->tahun}}</td>
                                @endif
                                @endforeach

                                <td>{{ $pembayaran->tanggal_bayar }}</td>
                                <td>{{ $pembayaran->bulan_dibayar }}</td>
                                <td>{{ $pembayaran->tahun_dibayar }}</td>
                                <td>{{ $pembayaran->jumlah_bayar }}</td>


                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
            @else
            <h1 class="h6 mb-4 text-gray-800">Data Tidak Tersedia</h1>
            @endif
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->

    @include('layouts.footer')

</div>
<!-- End of Content Wrapper -->




@endsection