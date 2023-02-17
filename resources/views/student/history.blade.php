@extends('layouts.app')

@section('content')


@include('student.sidebar')

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
                    <div class="card border-left-primary shadow h-100 py-2">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header">
                            {{$card_title}}
                            <!-- <div class="card-header">
                                 
                            </div> -->
                            <!-- <h6 class="inline">Data Kelas</h6> -->

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

                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($data_pembayaran as $pembayaran)
                                    <tr>
                                        <td>{{ ++$i }}</td>

                                        
                                        @if($pembayaran->nisn == $data_siswa->nisn)
                                        <td>{{$data_siswa->nama}}</td>
                                        @endif
                                        

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

                        <div class="card-footer clearfix">
                            <div class="d-flex justify-content-center">
                                Showing {{($data_pembayaran->currentpage()-1)*$data_pembayaran->perpage()+1}} to {{ $data_pembayaran->currentpage()*(($data_pembayaran->perpage() < $data_pembayaran->total()) ? $data_pembayaran->perpage(): $data_pembayaran->total())}} of {{ $data_pembayaran->total()}} entries</div>
                            <div class="d-flex justify-content-center">{!! $data_pembayaran->links() !!}</div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->

    @include('layouts.footer')

</div>
<!-- End of Content Wrapper -->




@endsection