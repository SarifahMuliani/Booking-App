<div class="modal fade" id="edit{{$dt->id_payment}}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
    role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Update Data
            </h5>
            <button type="button" class="close" data-bs-dismiss="modal"
            aria-label="Close">
            <i data-feather="x"></i>
        </button>
    </div>
    <form method="post" action="{{route('update_payment')}}">
        @csrf
        <div class="modal-body">
            <div class="form=group">
                <input type="hidden" value="{{$dt->id_payment}}" name="id_payment">
                <label>No Rekening</label>
                <input type="text" class="form-control" required="" value="{{$dt->no_rek}}" name="no_rek">
            </div>
            <div class="form=group">
                <label>Nama Rekening</label>
                <input type="text" class="form-control" required="" value="{{$dt->nama_rek}}" name="nama_rek">
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