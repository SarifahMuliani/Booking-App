                    <div class="modal fade" id="edit{{$dt->id_sewa}}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                        role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Detail Data
                                </h5>
                                <button type="button" class="close" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-4">Nama </div>
                                <div class="col-1">: </div>
                                <div class="col-7"> {{Auth::user()->name}} </div>
                                <div class="col-4">Nama Lapangan </div>
                                <div class="col-1">: </div>
                                <div class="col-7"> {{$dt->nama_lap}} </div>
                                <div class="col-4">Jenis Lapangan </div>
                                <div class="col-1">: </div>
                                <div class="col-7"> {{$dt->nama_jenis}} </div>
                                <div class="col-4">Harga </div>
                                <div class="col-1">: </div>
                                <div class="col-7"> Rp {{number_format($dt->harga,0,",",".")}} </div>
                                <div class="col-4">Tanggal </div>
                                <div class="col-1">: </div>
                                <div class="col-7"> {{$dt->tanggal}} </div>
                                <div class="col-4">Jam </div>
                                <div class="col-1">: </div>
                                <div class="col-7"> {{$dt->jam_mulai}} - {{$dt->jam_selesai}} </div>
                                <div class="col-4">Lama Sewa </div>
                                <div class="col-1">: </div>
                                <div class="col-7"> {{$jam}} Jam </div>
                                <div class="col-4">Konfirmasi </div>
                                <div class="col-1">: </div>
                                <div class="col-7"> 
                                    @if($dt->konfirmasi=="Belum di Konfirmasi")
                                    <span class="badge bg-warning">{{$dt->konfirmasi}}</span>
                                    @endif
                                    @if($dt->konfirmasi!=="Belum di Konfirmasi")
                                    <span class="badge bg-success">{{$dt->konfirmasi}}</span>
                                    @endif
                                </div>
                                <div class="col-4">Keterangan </div>
                                <div class="col-1">: </div>
                                <div class="col-7"> 
                                    @if($dt->bukti_tf=="-")
                                    <span class="badge bg-danger">Segera Upload Bukti Transfer ke Rekening</span>
                                    @endif
                                    <span class="badge bg-secondary">
                                        {{$dt->keterangan}}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary"
                            data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>