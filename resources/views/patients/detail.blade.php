@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Data Pasien</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h5><strong>{{ $patient->nama }}</strong></h5>
                        </div>
                        <div class="col-6">
                            <h5><strong>{{ $patient->id_pasien }}</strong></h5>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                    <div class="col-6 mb-2">
                            <strong>NIK</strong>
                            <p>{{ $patient->nik }}</p>
                        </div>
                        <div class="col-6 mb-2">
                            <strong>Jenis_kelamin</strong>
                            <p>{{ ucwords($patient->jenis_kelamin) }}</p>
                        </div>
                        <div class="col-6 mb-2">
                            <strong>Tempat Lahir</strong>
                            <p>{{ $patient->tempat_lahir }}</p>
                        </div>
                        <div class="col-6 mb-2">
                            <strong>Tanggal Lahir</strong>
                            <p>{{ $patient->tgl_lahir }}</p>
                        </div>
                        <div class="col-6 mb-2">
                            <strong>No Hp</strong>
                            <p>{{ $patient->no_hp }}</p>
                        </div>
                        <div class="col-6 mb-2">
                            <strong>Alamat</strong>
                            <p>{{ $patient->alamat }}</p>
                        </div>
                        <div class="col-6 mb-2">
                            <strong>Berat Badan</strong>
                            <p>{{ $patient->berat_badan }}</p>
                        </div>
                        <div class="col-6 mb-2">
                            <strong>Tinggi Badan</strong>
                            <p>{{ $patient->tinggi_badan }}</p>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                @can('nurse')
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-6">
                                <form action="{{ route('pasien.destroy', $patient->id_pasien) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Anda yakin ingin menghapus data ini?')">
                                        <i class="fa-solid fa-trash mr-1"></i>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                            <div class="col-6">
                                <a href="{{ route('pasien.edit', $patient->id_pasien) }}"
                                    class="btn btn-sm btn-warning float-right">
                                    <i class="fa-solid fa-pen-to-square mr-1"></i>
                                    Edit
                                </a>
                            </div>
                        </div>
                    </div>
                @endcan
            </div>
        </div>

        <div class="col-md-8">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="icon fas fa-check"></i>
                    {{ session('success') }}
                </div>
            @endif
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="card-title"><strong>Riwayat Rekam Medis</strong></h3>
                        </div>
                        @if ($medRecords->count() > 0)
                            <div class="col-4">
                                @if ($patient->queue !== null)
                                    <div class="float-right">
                                        <form action="{{ route('print.medical_record_all', $patient->id_pasien) }}"
                                            method="POST" class="d-inline" target="_blank">
                                            @csrf
                                            <button type="submit" class="btn btn-info btn-sm">
                                                <i class="fa-solid fa-print"></i>
                                                Cetak Semua
                                            </button>
                                        </form>
                                        <!-- @can('doctor')
                                            <a href="{{ route('antrian.check', $patient->queue->id_antrian) }}"
                                                class="btn btn-sm btn-primary">
                                                <i class="fa-solid fa-plus"></i>
                                                Tambah
                                            </a>
                                        @endcan -->
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 50px">No</th>
                                <th>Keluhan</th>
                                <th>Poli</th>
                                <th>Tanggal Periksa</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($medRecords->count() === 0)
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada riwayat rekam medis</td>
                                </tr>
                            @endif
                            @foreach ($medRecords as $medRecord)
                                <tr>
                                    <td>{{ $loop->iteration }}.</td>
                                    <td>
                                        <a href="{{ route('rekam_medis.show', [$medRecord->id_pasien, $medRecord->id_rekmed]) }}"
                                            class="text-decoration-none">
                                            {{ $medRecord->keluhan }}
                                        </a>
                                    </td>
                                    <td>{{ $medRecord->poly->nama_poli }}</td>
                                    <td>{{ $medRecord->created_at->format('d M Y') }}</td>
                                    <td>
                                        @can('doctor')
                                            <a href="{{ route('rekam_medis.edit', [$medRecord->id_pasien, $medRecord->id_rekmed]) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        @endcan
                                        <form action="{{ route('rekam_medis.destroy', $medRecord->id_rekmed) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Anda yakin ingin menghapus data rekam medis ini?')">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection
