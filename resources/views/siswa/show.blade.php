@extends('layouts.app')

@section('content')


@include('admin.sidebar')

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        @include('admin.top')

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
                            <div class="btn btn-sm btn-primary float-left inline" href="{{ route('siswa.index') }}"><i class="fa fa-plus"> Back</i></div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row">NISN</th>
                                        <td>{{ $siswa->nisn }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">NIS </th>
                                        <td>{{ $siswa->nis }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Nama Siswa</th>
                                        <td>{{ $siswa->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Email </th>
                                        <td>{{ $siswa->email }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Kelas </th>
                                        <td>{{\App\Models\Kelas::findOrFail($siswa->id_kelas)->nama_kelas;}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Alamat </th>
                                        <td>{{ $siswa->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">No Telepon </th>
                                        <td>{{ $siswa->no_telp }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">SPP Aktif </th>
                                        <td>{{\App\Models\SPP::findOrFail($siswa->id_spp)->tahun;}}</td>
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