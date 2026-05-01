<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
role="document">
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Menambah Data
        </h5>
        <button type="button" class="close" data-bs-dismiss="modal"
        aria-label="Close">
        <i data-feather="x"></i>
    </button>
</div>
<form method="post" action="{{route('add_payment')}}">
    @csrf
    <div class="modal-body">
        <div class="form=group">
            <label>No Rekening</label>
            <input type="text" required="" class="form-control" name="no_rek">
        </div>
        <div class="form=group">
            <label>Nama Rekening</label>
            <input type="text" required="" class="form-control" name="nama_rek">
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