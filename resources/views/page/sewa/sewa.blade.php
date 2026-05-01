@extends('page/layout/app')

@section('title', 'Data Sewa')

@section('content')
<div class="page-heading">

    <section class="section">
        <div class="card">
            <div class="card-header">
                Data Sewa Lapangan
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Tanggal Sewa</th>
                            <th>Nama Lapangan</th>
                            <th>Harga</th>
                            <th>Jam Sewa</th>
                            <th>Lama Sewa</th>
                            <th>Bukti Transfer</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Action</th>
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
                        $nominal=$dt->harga*$jam;
                        ?>
                        <tr>
                            <td>{{$no}}. </td>
                            <td>{{$dt->tanggal}}
                                <br>
                                @if($dt->tanggal==date('Y-m-d'))
                                <span class="text text-success">Hari ini</span>
                                @endif
                            </td>
                            <td>{{$dt->nama_jenis}} - {{$dt->nama_lap}}</td>
                            <td>Rp {{number_format($dt->harga,0,",",".")}}</td>
                            <td>{{$dt->jam_mulai}} - {{$dt->jam_selesai}}</td>
                            <td>
                                {{$jam}} Jam
                            </td>
                            <td align="center">
                                @if($dt->bukti_tf=="-")
                                <span class="badge bg-danger">Belum Upload <br>Bukti Transfer</span>
                                @else
                                <a href="{{asset('upload')}}/{{$dt->bukti_tf}}"><span class="badge bg-warning"><i class="dripicons dripicons-preview"></i></span></a>
                                @endif
                            </td>
                            <td align="center">
                                @if($dt->keterangan=="-")
                                <span class="text text-danger">-</span>
                                @elseif($dt->keterangan=="Sedang di Cek")
                                <span class="badge bg-warning text-white">{{$dt->keterangan}}</span>
                                @elseif($dt->keterangan=="Selesai")
                                <span class="badge bg-secondary text-white">{{$dt->keterangan}}</span>
                                @else
                                <span class="badge bg-success text-white">{{$dt->keterangan}}</span>
                                @endif
                            </td>
                            <td>
                                Rp {{number_format($dt->harga*$jam,0,",",".")}}
                            </td>
                            <td align="center">
                                <button data-bs-toggle="modal" data-bs-target="#edit{{$dt->id_sewa}}" class="btn btn-sm btn-primary">
                                    <i class="dripicons dripicons-disc"></i>
                                </button>
                                <a href="{{route('cek_data',$dt->id_sewa)}}" class="btn btn-sm btn-success">
                                    <i class="dripicons dripicons-document-edit"></i>
                                </a>
                                <a href="{{route('delete_sewa',$dt->id_sewa)}}" onclick="return confirm('Hapus Data?')" class="btn btn-sm btn-danger">
                                    <i class="dripicons dripicons-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php $no++ ?>
                        @include('page/sewa/note')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>
@endsection