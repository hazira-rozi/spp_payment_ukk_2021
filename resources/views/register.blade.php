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
                            <div class="row my-2">
                                <div class="col-lg-12">
                                    <div class="p-1">
                                        <form class="user" action="{{ route('register') }}" method="post">
                                            @csrf
                                            <div class="row my-2">
                                                <div class="col-sm-2">
                                                    <label for="email">Email</label>
                                                </div>
                                                <div class="col-sm-10">
                                                    <input type="email" name="email" class="form-control form-control-sm" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Masukkan Email Address...">
                                                </div>
                                            </div>
                                            <div class="row my-2">
                                                <div class="col-sm-2">
                                                    <label for="nama">Nama</label>
                                                </div>
                                                <div class="col-sm-10">
                                                    <input type="text" name="nama" class="form-control form-control-sm" id="exampleInputNama" aria-describedby="emailHelp" placeholder="Masukkan nama...">
                                                </div>
                                            </div>
                                            <div class="row my-2">
                                                <div class="col-sm-2">
                                                    <label for="nama">Level</label>
                                                </div>
                                                <div class="col-sm-10">
                                                    <div class="form-check-inline col-sm-5 justify-content-center">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" name="role">Siswa
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline col-sm-5 justify-content-center">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" name="role">Petugas
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row my-2">
                                                <div class="col-sm-2">
                                                    <label for="nama">Nama</label>
                                                </div>
                                                <div class="col-sm-10">
                                                    <input type="text" name="nama" class="form-control form-control-sm" id="exampleInputNama" aria-describedby="emailHelp" placeholder="Masukkan nama...">
                                                </div>
                                            </div>
                                            <div>
                                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                                    <i class="fa fa-save"></i>
                                                    Simpan
                                                </button>
                                            </div>
                                        </form>
                                    </div>

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