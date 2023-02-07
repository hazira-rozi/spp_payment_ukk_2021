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
                                    <form action="{{ route('staff.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row my-2">
                                            <div class="col-sm-2">
                                                <label for="nama_petugas">Nama Petugas</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" name="nama_petugas" id="nama_petugas" class="form-control form-control-sm" placeholder="Nama Petugas">
                                                {!!$errors->first("nama_petugas", "<span class='text-danger'>:message</span>")!!}
                                            </div>
                                        </div>
                                        <div class="row my-2">
                                            <div class="col-sm-2">
                                                <label for="email">Email</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="email" name="email" id="email" class="form-control form-control-sm" placeholder="Email Petugas">
                                                {!!$errors->first("email", "<span class='text-danger'>:message</span>")!!}
                                            </div>
                                        </div>
                                        <div class="row my-2">
                                            <div class="col-sm-2">
                                                <label for="role">Level User</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="role">
                                                    <option>Pilih Level</option>
                                                    
                                                    <option value="admin">Administrator</option>
                                                    <option value="staff">Petugas</option>
                                                    
                                                </select>
                                                {!!$errors->first("role", "<span class='text-danger'>:message</span>")!!}
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