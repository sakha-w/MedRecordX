    @extends('layouts.app')

    @section('content')
    <div class="row">
        <div class="col-md-12">
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-exclamation mr-1"></i>
                @foreach ($errors->all() as $error)
                {{ $error }}
                @endforeach
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-check mr-1"></i>
                {!! session('success') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary ">
                <div class="card-header card-primary">
                    <h3 class="card-title">Detail Dokter</h3>
                </div>
                <div class="card-body box-profile">
                    <div class="text-center">
                        <label for="file-input">
                            @if ($doctor->photo)
                            <img class="profile-user-img img-fluid img-circle" alt="" style="cursor: pointer" src="{{ asset($doctor->photo) }}" alt="User profile picture">
                            @else
                            @if ($doctor->jenis_kelamin == 'pria')
                            <img class="profile-user-img img-fluid img-circle" alt="" style="cursor: pointer" src="{{ asset('img/doctor-male-img.jpeg') }}" alt="User profile picture">

                            @else
                            <img class="profile-user-img img-fluid img-circle" alt="" style="cursor: pointer" src="{{ asset('img/doctor-female-img.jpeg') }}" alt="User profile picture">
                            @endif

                            @endif
                        </label>
                        <form action="{{ route('dokter.update', $doctor->id_dokter) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="file" id="file-input" class="d-none" onchange="this.form.submit()" name="photo">
                        </form>
                    </div>

                    <h3 class="profile-username text-center"><b>{{ $doctor->nama }}</b> <b></b></h3>

                    <p class="text-muted text-center"><b>{{ ucwords($doctor->user->role) }}</b></p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            Username:<a class="float-right text-dark font-weight-bold">{{ $doctor->user->username }}</a>
                        </li>
                        <li class="list-group-item">
                            Email: <a class="float-right text-dark font-weight-bold">{{ $doctor->email }}</a>
                        </li>
                        <li class="list-group-item">
                            Jenis Kelamin: <a class="float-right text-dark font-weight-bold">{{ $doctor->jenis_kelamin }}</a>
                        </li>
                        <li class="list-group-item">
                            No Hp:<a class="float-right text-dark font-weight-bold">{{ $doctor->no_hp }}</a>
                        </li>
                        <li class="list-group-item">
                            Alamat:<a class="float-right text-dark font-weight-bold">{{ $doctor->alamat }}</a>
                        </li>
                        <li class="list-group-item">
                            Tempat Lahir: <a class="float-right text-dark font-weight-bold">{{ $doctor->tempat_lahir }}</a>
                        </li>

                    </ul>
                    <div class="row">
                        <div class="col-12">
                            <form action="{{ route('dokter.destroy', $doctor->id_dokter) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-block btn-sm " onclick="return confirm('Anda yakin ingin menghapus data ini?')">
                                    <i class="fa-solid fa-trash mr-1"></i>
                                    Hapus Data
                                </button>
                            </form>
                            <a class="text-white" href="{{ route('dokter.show', $doctor->id_dokter) }}"><button type="submit" class="btn btn-warning btn-block btn-sm mt-2 text-white ">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    Edit </button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection