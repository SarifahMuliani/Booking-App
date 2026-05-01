@extends('page/layout/app')

@section('title', 'Laporan')

@section('content')
<div class="page-heading">

    <section class="section">
        <div class="card">
            <div class="card-header">
             <form method="get" action="{{route('laporan')}}">
                @csrf
                <div class="row">
                    <div class="col-4">
                        <label>Mulai Tanggal</label>
                        <input type="date" class="form-control" name="awal">
                    </div>
                    <div class="col-4">
                        <label>Sampai Tanggal</label>
                        <input type="date" class="form-control" name="akhir">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-2">
                        <button class="btn btn-sm btn-primary">
                            Submit
                        </button >
                    </div>
                    @if(!empty($_GET['awal']))
                    <div class="col-2">
                        <a onclick="window.open('{{route('export_laporan')}}?_token&awal={{$_GET['awal']}}&akhir={{$_GET['akhir']}}&keyword=Export-PDF')" class="btn btn-sm btn-danger">
                            <i class="dripicons dripicons-print"></i>
                        </a >
                        <a onclick="window.open('{{route('export_laporan')}}?_token&awal={{$_GET['awal']}}&akhir={{$_GET['akhir']}}&keyword=Export-Excel')" class="btn btn-sm btn-success">
                            <i class="dripicons dripicons-export"></i>
                        </a >
                    </div>
                    @endif
                </div>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>No. </th>
                        <th>Nama Lapangan</th>
                        <th>Nama Penyewa</th>
                        <th>No HP</th>
                        <th>Harga</th>
                        <th>Jam Mulai</th>
                        <th>Lama Sewa</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nul=0; ?>
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
                    $total=$dt->harga*$jam;
                    $subtotal=number_format($nul+=$total,0,",",".");
                    ?>
                    <tr>
                        <td>{{$no}}. </td>
                        <td>{{$dt->nama_lap}}</td>
                        <td>{{$dt->name}}</td>
                        <td>{{$dt->no_telp}}</td>
                        <td>Rp {{number_format($dt->harga,0,",",".")}}</td>
                        <td>{{$dt->jam_mulai}} - {{$dt->jam_selesai}}</td>
                        <td>
                            {{$jam}} Jam
                        </td>
                        <td>
                            Rp {{number_format($total,0,",",".")}}
                        </td>
                    </tr>
                    <?php $no++ ?>
                    @endforeach
                    @foreach($omset as $mo)
                    <tr>
                        <td colspan="7"><b>Subtotal : </b></td>
                        <td>Rp {{$subtotal}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</section>
</div>

@endsection