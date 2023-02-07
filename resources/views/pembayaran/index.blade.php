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
                            <a class="btn btn-sm btn-primary float-right inline" href="{{ route('siswa.create') }}">Add Data <i class="fa fa-plus"></i></a>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
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
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_pembayaran as $pembayaran)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{\App\Models\Student::findOrFail($pembayaran->nisn)->nama_kelas;}</td>
                                        <td>{{ $siswa->nama }}</td>  
                                        <td>{{\App\Models\Kelas::findOrFail($siswa->id_kelas)->nama_kelas;}}</td>
                                        <td>{{ $siswa->alamat }}</td>
                                        <td>{{ $siswa->no_telp }}</td>
                                        <td>{{\App\Models\SPP::findOrFail($siswa->id_spp)->tahun;}}</td>
                                       
                                        <td class="text-center">
                                            <form action="{{ route('siswa.destroy' ,$siswa->id)}}" method="post">
                                                @csrf
                                                <a class="btn btn-sm btn-primary" href="{{ route('siswa.show',$siswa->id) }}">View <i class="fa fa-eye"></i></a>
                                                <a class="btn btn-sm btn-success" href="{{ route('siswa.edit',$siswa->id) }}">Edit <i class="fa fa-edit"></i></a>
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus Siswa {{$siswa->nama}}?')">Delete <i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer clearfix">
                            <div class="d-flex justify-content-center">
                                Showing {{($data_siswa->currentpage()-1)*$data_siswa->perpage()+1}} to {{ $data_siswa->currentpage()*(($data_siswa->perpage() < $data_siswa->total()) ? $data_siswa->perpage(): $data_siswa->total())}} of {{ $data_siswa->total()}} entries</div>
                            <div class="d-flex justify-content-center">{!! $data_siswa->links() !!}</div>
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