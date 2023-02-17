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

                <div class="col-xl-12 col-lg-12 col-md-12">

                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <!-- Nested Row within Card Body -->

                            <div class="col-lg-12">
                                <div class="p-1">
                                    <form action="{{url('pembayaran/getPembayaran')}}" method="post" enctype="multipart/form-data">

                                        @csrf
                                        @method('put')
                                        <div class="row my-2">
                                            <div class="col-sm-2">
                                                <label for="id_kelas">Kelas</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="id_kelas" id="kelas">
                                                    <option>Pilih Kelas</option>
                                                    @foreach($data_kelas as $kelas)
                                                    <option value="{{$kelas->id}}">{{$kelas->nama_kelas}}</option>
                                                    @endforeach
                                                </select>
                                                {!!$errors->first("id_kelas", "<span class='text-danger'>:message</span>")!!}
                                            </div>

                                        </div>
                                        <div class="row my-2">
                                            <div class="col-sm-2">
                                                <label for="id_siswa">Nama Siswa</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="id_siswa" id="siswa">
                                                    <option>Pilih Kelas terlebih dahulu</option>
                                                </select>

                                                <input type="text" name="nisn" id="fieldnisn" class="form-control form-control-sm" placeholder="Pilih Siswa terlebih dahulu" readonly hidden>

                                                {!!$errors->first("id_siswa", "<span class='text-danger'>:message</span>")!!}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row my-2">
                                            <div class="col-sm-2">

                                            </div>
                                            <div class="col-sm-5 justify-content-center">
                                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                                    <i class="fa fa-save"></i>
                                                    Lihat
                                                </button>
                                            </div>

                                        </div>

                                    </form>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
            @if ($data_pembayaran !=null)
            <div class="row">

                <!-- Area Chart -->
                <div class="col-xl-12 col-lg-12">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header">
                            {{$card_title->nama}}
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

                        <div class="card-footer clearfix">
                            <div class="d-flex justify-content-center">
                                Showing {{($data_pembayaran->currentpage()-1)*$data_pembayaran->perpage()+1}} to {{ $data_pembayaran->currentpage()*(($data_pembayaran->perpage() < $data_pembayaran->total()) ? $data_pembayaran->perpage(): $data_pembayaran->total())}} of {{ $data_pembayaran->total()}} entries</div>
                            <div class="d-flex justify-content-center">{!! $data_pembayaran->links() !!}</div>
                        </div>

                    </div>
                </div>
            </div>
            @endif
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->

    @include('layouts.footer')

</div>
<!-- End of Content Wrapper -->




@endsection