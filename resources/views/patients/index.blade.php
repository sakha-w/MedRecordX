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
                    <div id="patients_table_wrapper" class="dataTables_wrapper dt-bootstrap4">
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

                                @can('nurse')
                                    <a href="{{ route('pasien.create') }}" class="btn btn-info btn-sm mb-2">
                                        <i class="fa-solid fa-plus"></i>
                                        Tambah Data
                                    </a>
                                @endcan
                                <table id="patients_table" class="table table-bordered table-striped dataTable dtr-inline"
                                    aria-describedby="patients_table_info">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th style="width: 10px">ID</th>
                                            <th>Nama</th>
                                            <th>No Bpjs</th>
                                            <th style="width: 100px">Jenis Kelamin</th>
                                            <th>Tempat Lahir</th>
                                            <th>Usia</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($patients as $patient)
                                            <tr class="odd">
                                                <td>{{ $loop->iteration }}.</td>
                                                <td>{{ $patient->id_pasien }}</td>
                                                <td>{{ $patient->nama }}</td>
                                                <td class="text-center">{{ $patient->no_bpjs ? $patient->no_bpjs : '-' }}
                                                </td>
                                                <td style="width: 100px">
                                                    @if ($patient->jenis_kelamin === 'pria')
                                                        <p class="text-center">
                                                            <i class="fa-solid fa-person mr-1"></i>
                                                            {{ $patient->jenis_kelamin }}
                                                        </p>
                                                    @else
                                                        <p class="text-center">
                                                            <i class="fa-solid fa-person-dress mr-1"></i>
                                                            {{ $patient->jenis_kelamin }}
                                                        </p>
                                                    @endif
                                                </td>
                                                <td>{{ $patient->tempat_lahir }}</td>
                                                <td>{{ date('Y') - date('Y', strtotime($patient->tgl_lahir)) }} Tahun</td>
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
                                                                href="{{ route('pasien.show', $patient->id_pasien) }}">
                                                                <i class="fa-solid fa-circle-info"></i>
                                                                Detail
                                                            </a>

                                                            @can('nurse')
                                                                <a class="dropdown-item text-warning"
                                                                    href="{{ route('pasien.edit', $patient->id_pasien) }}">
                                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                                    Edit
                                                                </a>
                                                                <div class="dropdown-divider"></div>
                                                                <form
                                                                    action="{{ route('pasien.destroy', $patient->id_pasien) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item text-danger"
                                                                        onclick="return confirm('Anda yakin ingin menghapus data ini?')">
                                                                        <i class="fa-solid fa-trash"></i>
                                                                        Hapus
                                                                    </button>
                                                                </form>
                                                            @endcan
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

@section('custom_script')
    <script>
        $(function() {
            $("#patients_table").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "ordering": false,
                "buttons": [
                    "print",
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    },
                    "colvis"
                ]
            }).buttons().container().appendTo('#patients_table_wrapper .col-md-6:eq(0)');
            // $('#example2').DataTable({
            //     "paging": true,
            //     "lengthChange": false,
            //     "searching": false,
            //     "ordering": true,
            //     "info": true,
            //     "autoWidth": false,
            //     "responsive": true,
            // });
        });
    </script>
@endsection
@endsection
