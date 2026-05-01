@extends('page/layout/app')

@section('title', 'Lapangan')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>DataTable Lapangan</h3>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                Data Lapangan
                <button style="float: right;" type="button" class="btn btn-sm btn-outline-primary block"
                data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                Tambah Data
            </button>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>No. </th>
                        <th>Jenis Lapangan</th>
                        <th>Nama Lapangan</th>
                        <th>Harga Sewa</th>
                        <th>Gambar</th>
                        <th>Kegiatan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; ?>
                    @foreach($data as $dt)
                    <tr>
                        <td>{{$no}}. </td>
                        <td>{{$dt->nama_jenis}}</td>
                        <td>{{$dt->nama_lap}}</td>
                        <td>Rp {{number_format($dt->harga,0,",",".")}}</td>
                        <td>
                            <a href="{{asset('gambar')}}//{{$dt->gambar}}" target="_blank">
                                <img src="{{asset('gambar')}}//{{$dt->gambar}}" width="80">
                            </a>
                        </td>
                        <td>{{$dt->kegiatan}}</td>
                        <td align="center">
                            <button data-bs-toggle="modal" data-bs-target="#edit{{$dt->id_lapangan}}" class="btn btn-sm btn-success rounded-pill">
                                <i class="dripicons dripicons-document-edit"></i>
                            </button>
                            <a href="{{route('delete_lapangan',$dt->id_lapangan)}}" onclick="return confirm('Hapus Data')" class="btn btn-sm btn-danger rounded-pill">
                                <i class="dripicons dripicons-trash"></i>
                            </a>
                            <a href="{{route('image',$dt->id_lapangan)}}" class="btn btn-sm btn-primary rounded-pill">
                                <i class="dripicons dripicons-photo-group"></i>
                            </a>
                        </td>
                    </tr>
                    <?php $no++ ?>
                    @include('page/lapangan/edit')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</section>
</div>

@include('page/lapangan/tambah')
@endsection