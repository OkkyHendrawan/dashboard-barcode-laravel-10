@extends('layout.app')
@section('content')
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <br>
            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
                    <p class="mb-4">Deskripsi di sini <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p>
                    <!-- body -->
                    <form action="{{ route('page.home.update', $home->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!-- hidden id -->
                        <input type="hidden" class="form-control" id="id" name="id" value="{{$home->id}}"
                                aria-describedby="emailHelp">
                        <!-- end hidden id -->
                        <!-- form text field -->
                        <div class="mb-3">
                            <label for="exampleInputText" class="form-label">Nama Peserta</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{$home->nama}}"
                                aria-describedby="emailHelp">
                        </div>
                        <!-- end form text field -->
                        <!-- form text field -->
                        <div class="mb-3">
                            <label for="exampleInputText" class="form-label">NBI</label>
                            <input type="text" class="form-control" id="nbi" name="nbi" value="{{$home->nbi}}"
                                aria-describedby="emailHelp">
                                @if ($errors->has('nbi'))
                                <span class="text-danger">{{ $errors->first('nbi') }}</span>
                                @endif
                        </div>
                        <!-- end form text field -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    <!-- end body -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
@endsection
