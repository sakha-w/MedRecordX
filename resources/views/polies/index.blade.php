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
                    <div id="polies_table_wrapper" class="dataTables_wrapper dt-bootstrap4">
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
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-info btn-sm mb-2" data-toggle="modal"
                                    data-target="#addModal">
                                    <i class="fa-solid fa-plus"></i>
                                    Tambah Data
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="addModal" tabindex="-1" role="dialog"
                                    aria-labelledby="addModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addModalLabel">Tambah Data Poli</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('poli.store') }}" method="post">
                                                <div class="modal-body">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="id_poli">Kode Poli</label>
                                                        <input type="text"
                                                            class="form-control @error('id_poli') is-invalid @enderror"
                                                            id="id_poli" placeholder="ID Poli" name="id_poli"
                                                            value="{{ old('id_poli') }}">
                                                        @error('id_poli')
                                                            <p class="invalid-feedback">
                                                                {{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_poli">Nama Poli</label>
                                                        <input type="text"
                                                            class="form-control @error('nama_poli') is-invalid @enderror"
                                                            id="nama_poli" placeholder="Nama Poli" name="nama_poli"
                                                            value="{{ old('nama_poli') }}">
                                                        @error('nama_poli')
                                                            <p class="invalid-feedback">
                                                                {{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <table id="polies_table" class="table table-bordered table-striped dataTable dtr-inline"
                                    aria-describedby="polies_table_info">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th style="width: 10px">ID</th>
                                            <th>Nama Poli</th>
                                            <th>Jumlah Dokter</th>
                                            <th>Jumlah Antrian</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($polies as $index => $poly)
                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="modal{{ $poly->id_poli }}" tabindex="-1"
                                                role="dialog" aria-labelledby="modal{{ $poly->id_poli }}Label"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modal{{ $poly->id_poli }}Label">
                                                                Update Data Poli</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('poli.update', $poly->id_poli) }}"
                                                            method="post">
                                                            <div class="modal-body">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group">
                                                                    <label for="id_poli">Kode Poli</label>
                                                                    <input type="text"
                                                                        class="form-control @error('id_poli') is-invalid @enderror"
                                                                        id="id_poli" placeholder="ID Poli" name="id_poli"
                                                                        value="{{ old('id_poli', $poly->id_poli) }}">
                                                                    @error('id_poli')
                                                                        <p class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </p>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="nama_poli">Nama Poli</label>
                                                                    <input type="text"
                                                                        class="form-control @error('nama_poli') is-invalid @enderror"
                                                                        id="nama_poli" placeholder="Nama Poli"
                                                                        name="nama_poli"
                                                                        value="{{ old('nama_poli', $poly->nama_poli) }}">
                                                                    @error('nama_poli')
                                                                        <p class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Tutup</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <tr class="odd">
                                                <td>{{ $loop->iteration }}.</td>
                                                <td>{{ $poly->id_poli }}</td>
                                                <td>{{ $poly->nama_poli }}</td>
                                                <td>{{ $doctors[$index] <= 0 ? 'Belum ada dokter' : $doctors[$index] . ' dokter' }}
                                                </td>
                                                <td>{{ $queues[$index] <= 0 ? 'Belum ada pasien' : $queues[$index] . ' pasien' }}
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
                                                            <button type="submit" class="dropdown-item text-warning"
                                                                data-toggle="modal"
                                                                data-target="#modal{{ $poly->id_poli }}">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                                Edit
                                                            </button>
                                                            <div class="dropdown-divider"></div>
                                                            <form action="{{ route('poli.destroy', $poly->id_poli) }}"
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

@section('custom_script')
    <script>
        @if (count($errors) > 0)
            $('#addModal').modal('show');
        @endif

        $(function() {
            $("#polies_table").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "ordering": false,
                "buttons": [
                    "print",
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    "colvis"
                ]
            }).buttons().container().appendTo('#polies_table_wrapper .col-md-6:eq(0)');
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
