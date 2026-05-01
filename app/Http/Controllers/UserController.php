<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
	public function add_sewa(Request $request)
	{
		$jatuhtempo = date('H:i:s',strtotime("+30 minutes",strtotime(date('H:i:s'))));
		$awal = $request->jam_mulai;
		$selesai = $request->jam_selesai;
		$cek=DB::table('data_sewa')->join('nama_lapangan','nama_lapangan.id_lapangan','=','data_sewa.lap_id')
		->where('data_sewa.lap_id',$request->lap_id)
		->where('data_sewa.keterangan','=','Aktif')
		->where('data_sewa.tanggal',$request->tanggal)
		->where(function($query) use ($awal, $selesai){
			$query->whereBetween('data_sewa.jam_mulai',[$awal,$selesai])
			->orWhereBetween('data_sewa.jam_selesai',[$awal,$selesai]);
		})
		->first();
		if ($cek==NULL) {
			DB::table('data_sewa')->insert([
				'id_user'=>$request->id_user,
				'lap_id'=>$request->lap_id,
				'tanggal'=>$request->tanggal,
				'tempo'=>$jatuhtempo,
				'jam_mulai'=>$request->jam_mulai,
				'jam_selesai'=>$request->jam_selesai,
				'keterangan'=>'-',
				'konfirmasi'=>'Belum di Konfirmasi',
				'bukti_tf'=>'-',
			]);
			return redirect(route('data_sewa'))->with('addboking','-');
		}else{
			return back()->with('digunakan','-');
		}
	}
	public function data_sewa()
	{
		$data=DB::table('nama_lapangan')
		->join('data_sewa','data_sewa.lap_id','=','nama_lapangan.id_lapangan')
		->where('data_sewa.id_user',Auth::user()->id)->get();
		$kode=DB::table('payment')->get();
		return view('halaman/sewa',['data'=>$data,'kode'=>$kode]);
	}
	public function delete_sewa($id_sewa)
	{
		DB::table('data_sewa')->where('id_sewa',$id_sewa)->delete();
		return redirect()->back()->with('sewadel','-');
	}
	public function boking($id_lapangan,$gambar)
	{
		$data=DB::table('nama_lapangan')->where('nama_lapangan.gambar',$gambar)->where('nama_lapangan.id_lapangan',$id_lapangan)->get();
		$lengkap=DB::table('datauser')->where('user_id',Auth::user()->id)->get();
		$list=DB::table('nama_lapangan')->join('data_sewa','data_sewa.lap_id','=','nama_lapangan.id_lapangan')->where('data_sewa.lap_id',$id_lapangan)->where('Keterangan','Aktif')->where('nama_lapangan.gambar',$gambar)->get();
		return view('halaman/boking',compact('data','list','lengkap'));
	}
	public function profil()
	{
		$data=DB::table('users')->join('datauser','users.id','=','datauser.user_id')->where('users.id',Auth::user()->id)->get();
		return view('halaman/profil',compact('data'));
	}
	public function lengkapi(Request $request)
	{
		if ($request->password=="") {
			DB::table('users')->where('id',Auth::user()->id)->update([
				'name'=>$request->name,
				'username'=>$request->username,
			]);
			DB::table('datauser')->where('user_id',Auth::user()->id)->update([
				'email'=>$request->email,
				'no_telp'=>$request->no_telp,
				'jenis_kelamin'=>$request->jenis_kelamin,
				'ktp'=>$request->ktp,
				'alamat_penyewa'=>$request->alamat_penyewa,
			]);
			return redirect()->back()->with('lengkapi','-');
		}else{
			DB::table('users')->where('id',Auth::user()->id)->update([
				'name'=>$request->name,
				'username'=>$request->username,
				'password'=>hash::make($request->password),
			]);
			DB::table('datauser')->where('user_id',Auth::user()->id)->update([
				'email'=>$request->email,
				'no_telp'=>$request->no_telp,
				'jenis_kelamin'=>$request->jenis_kelamin,
				'ktp'=>$request->ktp,
				'alamat_penyewa'=>$request->alamat_penyewa,
			]);
			return redirect()->back()->with('lengkapi','-');
		}
	}
	public function upload_bukti(Request $request)
	{
		if ($request->hasFile('gambar')) {
			$ambil=$request->file('gambar');
			$name=$ambil->getClientOriginalName();
			$namaFileBaru = uniqid();
			$namaFileBaru .= $name;
			$ambil->move(\base_path()."/public/upload", $namaFileBaru);

			DB::table('data_sewa')->where('id_sewa',$request->id_sewa)->update([
				'bukti_tf'=>$namaFileBaru,		
				'keterangan'=>'Sedang di Cek',		
			]);
			return redirect()->back()->with('bukti_tf','-');
		}
	}
}