<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable modal-lg"
role="document">
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Menambah Data Sarana
        </h5>
        <button type="button" class="close" data-bs-dismiss="modal"
        aria-label="Close">
        <i data-feather="x"></i>
    </button>
</div>
<div class="modal-body">
    <form method="post" action="{{route('add_lapangan')}}" enctype="multipart/form-data">
        @csrf
        <div class="row" id="after-add-more">
            <div class="col-6">
                <div class="form-group">
                    <label>Nama Lapangan</label>
                    <input type="text" required="" name="nama_lap[]" class="form-control">
                </div>  
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Jenis Lapangan</label>
                    <input type="text" required="" name="nama_jenis[]" class="form-control">
                </div>  
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Harga Sewa</label>
                    <input type="number" required="" class="form-control" name="harga[]">
                </div>  
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Kegiatan</label>
                    <input type="text" required="" class="form-control" name="kegiatan[]">
                </div>  
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label>Gambar</label>
                    <input type="file" required="" class="form-control" name="image[]">
                </div>  
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label>Keterangan/Detail Lapangan</label>
                    <textarea class="form-control" required="" rows="5" name="det_lapangan[]"></textarea>
                </div>  
            </div>
            <div class="col-12">
                <button class="btn btn-sm btn-success form-control" id="add-more" type="button"><i class="dripicons dripicons-plus"></i></button>
            </div>
        </div>
        <button class="btn btn-sm btn-primary form-control mt-2">Tambah</button>
    </form>
    <div class="row" id="copy">
        <div class="row" id="control-group">
            <div class="col-6">
                <div class="form-group">
                    <label>Nama Lapangan</label>
                    <input type="text" required="" name="nama_lap[]" class="form-control">
                </div>  
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Jenis Lapangan</label>
                    <input type="text" required="" name="nama_jenis[]" class="form-control">
                </div>  
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Harga Sewa</label>
                    <input type="number" required="" class="form-control" name="harga[]">
                </div>  
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Kegiatan</label>
                    <input type="text" required="" class="form-control" name="kegiatan[]">
                </div>  
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label>Gambar</label>
                    <input type="file" required="" class="form-control" name="image[]">
                </div>  
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label>Keterangan/Detail Lapangan</label>
                    <textarea class="form-control" required="" rows="5" name="det_lapangan[]"></textarea>
                </div>  
            </div>
            <div class="col-12">
                <button class="btn btn-sm btn-danger form-control" id="remove" type="button"><i class="dripicons dripicons-trash"></i></button>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>