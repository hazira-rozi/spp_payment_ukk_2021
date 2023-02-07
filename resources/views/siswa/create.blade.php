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

                            <div class="col-lg-12">
                                <div class="p-1">
                                    <form action="{{ route('siswa.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row my-2">
                                            <div class="col-sm-2">
                                                <label for="nisn">NISN</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" name="nisn" id="nisn" class="form-control form-control-sm" placeholder="NISN Siswa">
                                                {!!$errors->first("nisn", "<span class='text-danger'>:message</span>")!!}
                                            </div>
                                        </div>
                                        <div class="row my-2">
                                            <div class="col-sm-2">
                                                <label for="nis">NIS</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" name="nis" id="nis" class="form-control form-control-sm" placeholder="NIS Siswa">
                                                {!!$errors->first("nis", "<span class='text-danger'>:message</span>")!!}
                                            </div>
                                        </div>
                                        <div class="row my-2">
                                            <div class="col-sm-2">
                                                <label for="nama">Nama Siswa</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" name="nama" id="nama" class="form-control form-control-sm" placeholder="Nama Siswa">
                                                {!!$errors->first("nama", "<span class='text-danger'>:message</span>")!!}
                                            </div>
                                        </div>
                                        <div class="row my-2">
                                            <div class="col-sm-2">
                                                <label for="email">Email</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="email" name="email" id="email" class="form-control form-control-sm" placeholder="Email Siswa">
                                                {!!$errors->first("email", "<span class='text-danger'>:message</span>")!!}
                                            </div>
                                        </div>
                                        <div class="row my-2">
                                            <div class="col-sm-2">
                                                <label for="id_kelas">Kelas</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="id_kelas">
                                                    <option>Pilih Kelas</option>
                                                    @foreach($kelas_siswa as $kelas)
                                                    <option value="{{$kelas->id}}">{{$kelas->nama_kelas}}</option>
                                                    @endforeach
                                                </select>
                                                {!!$errors->first("id_kelas", "<span class='text-danger'>:message</span>")!!}
                                            </div>
                                        </div>
                                        <div class="row my-2">
                                            <div class="col-sm-2">
                                                <label for="alamat">Alamat</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <textarea name="alamat" id="alamat" class="form-control form-control-sm" placeholder="Alamat Siswa"></textarea>
                                                {!!$errors->first("alamat", "<span class='text-danger'>:message</span>")!!}
                                            </div>
                                        </div>
                                        <div class="row my-2">
                                            <div class="col-sm-2">
                                                <label for="no_telp">Nomor Telepon</label>
                                            </div>
                                            <div class="col-sm-1">
                                                <input type="text" class="form-control form-control-sm" value="+62" disabled>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" name="no_telp" id="no_telp" class="form-control form-control-sm" placeholder="Nomor Telepon">
                                                {!!$errors->first("no_telp", "<span class='text-danger'>:message</span>")!!}
                                            </div>
                                        </div>
                                        <div class="row my-2">
                                            <div class="col-sm-2">
                                                <label for="id_spp">Tahun SPP</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="id_spp">
                                                    <option>Pilih Tahun SPP</option>
                                                    @foreach($spp_siswa as $spp)
                                                    <option value="{{$spp->id}}">{{$spp->tahun}}</option>
                                                    @endforeach
                                                </select>
                                                {!!$errors->first("id_spp", "<span class='text-danger'>:message</span>")!!}
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