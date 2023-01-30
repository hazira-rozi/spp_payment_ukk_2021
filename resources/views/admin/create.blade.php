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
                                        <form action="{{route('staff.store')}}" method="POST" enctype="multipart/form-data">
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

                                            <hr>

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