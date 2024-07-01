@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Periksa Pasien</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ route('rekam_medis.store') }}" method="POST">
                    @csrf
                    {{-- hidden input --}}
                    <input type="hidden" name="id_pasien" value="{{ $queue->patient->id_pasien }}">
                    <input type="hidden" name="id_poli" value="{{ $queue->poly->id_poli }}">
                    <input type="hidden" name="id_antrian" value="{{ $queue->id_antrian }}">

                    @if (auth()->user()->role === 'dokter')
                    <input type="hidden" name="id_dokter" value="{{ auth()->user()->doctor->id_dokter }}">
                    @endif

                    <div class="row">
                        <div class="col-6">
                            <table cellpadding="5">
                                <tbody>
                                    <tr>
                                        <td>ID Pasien</td>
                                        <td>:</td>
                                        <td>{{ $queue->patient->id_pasien }}</td>
                                    </tr>
                                    <tr>
                                        <td>ID Antrian</td>
                                        <td>:</td>
                                        <td>{{ $queue->id_antrian }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Dokter</td>
                                        <td>:</td>
                                        <td>
                                            @if (auth()->user()->role === 'dokter')
                                            {{ auth()->user()->doctor->nama }}
                                            @else
                                            <select name="id_dokter" id="doctor-select"
                                                class="form-control @error('id_dokter') is-invalid @enderror">
                                                <option value="">Pilih dokter</option>
                                                @foreach ($doctors as $id => $doctor)
                                                <option value="{{ $id }}" {{ old('id_dokter') ? 'selected' : '' }}>
                                                    {{ $id . ' - ' . $doctor }}</option>
                                                @endforeach
                                            </select>
                                            @endif
                                            @error('id_dokter')
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-6">
                            <table cellpadding="5">
                                <tbody>
                                    <tr>
                                        <td>Nama Pasien</td>
                                        <td>:</td>
                                        <td>{{ $queue->patient->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal / Jam</td>
                                        <td>:</td>
                                        <td>{{ now()->format('d M y / H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Poli</td>
                                        <td>:</td>
                                        <td>{{ $queue->poly->nama_poli }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <hr>

                    <div class="row mt-2">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sistole">Sistole (mmHg)</label>
                                <input type="number" class="form-control @error('sistole') is-invalid @enderror"
                                    placeholder="Sistole" id="sistole" name="sistole" value="{{ old('sistole') }}">
                                @error('sistole')
                                <p class="invalid-feedback">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="diastole">Diastole (mmHg)</label>
                                <input type="number" class="form-control @error('diastole') is-invalid @enderror"
                                    placeholder="Diastole" id="diastole" name="diastole" value="{{ old('diastole') }}">
                                @error('diastole')
                                <p class="invalid-feedback">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="gula_darah">Gula Darah (mg/dL)</label>
                                <input type="number" class="form-control @error('gula_darah') is-invalid @enderror"
                                    placeholder="Gula Darah" id="gula_darah" name="gula_darah"
                                    value="{{ old('gula_darah') }}">
                                @error('gula_darah')
                                <p class="invalid-feedback">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="alergi">Alergi</label>
                                <input type="text" class="form-control @error('alergi') is-invalid @enderror"
                                    name="alergi" id="alergi" placeholder="Alergi" value="{{ old('alergi') }}">
                                @error('alergi')
                                <p class="invalid-feedback">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="keluhan">Keluhan</label>
                                <textarea name="keluhan" id="keluhan"
                                    class="form-control @error('keluhan') is-invalid @enderror" rows="3"
                                    placeholder="Keluhan pasien">{{ old('keluhan') }}</textarea>
                                @error('keluhan')
                                <p class="invalid-feedback">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="diagnosis">Diagnosis</label>
                                <textarea name="diagnosis" id="diagnosis"
                                    class="form-control @error('diagnosis') is-invalid @enderror" rows="3"
                                    placeholder="Diagnosis">{{ old('diagnosis') }}</textarea>
                                @error('diagnosis')
                                <p class="invalid-feedback">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="terapi">Terapi</label>
                                <textarea name="terapi" id="terapi"
                                    class="form-control @error('terapi') is-invalid @enderror" rows="3"
                                    placeholder="Terapi">{{ old('terapi') }}</textarea>
                                @error('terapi')
                                <p class="invalid-feedback">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                    name="harga" id="harga" placeholder="Rp.0" value="{{ old('harga', 0) }}"
                                    @if(auth()->user()->role === 'dokter') disabled @endif>
                                @error('harga')
                                <p class="invalid-feedback">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>


                        </div>
                    </div>

                    <hr>

                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title text-bold">Resep Obat</h3>
                        </div>
                        <div class="form-group">
                            <input id="resep_obat" type="hidden" name="resep_obat" value="{{ old('resep_obat') }}">
                            <trix-editor input="resep_obat"></trix-editor>
                            @error('resep_obat')
                            <p class="invalid-feedback">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <div class="row">
                            <div class="col-6">
                                <a href="{{ route('antrian.index') }}" class="btn btn-sm btn-info">
                                    <i class="fa-solid fa-circle-xmark mr-1"></i>
                                    Kembali
                                </a>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-sm btn-info float-right">
                                    <i class="fa-solid fa-check mr-1"></i>
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_script')
<script>
    $(document).ready(function () {
        $('#doctor-select').select2();
    });

    $(document).ready(function () {
        $('#medicine-select').select2();
    });

</script>
@endsection
