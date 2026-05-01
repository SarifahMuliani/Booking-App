<div class="modal fade" id="edit{{$dt->id_lapangan}}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg"
    role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Mengubah Data Sarana
            </h5>
            <button type="button" class="close" data-bs-dismiss="modal"
            aria-label="Close">
            <i data-feather="x"></i>
        </button>
    </div>
    <form method="post" action="{{route('update_lapangan',$dt->id_lapangan)}}" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Nama Lapangan</label>
                        <input type="text" required="" name="nama_lap" value="{{$dt->nama_lap}}" class="form-control">
                    </div>  
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Jenis Lapangan</label>
                        <input type="text" required="" name="nama_jenis" value="{{$dt->nama_jenis}}" class="form-control">
                    </div>  
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Harga Sewa</label>
                        <input type="number" required="" value="{{$dt->harga}}" class="form-control" name="harga">
                    </div>  
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Kegiatan</label>
                        <input type="text" required="" class="form-control" value="{{$dt->kegiatan}}" name="kegiatan">
                    </div>  
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>Gambar Sarana</label>
                        <input type="file" class="form-control" name="image">
                    </div>  
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>Keterangan/Detail Sarana</label>
                        <textarea class="form-control" required="" rows="5" name="det_lapangan">{{$dt->det_lapangan}}</textarea>
                    </div>  
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light-secondary"
            data-bs-dismiss="modal">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Close</span>
        </button>
        <button class="btn btn-primary ml-1">
            <i class="bx bx-check d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Accept</span>
        </button>
    </div>
</form>
</div>
</div>
</div>