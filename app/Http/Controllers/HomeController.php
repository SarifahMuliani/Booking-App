<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Image;

class HomeController extends Controller
{
  public function index()
  {
    $lapangan=DB::table('nama_lapangan')->get();
    $profil=DB::table('profil')->get();
    return view('halaman-v1/index',compact('lapangan','profil'));
  }
  public function visit($id_lapangan)
  {
    $image=DB::table('nama_lapangan')->join('image_lapangan','image_lapangan.lapangan_id','=','nama_lapangan.id_lapangan')->where('image_lapangan.lapangan_id',$id_lapangan)->get();
    $data=DB::table('nama_lapangan')->where('nama_lapangan.id_lapangan',$id_lapangan)->get();
    return view('halaman-v1/visit',compact('data','image'));
  }
  public function cek_boking($id_lapangan)
  {
    $data=DB::table('nama_lapangan')->join('data_sewa','data_sewa.lap_id','=','nama_lapangan.id_lapangan')->where('data_sewa.lap_id',$id_lapangan)->where('Keterangan','Aktif')->get();
    return view('halaman-v1/cek',['data'=>$data]);
  }
  public function login()
  {
   return view('login');
 }
 public function ceklogin(Request $request)
 {
  if (!empty($request->username) AND !empty($request->password)) {
    if (Auth::attempt(['username'=>$request->username,'password'=>$request->password,'status_user'=>'Aktif'])) {
      if (Auth::user()->level=="Admin") {
        return response()->json([
          'masuk_admin' => '-'
        ]);
      }else{
        return response()->json([
          'masuk_penyewa' => '-'
        ]);
      }
    }else{
      return response()->json([
        'notmasuk' => '-'
      ]);
    }
  }else{
    return response()->json([
      'kosong' => '-'
    ]);
  }
}
public function register()
{
 return view('register');
}
public function addreg(Request $request)
{
 $cek=DB::table('users')->where('username', $request->username)->first();
 if (empty($request->username) AND empty($request->password)) {
  return response()->json([
    'kosong' => '-'
  ]);
}else{
  if ($cek!==null) {
    return response()->json([
      'sama' => '-'
    ]);
  }else{
    $users = new User();
    $users -> name = $request -> name;
    $users -> username = $request -> username;
    $users -> password = Hash::make($request -> password);
    $users -> level = 'Penyewa';
    $users -> status_user = 'Aktif';
    $users -> save();
    DB::table('datauser')->insert([
      'user_id'=>$users->id,
    ]);
    return response()->json([
      'yes' => '-'
    ]);
  }
}
}
public function logout()
{
  Auth::logout();
  return redirect('/');
}
}
