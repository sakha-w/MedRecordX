@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ $pageTitle }}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div id="doctors_table_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                @if (session()->has('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="fa-solid fa-check mr-1"></i>
                                        {!! session('success') !!}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <a href="{{ route('dokter.create') }}" class="btn btn-info btn-sm mb-2">
                                    <i class="fa-solid fa-plus"></i>
                                    Tambah Data
                                </a>
                                <table id="doctors_table" class="table table-bordered table-striped dataTable dtr-inline"
                                    aria-describedby="doctors_table_info">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th style="width: 10px">ID</th>
                                            <th>Nama</th>
                                            <th>Poli</th>
                                            <th>No Hp</th>
                                            <th style="width: 100px">Jenis Kelamin</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($doctors as $doctor)
                                            <tr class="odd">
                                                <td>{{ $loop->iteration }}.</td>
                                                <td>{{ $doctor->id_dokter }}</td>
                                                <td>{{ $doctor->nama }}</td>
                                                <td>{!! $doctor->poly->nama_poli ?? '<strong class="text-danger">Silahkan pilih poli</strong>' !!}</td>
                                                <td>{{ $doctor->no_hp }}</td>
                                                <td>
                                                    @if ($doctor->jenis_kelamin === 'pria')
                                                        <p class="text-center">
                                                            <i class="fa-solid fa-person mr-1"></i>
                                                            {{ $doctor->jenis_kelamin }}
                                                        </p>
                                                    @else
                                                        <p class="text-center">
                                                            <i class="fa-solid fa-person-dress mr-1"></i>
                                                            {{ $doctor->jenis_kelamin }}
                                                        </p>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info btn-sm">Action</button>
                                                        <button type="button"
                                                            class="btn btn-info btn-sm dropdown-toggle dropdown-icon"
                                                            data-toggle="dropdown">
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <div class="dropdown-menu" role="menu">
                                                            <a class="dropdown-item text-info"
                                                                href="{{ route('dokter.show', $doctor->id_dokter) }}">
                                                                <i class="fa-solid fa-circle-info"></i>
                                                                Detail</a>
                                                            <div class="dropdown-divider"></div>
                                                            <form action="{{ route('dokter.destroy', $doctor->id_dokter) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item text-danger"
                                                                    onclick="return confirm('Anda yakin ingin menghapus data ini?')">
                                                                    <i class="fa-solid fa-trash"></i>
                                                                    Hapus
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection

@section('custom_script')
    <script>
        $(function() {
            $("#doctors_table").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "ordering": false,
                "buttons": [
                    "print",
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    "colvis"
                ]
            }).buttons().container().appendTo('#doctors_table_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
