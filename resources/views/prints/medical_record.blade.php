<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        rekam_medis_{{ $medRecord->patient->nama }}_{{ $medRecord->patient->id_pasien }}
    </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <style>
        td {
            padding: .4rem;
        }
    </style>

</head>

<body>

    <div class="container">
        <section class="data">
            <h1 class="text-center my-4">Rekam Medis</h1>

            <div class="info mb-4 mt-2">
                <div class="row">
                    <div class="col-6">
                        <table>
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>{{ $medRecord->patient->nama }}</td>
                            </tr>
                            <tr>
                                <td>No BPJS</td>
                                <td>:</td>
                                <td>{{ $medRecord->patient->no_bpjs ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Poli</td>
                                <td>:</td>
                                <td>{{ $medRecord->poly->nama_poli }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-6">
                        <table>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td>{{ ucwords($medRecord->patient->jenis_kelamin) }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Periksa</td>
                                <td>:</td>
                                <td>{{ $medRecord->created_at->formatLocalized('%d %B %Y') }}</td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>

            <hr>

            <h5 class="mt-4 mb-3">Hasil Periksa</h5>
            <div class="mx-5">

                <table>
                    <tr>
                        <td>Sistole</td>
                        <td>:</td>
                        <td>{{ $medRecord->sistole }} mmHg</td>
                    </tr>
                    <tr>
                        <td>Diastole</td>
                        <td>:</td>
                        <td>{{ $medRecord->diastole }} mmHg</td>
                    </tr>
                    <tr>
                        <td>Gula Darah</td>
                        <td>:</td>
                        <td>{{ $medRecord->gula_darah }} mg</td>
                    </tr>
                    <tr>
                        <td>Alergi</td>
                        <td>:</td>
                        <td>{{ $medRecord->alergi ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Keluhan</td>
                        <td>:</td>
                        <td>{{ $medRecord->keluhan }}</td>
                    </tr>
                    <tr>
                        <td>Diagnosis</td>
                        <td>:</td>
                        <td>{{ $medRecord->diagnosis }}</td>
                    </tr>
                    <tr>
                        <td>Terapi</td>
                        <td>:</td>
                        <td>{{ $medRecord->terapi }}</td>
                    </tr>
                    <tr>
                        <td>harga</td>
                        <td>:</td>
                        <td>Rp. {{ number_format($medRecord->harga, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Resep Obat</td>
                        <td>:</td>
                        <td>{!! $medRecord->resep_obat !!}</td>
                    </tr>
                </table>
            </div>
{{--
            <h5 class="mt-5 mb-2">Resep Obat</h5>
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Nama Obat</th>
                    <th>Jumlah</th>
                    <th>Aturan Pakai</th>
                </thead>
                <tbody>
                    <td>1.</td>
                    <td>{{ $medRecord->prescription->medicine->nama_obat }}</td>
                    <td>{{ $medRecord->prescription->jumlah }}</td>
                    <td>{!! $medRecord->prescription->aturan_pakai !!}</td>
                </tbody>
            </table> --}}
        </section>

        <div class="row justify-content-end mt-5">
            <div class="col-4">
                <div class="role">
                    <p class="role">Pemeriksa,</p>
                    <p class="name mt-5">
                        @if (auth()->user()->role === 'admin')
                            {{ ucwords(auth()->user()->username) }}
                        @endif
                        @if (auth()->user()->role === 'dokter')
                            {{ ucwords(auth()->user()->doctor->nama) }}
                        @endif
                        @if (auth()->user()->role === 'perawat')
                            {{ ucwords(auth()->user()->nurse->nama) }}
                        @endif
                    </p>
                </div>
            </div>
        </div>

    </div>


    <script>
        window.print()
    </script>
</body>

</html>
