@extends('page/layout/app')

@section('title', 'Data Sewa')

@section('content')
<div class="page-heading">

    <section class="section">
        <div class="card">
            <div class="card-header">
                With Data Sewa Lapangan <b>{{Auth::user()->name}}</b>
                <button style="float: right;" type="button" class="btn btn-sm btn-outline-success block"
                data-bs-toggle="modal" data-bs-target="#kode">
                Kode Pembayaran
            </button>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>No. </th>
                        <th>Nama Lapangan</th>
                        <th>Harga</th>
                        <th>Jam Sewa</th>
                        <th>Lama Sewa</th>
                        <th>Tenggat Upload</th>
                        <th>Tanggal Sewa</th>
                        <th>Bukti Transfer</th>
                        <th>Total</th>
                        <th>Action Data</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; ?>
                    @foreach($data as $dt)
                    <?php date_default_timezone_set('Asia/Jakarta');
                    $mulai=strtotime($dt->jam_mulai);
                    $selesai=strtotime($dt->jam_selesai);

                    $dif=$selesai-$mulai;

                    $jam=floor($dif/(60*60));
                    $menit=$dif-$jam*(60*60);
                    $menit2=floor($menit/60);
                    if ($menit2>=30) {
                        $jam+=1;
                    }
                    ?>
                    <tr>
                        <td>{{$no}}. </td>
                        <td>{{$dt->nama_lap}}</td>
                        <td>Rp {{number_format($dt->harga,0,",",".")}}</td>
                        <td>{{$dt->jam_mulai}} - {{$dt->jam_selesai}}</td>
                        <td>
                            {{$jam}} Jam
                        </td>
                        <td>
                            @if($dt->konfirmasi=="Belum di Konfirmasi")
                            {{$dt->tempo}}
                            @else
                            <span class="badge bg-success">Clear</span>
                            @endif
                        </td>
                        <td>{{$dt->tanggal}}
                            <br>
                            @if($dt->tanggal==date('Y-m-d'))
                            <span class="text text-success">Hari ini</span>
                            @endif
                        </td>
                        <td align="center">
                            @if($dt->bukti_tf=="-")
                            <span class="badge bg-danger">Segera Upload <br>Bukti Transfer</span>
                            @else
                            <a href="{{asset('upload')}}/{{$dt->bukti_tf}}" target="_blank"><span class="badge bg-warning"><i class="dripicons dripicons-preview"></i></span></a>
                            @endif
                        </td>
                        <td>
                            Rp {{number_format($dt->harga*$jam,0,",",".")}}
                        </td>
                        <td align="center">
                            <button data-bs-toggle="modal" data-bs-target="#edit{{$dt->id_sewa}}" class="btn btn-sm btn-primary">
                                <i class="dripicons dripicons-disc"></i>
                            </button>
                            @if($dt->konfirmasi=="Belum di Konfirmasi")
                            <a href="{{route('delete_sewa',$dt->id_sewa)}}" onclick="return confirm('Lanjut untuk Hapus?')" class="btn btn-sm btn-danger">
                                <i class="dripicons dripicons-trash"></i>
                            </a>
                            <button data-bs-toggle="modal" data-bs-target="#upload{{$dt->id_sewa}}" class="btn btn-sm btn-success">
                                <i class="dripicons dripicons-browser-upload"></i>
                            </button>
                            @endif
                        </td>
                    </tr>
                    <?php $no++ ?>
                    @include('halaman/detailsewa')
                    @include('halaman/uploadbayar')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</section>
</div>
@include('halaman/norek')
@endsection