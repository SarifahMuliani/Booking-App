@extends('halaman-v1/layout/app')
@section('title','Visit Lapangan')
@section('content')
<div class="wrapper row3">
  <main class="hoc container clear"> 
    <!-- main body -->
    <!-- ################################################################################################ -->
    <div class="content"> 
      <!-- ################################################################################################ -->
      <div id="gallery">
        <figure>
          <header class="heading">Gambar Lapangan </header>
          <ul class="nospace clear">
            @foreach($data as $dt)
            <li class="one_quarter first"><a href="#"><img src="{{asset('gambar')}}/{{$dt->gambar}}" alt="" style="width: 300px"></a></li>
            @endforeach
            @foreach($image as $dt)
            <li class="one_quarter"><a href="#"><img src="{{asset('image')}}/{{$dt->filename}}" alt="" style="width: 300px"></a></li>
            @endforeach
          </ul>
        </figure>
      </div>
    </div>
    <!-- ################################################################################################ -->
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>
@endsection