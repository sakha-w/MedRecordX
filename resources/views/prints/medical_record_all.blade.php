<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        rekam_medis_{{ $patient->nama }}_{{ $patient->id_pasien }}_all
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
                                <td>{{ $patient->nama }}</td>
                            </tr>
                            <tr>
                                <td>No BPJS</td>
                                <td>:</td>
                                <td>{{ $patient->no_bpjs ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td>{{ ucwords($patient->jenis_kelamin) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <hr>

            <h5 class="mb-4">Riwayat Rekam Medis</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>Tanggal Periksa</th>
                        <th>Keluhan</th>
                        <th>Alergi</th>
                        <th>Gula Darah</th>
                        <th>Diagnosis</th>
                        <th>Terapi</th>
                        <th>Harga</th>
                        <th>Resep Obat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($medRecords as $medRecord)
                        <tr>
                            <td>{{ $medRecord->created_at->format('d/m/Y') }}</td>
                            <td>{{ $medRecord->keluhan }}</td>
                            <td>{{ $medRecord->alergi }}</td>
                            <td>{{ $medRecord->gula_darah }} mg</td>
                            <td>{{ $medRecord->diagnosis }}</td>
                            <td>{{ $medRecord->terapi }}</td>
                            <td>Rp. {{ number_format($medRecord->harga, 0, ',', '.') }}</td>
                            <td>{!! $medRecord->resep_obat !!}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <div class="row justify-content-end mt-5">
            <div class="col-4">
                <div class="role">
                    <p class="role">Petugas,</p>
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
