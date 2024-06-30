@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>0</h3>
                    <p>Kategori 1</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-hospital-user"></i>
                </div>
                <a href="#" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>0</h3>
                    <p>Kategori 2</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-user-doctor"></i>
                </div>
                <a href="#" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>0</h3>
                    <p>Kategori 3</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-user-nurse"></i>
                </div>
                <a href="#" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>0</h3>
                    <p>Kategori 4</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-user-nurse"></i>
                </div>
                <a href="#" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card card-primary card-outline">
                <div class="card-header border-transparent">
                    <h3 class="card-title">Data Tabel</h3>
                </div>
                <div class="card-body p-0" style="display: block;">
                    <div class="table-responsive">
                        <table class="table m-0 table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kolom 1</th>
                                    <th>Kolom 2</th>
                                    <th>Kolom 3</th>
                                    <th>Kolom 4</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada data</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer clearfix" style="display: block;">
                    <a href="#" class="btn btn-sm btn-primary">Lihat Semua Data</a>
                </div>
            </div>
        </div>
    </div>
@endsection
