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
                            <!-- <h6 class="inline">Data spp</h6> -->
                            <div class="btn btn-sm btn-primary float-left inline" href="{{ route('spp.index') }}"><i class="fa fa-arrow-left"> Back</i></div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row">Tahun</th>
                                        <td>{{ $spp->tahun }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Nominal </th>
                                        <td>{{ $spp->nominal }}</td>
                                    </tr>
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