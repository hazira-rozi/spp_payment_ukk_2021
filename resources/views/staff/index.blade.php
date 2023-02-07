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
                            <a class="btn btn-sm btn-primary float-right inline" href="{{ route('staff.create') }}">Add Data <i class="fa fa-plus"></i></a>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th class="text-center">Nama Petugas</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_staff as $staff)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $staff->nama_petugas }}</td>
                                        <td>{{ $staff->email }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('staff.destroy' ,$staff->id)}}" method="post">
                                                @csrf
                                                <a class="btn btn-sm btn-primary" href="{{ route('staff.show',$staff->id) }}">View <i class="fa fa-eye"></i></a>
                                                <a class="btn btn-sm btn-success" href="{{ route('staff.edit',$staff->id) }}">Edit <i class="fa fa-edit"></i></a>
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus User {{$staff->nama_petugas}}?')">Delete <i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix">
                            <div class="d-flex justify-content-center">
                                Showing {{($data_staff->currentpage()-1)*$data_staff->perpage()+1}} to {{ $data_staff->currentpage()*(($data_staff->perpage() < $data_staff->total()) ? $data_staff->perpage(): $data_staff->total())}} of {{ $data_staff->total()}} entries</div>
                            <div class="d-flex justify-content-center">{!! $data_staff->links() !!}</div>
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