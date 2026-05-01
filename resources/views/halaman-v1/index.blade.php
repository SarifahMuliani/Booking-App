@extends('halaman-v1/layout/app')
@section('title','Halaman Page')
@section('content')
<?php 
$profil=DB::table('profil')->get();
?>
@foreach($profil as $pf)
<div class="bgded overlay" style="background-image:url('{{asset('wlp.JPG')}}');">
  <div id="pageintro" class="hoc clear"> 

    <!-- ################################################################################################ -->
    <article>
      <h4 class="heading">{{$pf->jenis_apk}}</h4>
      @guest
        <p>Klik Login untuk Menyewa Lapangan secara online</p>
        <footer><a class="btn" href="{{route('login')}}">Login</a> <a class="btn" href="{{route('register')}}">Register</a></footer> 
      @endguest
    </article>
    <!-- ################################################################################################ -->
  </div>
</div>

<div class="wrapper row3">
  <main class="hoc container clear"> 
    <!-- main body -->
    <!-- ################################################################################################ -->
    <section id="introblocks">
      <ul class="nospace group btmspace-80 elements elements-four">
        <li class="one_quarter">
          <article><a href="#"><i class="fas fa-hand-rock"></i></a>
            <h6 class="heading">KENYAMANAN</h6>
            <p>MENGUTAMAKAN KENYAMANAN PENYEWA</p>
          </article>
        </li>
        <li class="one_quarter">
          <article><a href="#"><i class="fas fa-dove"></i></a>
            <h6 class="heading">STRATEGIS</h6>
            <p>TEMPAT KAMI YANG STRATEGIS</p>
          </article>
        </li>
        <li class="one_quarter">
          <article><a href="#"><i class="fas fa-history"></i></a>
            <h6 class="heading">FREE</h6>
            <p>SETIAP KENDARAAN FREE PARKIR</p>
          </article>
        </li>
        <li class="one_quarter">
          <article><a href="#"><i class="fas fa-heartbeat"></i></a>
            <h6 class="heading">FREE TWO</h6>
            <p>MENYEDIAKAN FREE MINUM 1 BOTOL</p>
          </article>
        </li>
      </ul>
    </section>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </main>
</div>

<div class="wrapper gradient">
  <div class="hoc container clear"> 
    <!-- ################################################################################################ -->
    <div class="sectiontitle">
      <h6 class="heading font-x2">JAM BUKA</h6>
    </div>
    <ul class="nospace group team">
      <li class="one_third first">
        <figure><a class="imgover" href="#"><img src="images/demo/348x400.png" alt=""></a>
          <figcaption><strong>SENIN - KAMIS</strong> <em>06.00 - 23.59 WIB</em></figcaption>
        </figure>
      </li>
      <li class="one_third">
        <figure><a class="imgover" href="#"><img src="images/demo/348x400.png" alt=""></a>
          <figcaption><strong>JUM'AT</strong> <em>06.00 - 23.59 WIB</em></figcaption>
        </figure>
      </li>
      <li class="one_third">
        <figure><a class="imgover" href="#"><img src="images/demo/348x400.png" alt=""></a>
          <figcaption><strong>SABTU - MINGGU</strong> <em>09.00 - 22.00 WIB</em></figcaption>
        </figure>
      </li>
    </ul>
    <!-- ################################################################################################ -->
  </div>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper coloured" id="prosedur">
  <section id="testimonials" class="hoc container clear"> 
    <!-- ################################################################################################ -->
    <div class="sectiontitle">
      <h6 class="heading font-x2">PROSEDUR PENYEWAAN</h6>
    </div>
    <article class="one_half first">
      <figure class="clear">
        <figcaption>
          <em>Login</em></figcaption>
        </figure>
        <blockquote>Penyewa melakukan login, melalui halaman login, Lengkapi profil anda setelah melakukan login sebelum input data penyewaan. </blockquote>
      </article>
      <article class="one_half">
        <figure class="clear">
          <figcaption>
            <em>Input Data dan Upload Bukti Pembayaran</em></figcaption>
          </figure>
          <blockquote>Setelah input data penyewaan, Upload bukti pembayaran ketika sudah transfer melalui kode pembayaran yang diterapkan di halaman data sewa anda. </blockquote>
        </article>
        <article class="one_half first">
          <figure class="clear">
            <figcaption>
              <em>Penyewaan disetujui</em></figcaption>
            </figure>
            <blockquote>
              Data penyewaan akan di konfirmasii ketika profile anda sudah lengkap dan telah membayar penyewaan di no rekening yang di terapkan/ Meng-Upload Gambar Bukti Transfer. 
            </blockquote>
          </article>
          <article class="one_half">
            <figure class="clear">
              <figcaption>
                <em>INFO PENTING</em></figcaption>
              </figure>
              <blockquote>
                Penyewa harus datang 10 menit sebelum pertandingan, jika penyewa berhalangan hadir maka konfirmasi terlebih dahulu, jika tidak ada konfirmasi selama 1 jam, maka penyewa dianggap membataklan pesanan.              </blockquote>
            </article>
            <!-- ################################################################################################ -->
          </section>
        </div>
        <!-- ################################################################################################ -->
        <!-- ################################################################################################ -->
        <!-- ################################################################################################ -->
        <div class="wrapper row3" id="lapangan">
          <section class="hoc container clear"> 
            <!-- ################################################################################################ -->
            <div class="sectiontitle">
              <h6 class="heading font-x2">Data Sarana</h6>
            </div>
            <ul id="latest" class="nospace group">
              @foreach($lapangan as $lp)
              <li class="one_third" style="width: 330px;">
                <article><a class="imgover" href="{{route('boking',['id_lapangan'=>$lp->id_lapangan,'gambar'=>$lp->gambar])}}"><img src="{{asset('gambar')}}/{{$lp->gambar}}" alt="" ></a>
                  <ul class="nospace meta clear">
                    <li><i class="fas fa-user"></i> <a href="{{route('cek_boking',$lp->id_lapangan)}}">Cek Booking</a></li>
                    <li><i class="fas fa-eye"></i> <a href="{{route('visit',$lp->id_lapangan)}}">Visit</a></li>
                  </ul>
                  <div class="excerpt">
                    <p class="heading">
                      {{$lp->nama_lap}} -
                      {{$lp->nama_jenis}}
                      <br> Kegiatan : {{$lp->kegiatan}}
                    </p>
                    <br>
                    <time datetime="2045-04-05T08:15+00:00">Rp {{number_format($lp->harga,0,",",".")}}</time>
                        <span>{{ $lp->det_lapangan }}</span>
                  </div>
                  <br>
                </article>
              </li>
              @endforeach
            </ul>
            <!-- ################################################################################################ -->
          </section>
        </div>
        <!-- ################################################################################################ -->
        <!-- ################################################################################################ -->
        <!-- ################################################################################################ -->
        <div class="wrapper row2" id="contact" style="text-align: center">
          <section id="ctdetails" class="hoc container clear"> 
            <!-- ################################################################################################ -->
            <div class="sectiontitle">
              <!-- <p class="nospace font-xs">Enim eleifend dignissim bibendum</p> -->
              <h6 class="heading font-x2">LOKASI CONTACT</h6>
              <b>{{$pf->no_profil}}</b>
            </div>
            <iframe class="form-control" height="400" width="1000" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=1000&amp;height=600&amp;hl=en&amp;q={{$pf->lokasi}}+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
            <!-- ################################################################################################ -->
          </section>
        </div>
        @endforeach
        @endsection