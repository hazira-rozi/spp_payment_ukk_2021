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

                        <!-- Card Body -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th class="text-center">Nama Kelas</th>
                                        <th class="text-center">Kompetensi Keahlian</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_kelas as $kelas)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $kelas->nama_kelas }}</td>
                                        <td>{{ $kelas->kompetensi_keahlian }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('kelas.destroy' ,$kelas->id)}}" method="post">
                                                @csrf
                                                <a class="btn btn-sm btn-primary" href="{{ route('kelas.show',$kelas->id) }}">View <i class="fa fa-eye"></i></a>
                                                <a class="btn btn-sm btn-success" href="{{ route('kelas.edit',$kelas->id) }}">Edit <i class="fa fa-edit"></i></a>
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus User {{$kelas->name}}?')">Delete <i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
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