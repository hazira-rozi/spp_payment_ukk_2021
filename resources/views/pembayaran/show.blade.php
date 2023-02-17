@extends('layouts.app')

@section('content')


@if (auth()->user()->role=== "admin")
@include('admin.sidebar')
@else
@include('petugas.sidebar')
@endif

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        @if (auth()->user()->role=== "admin")
        @include('admin.top')
        @else
        @include('petugas.top')
        @endif

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h6 mb-4 text-gray-800">{{$sitemap}} / {{$title}}</h1>
            <!-- Content Row -->


            <div class="row">

                <!-- Area Chart -->
                <div class="col-xl-12 col-lg-12">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header">
                            <!-- <div class="card-header">
                                
                            </div> -->
                            <!-- <h6 class="inline">Data Kelas</h6> -->
                            <div class="btn btn-sm btn-primary inline" href="{{ route('pembayaran.index') }}">Back <i class="fa fa-arrow-left"></i></div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row">NISN</th>
                                        <td>{{ $pembayaran->nisn }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Nama Siswa</th>
                                        <td>{{ $nama_siswa }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Kelas</th>
                                        <td>{{ $nama_kelas }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">ID SPP</th>
                                        <td>{{ $pembayaran->id_spp }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Tahun SPP Aktif</th>
                                        <td>{{ $tahun_spp }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Tanggal Bayar</th>
                                        <td>{{ $pembayaran->tanggal_bayar }}</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">Bulan dibayar</th>
                                        <td>{{ $pembayaran->bulan_dibayar }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Tahun dibayar </th>
                                        <td>{{ $pembayaran->tahun_dibayar}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Jumlah Pembayaran </th>
                                        <td>{{ $pembayaran->jumlah_bayar }}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Content Row -->
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    @include('layouts.footer')

</div>
<!-- End of Content Wrapper -->

@endsection