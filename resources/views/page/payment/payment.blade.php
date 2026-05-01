@extends('page/layout/app')

@section('title', 'Data Kode Pembayaran')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>DataTable Payment</h3>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                With Data Kode Pembayaran
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
                        <th>No Rekening</th>
                        <th>Nama Rekening</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; ?>
                    @foreach($data as $dt)
                    <tr>
                        <td>{{$no}}. </td>
                        <td>{{$dt->no_rek}}</td>
                        <td>{{$dt->nama_rek}}</td>
                        <td align="center">
                            <button data-bs-toggle="modal" data-bs-target="#edit{{$dt->id_payment}}" class="btn btn-sm btn-success rounded-pill"><i class="dripicons dripicons-document-edit"></i></button>
                            <a href="{{route('delete_payment',$dt->id_payment)}}" class="btn btn-sm btn-danger rounded-pill"><i class="dripicons dripicons-trash"></i></a>
                        </td>
                    </tr>
                    <?php $no++ ?>
                    @include('page/payment/edit')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</section>
</div>
@include('page/payment/tambah')
@endsection