<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Image;
use App\Http\Controllers\Controller;
use PDF;

class AdminController extends Controller
{
	public function home()
	{
		$user=DB::table('users')->where('level','Penyewa')->count();
		$alluser=DB::table('users')->join('datauser','datauser.user_id','=','users.id')->where('level','Penyewa')->get();
		$kode=DB::table('payment')->count();
		$lapangan=DB::table('nama_lapangan')->count();
		$data=DB::table('nama_lapangan')->join('data_sewa','data_sewa.lap_id','=','nama_lapangan.id_lapangan')->join('users','users.id','=','data_sewa.id_user')->join('datauser','datauser.user_id','=','users.id')->limit('3')->get();
		return view('page/home/index',['user'=>$user,'kode'=>$kode,'lapangan'=>$lapangan,'alluser'=>$alluser,'data'=>$data]);
	}

	public function lapangan()
	{
		$data=DB::table('nama_lapangan')->get();
		return view('page/lapangan/index',compact('data'));
	}
	public function add_lapangan(Request $request)
	{
		foreach ($request->nama_lap as $key => $value) {
			$ambil=$request->file('image')[$key];
			$namafoto=md5($ambil->getClientOriginalName());
			DB::table('nama_lapangan')->insert([
				'nama_lap'=>$request->nama_lap[$key],
				'nama_jenis'=>$request->nama_jenis[$key],
				'harga'=>$request->harga[$key],
				'gambar'=>$namafoto,
				'kegiatan'=>$request->kegiatan[$key],  		
				'det_lapangan'=>$request->det_lapangan[$key],  		
				'path'=>$ambil->move(\base_path()."/public/gambar", $namafoto),
			]);
		}
		return redirect()->back()->with('lapanganadd','-');
	}
	public function update_lapangan(Request $request,$id_lapangan)
	{
		if ($request->hasFile('gambar')) {
			$ambil=$request->file('gambar');
			$name=$ambil->getClientOriginalName();
			$namaFileBaru = uniqid();
			$namaFileBaru .= $name;
			$ambil->move(\base_path()."/public/gambar", $namaFileBaru);
			$save=DB::table('nama_lapangan')->where('id_lapangan',$id_lapangan)->update([
				'nama_lap'=>$request->nama_lap,
				'nama_jenis'=>$request->nama_jenis,
				'harga'=>$request->harga,
				'harga'=>$request->harga,
				'gambar'=>$namaFileBaru,
				'kegiatan'=>$request->kegiatan,  		
				'det_lapangan'=>$request->det_lapangan,  		
				'tgl'=>$request->tgl,  		
			]);
			return redirect()->back()->with('lapanganup','-');
		}else{
			DB::table('nama_lapangan')->where('id_lapangan',$id_lapangan)->update([
				'nama_lap'=>$request->nama_lap,
				'nama_jenis'=>$request->nama_jenis,
				'harga'=>$request->harga,
				'harga'=>$request->harga,
				'kegiatan'=>$request->kegiatan,  		
				'tgl'=>$request->tgl,  
			]);
			return redirect()->back()->with('lapanganup','-');
		}
	}
	public function delete_lapangan($id_lapangan)
	{
		DB::table('nama_lapangan')->where('id_lapangan',$id_lapangan)->delete();
		return redirect()->back()->with('lapangandel','-');
	}
	public function image_lapangan($id_lapangan)
	{
		$data=DB::table('nama_lapangan')->join('image_lapangan','image_lapangan.lapangan_id','=','nama_lapangan.id_lapangan')->where('image_lapangan.lapangan_id',$id_lapangan)->get();
		$id=DB::table('nama_lapangan')->where('nama_lapangan.id_lapangan',$id_lapangan)->get();
		return view('page/lapangan/image',compact('data','id'));
	}
	public function store(Request $request)
	{
		$files = $request->file('file');
		foreach ($files as $file) {
			$foto=md5($file->getClientOriginalName());
			DB::table('image_lapangan')->insert([
				'lapangan_id'=>$request->id_lapangan,
				'filename' => $foto,
				'path' => $file->move(\base_path()."/public/image",$foto),
			]);
		}
		return redirect()->back()->with('success','File telah diupload');
	}
	public function delete_image($id_image)
	{
		DB::table('image_lapangan')->where('id_image',$id_image)->delete();
		return redirect()->back();
	}
	public function payment()
	{
		$data=DB::table('payment')->get();
		return view('page/payment/payment',compact('data'));
	}
	public function add_payment(Request $request)
	{
		DB::table('payment')->insert([
			'no_rek'=>$request->no_rek,
			'nama_rek'=>$request->nama_rek,
		]);
		return redirect()->back()->with('paymentadd','-');
	}
	public function update_payment(Request $request)
	{
		DB::table('payment')->where('id_payment',$request->id_payment)->update([
			'no_rek'=>$request->no_rek,
			'nama_rek'=>$request->nama_rek,
		]);
		return redirect()->back()->with('paymentup','-');
	}
	public function delete_payment($id_payment)
	{
		DB::table('payment')->where('id_payment',$id_payment)->delete();
		return redirect()->back()->with('paymentdel','-');
	}

