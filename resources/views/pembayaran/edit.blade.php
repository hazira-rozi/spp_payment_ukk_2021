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

                <div class="col-xl-12 col-lg-12 col-md-12">

                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <!-- Nested Row within Card Body -->
i
                            <div class="col-lg-12">
                                <div class="p-1">
                                    <form action="{{route('pembayaran.update',$pembayaran->id)}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row my-2">
                                            <div class="col-sm-2">
                                                <label for="id_kelas">Kelas</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" name="id_kelas" id="fieldkelas" class="form-control form-control-sm" value="{{$nama_kelas}}" readonly>
                                                <input type="text" name="id_petugas" id="id_petugas" class="form-control form-control-sm" value="{{$pembayaran->id_petugas}}" hidden>

                                            </div>

                                        </div>
                                        <div class="row my-2">
                                            <div class="col-sm-2">
                                                <label for="nama_siswa">Nama Siswa</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" name="nama_siswa" id="nama_siswa" class="form-control form-control-sm" value="{{$nama_siswa}}" readonly>
                                                {!!$errors->first("nama_siswa", "<span class='text-danger'>:message</span>")!!}
                                            </div>
                                        </div>

                                        <div class="row my-2">
                                            <div class="col-sm-2">
                                                <label for="nisn">NISN</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" name="nisn" id="fieldnisn" class="form-control form-control-sm" value="{{$pembayaran->nisn}}" readonly>
                                                {!!$errors->first("nisn", "<span class='text-danger'>:message</span>")!!}
                                            </div>
                                        </div>

                                        <div class="row my-2">
                                            <div class="col-sm-2">
                                                <label for="id_spp">Tahun SPP Aktif</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" name="id_spp" id="field_id_spp" class="form-control form-control-sm" value="{{$pembayaran->id_spp}}" readonly hidden>
                                                <input type="text" name="tahun_spp" id="field_tahun_spp" class="form-control form-control-sm" value="{{$tahun_spp}}" readonly>
                                                {!!$errors->first("id_spp", "<span class='text-danger'>:message</span>")!!}
                                            </div>
                                        </div>

                                        <div class="row my-2">
                                            <div class="col-sm-2">
                                                <label for="bulan_dibayar">Bulan Dibayar</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="bulan_dibayar" id="bulan_dibayar">

                                                    <option selected value="{{$pembayaran->bulan_dibayar}}">{{$pembayaran->bulan_dibayar}}</option>
                                                    <option value="Januari">Januari</option>
                                                    <option value="Februari">Februari</option>
                                                    <option value="Maret">Maret</option>
                                                    <option value="April">April</option>
                                                    <option value="Mei">Mei</option>
                                                    <option value="Juni">Juni</option>
                                                    <option value="Juli">Juli</option>
                                                    <option value="Agustus">Agustus</option>
                                                    <option value="September">September</option>
                                                    <option value="Oktober">Oktober</option>
                                                    <option value="November">November</option>
                                                    <option value="Desember">Desember</option>

                                                </select>
                                                {!!$errors->first("bulan_dibayar", "<span class='text-danger'>:message</span>")!!}
                                            </div>
                                        </div>

                                        <div class="row my-2">
                                            <div class="col-sm-2">
                                                <label for="tgl_bayar">Tanggal Dibayar</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="date" id="tanggal_bayar" name="tanggal_bayar" class="form-control form-control-sm" value="{{$pembayaran->tanggal_bayar}}">
                                                {!!$errors->first("tanggal_bayar", "<span class='text-danger'>:message</span>")!!}
                                            </div>
                                        </div>

                                        <div class="row my-2">
                                            <div class="col-sm-2">
                                                <label for="jumlah_bayar">Nominal</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control form-control-sm" id="jumlah_bayar" name="jumlah_bayar" value="{{$pembayaran->jumlah_bayar}}">
                                                {!!$errors->first("jumlah_bayar", "<span class='text-danger'>:message</span>")!!}
                                            </div>
                                        </div>

                                        <hr>
                                        <div class="row my-2">
                                            <div class="col-sm-2">

                                            </div>
                                            <div class="col-sm-5 justify-content-center">
                                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                                    <i class="fa fa-save"></i>
                                                    Simpan
                                                </button>
                                            </div>
                                            <div class="col-sm-5 justify-content-center">
                                                <button type="reset" class="btn btn-primary btn-user btn-block">
                                                    <i class="fa fa-remove"></i>
                                                    Clear
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

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->

    @include('layouts.footer')

</div>
<!-- End of Content Wrapper -->

@endsection