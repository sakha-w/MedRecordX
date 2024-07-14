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
                <form action="{{ route('rekam_medis.update', $medRecord->id_rekmed) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-6">
                            <table cellpadding="5">
                                <tbody>
                                    <tr>
                                        <td>ID Pasien</td>
                                        <td>:</td>
                                        <td>{{ $medRecord->id_pasien }}</td>
                                    </tr>
                                    <tr>
                                        <td>ID Antrian</td>
                                        <td>:</td>
                                        <td>{{ $patient->queue->id_antrian }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Dokter</td>
                                        <td>:</td>
                                        <td>{{ $medRecord->doctor->nama }}</td>
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
                                        <td>{{ $medRecord->patient->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal / Jam</td>
                                        <td>:</td>
                                        <td>{{ $medRecord->created_at->format('d M y / H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Poli</td>
                                        <td>:</td>
                                        <td>{{ $medRecord->poly->nama_poli }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <hr>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sistole">Sistole</label>
                                <input type="number" class="form-control @error('sistole') is-invalid @enderror" placeholder="Sistole" id="sistole" name="sistole" value="{{ old('sistole', $medRecord->sistole) }}" @if (auth()->user()->role !== 'admin' && auth()->user()->role !== 'dokter') disabled @endif>
                                @error('sistole')
                                <p class="invalid-feedback">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="diastole">Diastole</label>
                                <input type="number" class="form-control @error('diastole') is-invalid @enderror" placeholder="Diastole" id="diastole" name="diastole" value="{{ old('diastole', $medRecord->diastole) }}" @if (auth()->user()->role !== 'admin' && auth()->user()->role !== 'dokter') disabled @endif>
                                @error('diastole')
                                <p class="invalid-feedback">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="gula_darah">Gula Darah</label>
                                <input type="number" class="form-control @error('gula_darah') is-invalid @enderror" placeholder="Gula Darah" id="gula_darah" name="gula_darah" value="{{ old('gula_darah', $medRecord->gula_darah) }}" @if (auth()->user()->role !== 'admin' && auth()->user()->role !== 'dokter') disabled @endif>
                                @error('gula_darah')
                                <p class="invalid-feedback">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="alergi">Alergi</label>
                        <input type="text" class="form-control @error('alergi') is-invalid @enderror" name="alergi" id="alergi" placeholder="Alergi" value="{{ old('alergi', $medRecord->alergi) }}" @if (auth()->user()->role !== 'admin' && auth()->user()->role !== 'dokter') disabled @endif>
                        @error('alergi')
                        <p class="invalid-feedback">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="keluhan">Keluhan <span style="color: red; font-size: smaller;">*</span></label>
                        <textarea name="keluhan" id="keluhan" class="form-control @error('keluhan') is-invalid @enderror" rows="3" placeholder="Keluhan pasien" @if (auth()->user()->role !== 'admin' && auth()->user()->role !== 'dokter') readonly @endif>{{ old('keluhan', $medRecord->keluhan) }}</textarea>
                        @error('keluhan')
                        <p class="invalid-feedback">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="diagnosis">Diagnosis <span style="color: red; font-size: smaller;">*</span></label>
                        <textarea name="diagnosis" id="diagnosis" class="form-control @error('diagnosis') is-invalid @enderror" rows="3" placeholder="Diagnosis" @if (auth()->user()->role !== 'admin' && auth()->user()->role !== 'dokter') readonly @endif>{{ old('diagnosis', $medRecord->diagnosis) }}</textarea>
                        @error('diagnosis')
                        <p class="invalid-feedback">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="terapi">Terapi <span style="color: red; font-size: smaller;">*</span></label>
                        <textarea name="terapi" id="terapi" class="form-control @error('terapi') is-invalid @enderror" rows="3" placeholder="Terapi" @if (auth()->user()->role !== 'admin' && auth()->user()->role !== 'dokter') readonly @endif>{{ old('terapi', $medRecord->terapi) }}</textarea>
                        @error('terapi')
                        <p class="invalid-feedback">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    @if (auth()->user()->role === 'admin' || auth()->user()->role === 'perawat')
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control @error('harga') is-invalid @enderror" name="harga" id="harga" value="{{ old('harga', $medRecord->harga) }}">
                        @error('harga')
                        <p class="invalid-feedback">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    @endif

            </div>
        </div>

        <hr>

        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title text-bold">Resep Obat <span style="color: red; font-size: smaller;">*</span></h3>
            </div>
            <div class="form-group">
                <!-- Input hidden resep_obat -->
                <input id="resep_obat" type="hidden" name="resep_obat" value="{{ old('resep_obat', $medRecord->resep_obat) }}">


                <!-- Kontrol trix-editor -->
                @if (auth()->user()->role === 'admin' || auth()->user()->role === 'dokter')
                <trix-editor input="resep_obat"></trix-editor>
                @else
                <div class="form-control" style="height:auto;" readonly>{!! $medRecord->resep_obat !!}</div>
                @endif

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
    $(document).ready(function() {
        $('#doctor-select').select2();
    });
</script>
@endsection