	public function user()
	{
		$data=DB::table('users')->join('datauser','datauser.user_id','=','users.id')->get();
		return view('page/user/user',compact('data'));
	}
	public function pengguna()
	{
		$data=DB::table('users')->where('level','Admin')->get();
		return view('page/user/pengguna',compact('data'));
	}
	public function edit_pengguna(Request $request,$id)
	{
		if ($request->password=="") {
			DB::table('users')->where('id',$id)->update([
				'name'=>$request->name,
				'username'=>$request->username,
			]);
			return redirect()->back();
		}else{
			DB::table('users')->where('id',$id)->update([
				'name'=>$request->name,
				'username'=>$request->username,
				'password'=>hash::make($request->password),
			]);
		}
		return redirect()->back();
	}
	public function status_user($id)
	{
		$data=DB::table('users')->where('id',$id)->first();
		if ($data) {
			if ($data->status_user=="Aktif") {
				DB::table('users')->where('id',$id)->update([
					'status_user'=>'Non-Aktif',
				]);
				return redirect()->back()->with('statusup','-');
			}else{
				DB::table('users')->where('id',$id)->update([
					'status_user'=>'Aktif',
				]);
				return redirect()->back()->with('statusup','-');
			}
		}
	}
	public function sewa()
	{
		$data=DB::table('nama_lapangan')->join('data_sewa','data_sewa.lap_id','=','nama_lapangan.id_lapangan')->join('users','users.id','=','data_sewa.id_user')->join('datauser','datauser.user_id','=','users.id')->get();
		return view('page/sewa/sewa',compact('data'));
	}
	public function cek_data($id_sewa)
	{
		$data=DB::table('nama_lapangan')->join('data_sewa','data_sewa.lap_id','=','nama_lapangan.id_lapangan')->join('users','users.id','=','data_sewa.id_user')->join('datauser','datauser.user_id','=','users.id')->where('data_sewa.id_sewa',$id_sewa)->get();
		return view('page/sewa/cek',compact('data'));
	}
	public function keterangan(Request $request)
	{
		DB::table('data_sewa')->where('id_sewa',$request->id_sewa)->update([
			'keterangan'=>$request->keterangan,
		]);
		return redirect(route('sewa'))->with('keterangan','-');
	}
	public function konfirmasi($id_sewa)
	{
		DB::table('data_sewa')->where('id_sewa',$id_sewa)->update([
			'konfirmasi'=>'Sudah di Konfirmasi',
			'keterangan'=>'Aktif',
		]);
		return redirect(route('sewa'))->with('konfirmasi','-');
	}

	public function laporan(Request $request)
	{
		if (empty($request->awal)) {
			$data=DB::table('nama_lapangan')->join('data_sewa','data_sewa.lap_id','=','nama_lapangan.id_lapangan')->join('users','users.id','=','data_sewa.id_user')->join('datauser','datauser.user_id','=','users.id')
			->get();
			$omset=DB::table('nama_lapangan')->join('data_sewa','data_sewa.lap_id','=','nama_lapangan.id_lapangan')->join('users','users.id','=','data_sewa.id_user')->join('datauser','datauser.user_id','=','users.id')
			->limit('1')->get();
		}else{
			$data=DB::table('nama_lapangan')->join('data_sewa','data_sewa.lap_id','=','nama_lapangan.id_lapangan')->join('users','users.id','=','data_sewa.id_user')->join('datauser','datauser.user_id','=','users.id')
			->whereBetween('data_sewa.tanggal',[$request->awal,$request->akhir])
			->get();
			$omset=DB::table('nama_lapangan')->join('data_sewa','data_sewa.lap_id','=','nama_lapangan.id_lapangan')->join('users','users.id','=','data_sewa.id_user')->join('datauser','datauser.user_id','=','users.id')
			->whereBetween('data_sewa.tanggal',[$request->awal,$request->akhir])
			->limit('1')->get();
		}
		return view('page/laporan/laporan',compact('data','omset'));
	}
	public function export_laporan(Request $request)
	{
		$data=DB::table('nama_lapangan')->join('data_sewa','data_sewa.lap_id','=','nama_lapangan.id_lapangan')->join('users','users.id','=','data_sewa.id_user')->join('datauser','datauser.user_id','=','users.id')
		->whereBetween('data_sewa.tanggal',[$request->awal,$request->akhir])
		->get();
		$omset=DB::table('nama_lapangan')->join('data_sewa','data_sewa.lap_id','=','nama_lapangan.id_lapangan')->join('users','users.id','=','data_sewa.id_user')->join('datauser','datauser.user_id','=','users.id')
		->whereBetween('data_sewa.tanggal',[$request->awal,$request->akhir])
		->limit('1')->get();
		if ($request->keyword=="Export-PDF") {
			$pdf=PDF::loadview('page/laporan/export',compact('data','omset'))->setPaper('A4','landscape');
			return $pdf->stream();
		}else{	
			return view('page/laporan/export',compact('data','omset'));
		}
	}
	public function profil_lapangan()
	{
		$profil=DB::table('profil')->get();
		return view('page/profil',['profil'=>$profil]);
	}
	public function setting(Request $request,$id_profil)
	{
		DB::table('profil')->where('id_profil',$id_profil)->update([
			'nama_profil'=>$request->nama_profil,
			'jenis_apk'=>$request->jenis_apk,
			'lokasi'=>$request->lokasi,
			'no_profil'=>$request->no_profil,
		]);
		return redirect()->back()->with('setting','-');
	}
}
