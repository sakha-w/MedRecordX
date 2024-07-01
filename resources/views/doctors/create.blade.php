@extends('layouts.app')

@section('content')
<form action="{{ route('dokter.store') }}" method="POST" class="row">
    <div class="col-md-7">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Data Dokter</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->

            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                        placeholder="Nama" name="nama" value="{{ old('nama') }}">
                    @error('nama')
                    <p class="invalid-feedback">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="id_poli">Poli</label>
                    <select class="form-control @error('id_poli') is-invalid @enderror" id="id_poli"
                        name="id_poli">
                        <option value="">Pilih Poli</option>
                        @foreach ($polies as $poly)
                        <option value="{{ $poly->id_poli }}" {{ old('id_poli') ? 'selected' : '' }}>{{ $poly->nama_poli }}</option>
                        @endforeach
                    </select>
                    @error('id_poli')
                    <p class="invalid-feedback">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin"
                        name="jenis_kelamin">
                        <option value="">Pilih jenis kelamin</option>
                        <option value="pria" {{ old('jenis_kelamin') == 'pria' ? 'selected' : '' }}>Pria</option>
                        <option value="wanita" {{ old('jenis_kelamin') == 'wanita' ? 'selected' : '' }}>Wanita</option>
                    </select>
                    @error('jenis_kelamin')
                    <p class="invalid-feedback">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="no_hp">No Hp</label>
                    <input type="number" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                        placeholder="No Hp" name="no_hp" value="{{ old('no_hp') }}">
                    @error('no_hp')
                    <p class="invalid-feedback">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        placeholder="email" name="email" value="{{ old('email') }}">
                    @error('email')
                    <p class="invalid-feedback">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tgl_lahir">Tanggal Lahir</label>
                    <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" id="tgl_lahir"
                        name="tgl_lahir">
                    @error('tgl_lahir')
                    <p class="invalid-feedback">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tempat_lahir">Tempat Lahir</label>
                    <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                        id="tempat_lahir" placeholder="Tempat Lahir" name="tempat_lahir"
                        value="{{ old('tempat_lahir') }}">
                    @error('tempat_lahir')
                    <p class="invalid-feedback">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror"
                        rows="3" placeholder="Alamat" name="alamat">{{ old('alamat') }}</textarea>
                    @error('alamat')
                    <p class="invalid-feedback">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="col-md-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Akun</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text"
                                class="form-control form-control-sm @error('username') is-invalid @enderror"
                                id="username" name="username" placeholder="username" value="{{ old('username') }}">
                            @error('username')
                            <p class="invalid-feedback">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password"
                                class="form-control form-control-sm @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="password">
                            @error('password')
                            <p class="invalid-feedback">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Buat Akun</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card collapsed-card">
            <div class="card-header">
                <h3 class="card-title">Terakhir Ditambah</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">ID</th>
                            <th>Nama</th>
                            <th style="width: 40px">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($doctors as $id => $doctor)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $doctor }}</td>
                            <td>
                                <a href="{{ route('dokter.show', $id) }}"><span class="badge bg-info">Detail</span>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</form>

@endsection
