@extends('layout/app')

@section('title', 'Register')

@section('content')
<div id="auth">
    <div class="row h-100">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <h1 class="auth-title">Sign Up</h1>
                <p class="auth-subtitle mb-3">Masukkan Data Form di Bawah.</p>

                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" required="" class="form-control form-control-xl" id="name" placeholder="Name">
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" required="" class="form-control form-control-xl" id="username" placeholder="Username">
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password" required="" class="form-control form-control-xl" id="password" placeholder="Password">
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>
                <button class="btn btn-primary btn-block btn-lg shadow-lg mt-3" onclick="kirim()">Sign Up</button>
                <div class="text-center mt-5 text-lg fs-4">
                    <p class='text-gray-600'>Sudah punya Akun? <a href="{{route('login')}}"
                        class="font-bold">Log
                    in</a>.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-7 d-none d-lg-block">
            <div id="auth-right">

            </div>
        </div>
    </div>

</div>
<script type="text/javascript">
  function kirim() {
    var name=$('#name').val();
    var username=$('#username').val();
    var password=$('#password').val();
    $.ajax({
        url : "{{route('addreg')}}",
        type : 'POST',
        data : {
            '_method' : 'POST',
            '_token' : '{{ csrf_token() }}',
            'name' : name,
            'username' : username,
            'password' : password
        },
        success: function(response) {
            let timerInterval
            if (response.yes) {
              Swal.fire({
                icon: "success",
                type: "success",
                title: 'Register Berhasil',
                text: 'Silahkan Login untuk Penyewaan.',
                showConfirmButton: false,
                timer: 1300
            }).then((result) => {
                window.location="{{route('login')}}";
            });
        }
        if (response.kosong) {
            Swal.fire({
                icon: "warning",
                type: "warning",
                title: 'Masukkan Data',
                text: 'Harap masukkan Form Register Data.',
                showConfirmButton: false,
                timer: 1500
            });
        }
        if (response.sama) {
            Swal.fire({
                icon: "info",
                type: "info",
                title: 'Username Sama',
                text: 'Username telah di gunakan.',
                showConfirmButton: false,
                timer: 1500
            });
        }
    }
});     
}
</script>
@endsection