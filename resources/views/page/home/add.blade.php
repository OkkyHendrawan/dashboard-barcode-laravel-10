@extends('layout.app')
@section('content')
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <br>
            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <form action="{{ route('page.home.proses_create') }}" method="POST">
                        @csrf
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Tambah Mahasiswa</h1>

                    <!-- body -->
                        <!-- form text field -->
                        <div class="mb-3">
                            <label for="exampleInputText" class="form-label">NBI</label>
                            <input type="text" class="form-control" id="nbi" name="nbi"
                                aria-describedby="emailHelp">
                                @if ($errors->has('nbi'))
                                <span class="text-danger">{{ $errors->first('nbi') }}</span>
                                @endif
                        </div>
                        <!-- end form text field -->
                        <!-- form text field -->
                        <div class="mb-3">
                            <label for="exampleInputText" class="form-label">Nama Mahasiswa</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                aria-describedby="emailHelp">
                        </div>
                        <!-- end form text field -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('page.home.list') }}" class="btn btn-secondary">Batal</a>
                    <!-- end body -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
@endsection
